<?php
// controllers/SinhVienController.php
session_start();
require_once __DIR__ . '/../models/SinhVien.php';

class SinhVienController
{
    private $model;

    public function __construct()
    {
        $this->model = new SinhVien();
    }

    // Hiển thị danh sách sinh viên
    public function index()
    {
        $students = $this->model->getAll();
        require_once __DIR__ . '/../views/sinhvien/index.php';
    }

    // Trang tạo mới sinh viên
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Xử lý upload hình ảnh vào thư mục /Content/images/
            $imagePath = '';
            if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
                $target_dir = "Content/images/"; // Đường dẫn lưu hình ảnh trong dự án
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                // Tạo tên file độc nhất (có thể thêm timestamp để tránh trùng lặp)
                $target_file = $target_dir . time() . "_" . basename($_FILES['Hinh']['name']);
                if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $target_file)) {
                    $imagePath = $target_file;
                }
            }
            $data = [
                'MaSV'    => $_POST['MaSV'],
                'HoTen'   => $_POST['HoTen'],
                'GioiTinh' => $_POST['GioiTinh'],
                'NgaySinh' => $_POST['NgaySinh'],
                'Hinh'    => $imagePath,
                'MaNganh' => $_POST['MaNganh']
            ];
            if ($this->model->create($data)) {
                $_SESSION['success'] = "Thêm sinh viên thành công!";
                header("Location: index.php?controller=sinhvien&action=index");
                exit();
            } else {
                $error = "Lỗi thêm sinh viên!";
            }
        }
        require_once __DIR__ . '/../views/sinhvien/create.php';
    }

    // Trang sửa thông tin sinh viên
    public function edit()
    {
        if (!isset($_GET['MaSV'])) {
            header("Location: index.php?controller=sinhvien&action=index");
            exit();
        }
        $MaSV = $_GET['MaSV'];
        // Lấy thông tin sinh viên hiện tại
        $student = $this->model->getById($MaSV);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Giữ lại đường dẫn ảnh cũ nếu không có file mới được tải lên
            $imagePath = $student['Hinh'];
            if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
                $target_dir = "Content/images/"; // Đường dẫn lưu hình ảnh
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_file = $target_dir . time() . "_" . basename($_FILES['Hinh']['name']);
                if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $target_file)) {
                    $imagePath = $target_file;
                }
            }
            $data = [
                'MaSV'    => $_POST['MaSV'],
                'HoTen'   => $_POST['HoTen'],
                'GioiTinh' => $_POST['GioiTinh'],
                'NgaySinh' => $_POST['NgaySinh'],
                'Hinh'    => $imagePath,
                'MaNganh' => $_POST['MaNganh']
            ];
            if ($this->model->update($data)) {
                $_SESSION['success'] = "Cập nhật sinh viên thành công!";
                header("Location: index.php?controller=sinhvien&action=index");
                exit();
            } else {
                $error = "Lỗi cập nhật sinh viên!";
            }
        }
        require_once __DIR__ . '/../views/sinhvien/edit.php';
    }

    // Xóa sinh viên
    public function delete()
    {
        if (isset($_GET['MaSV'])) {
            $MaSV = $_GET['MaSV'];
            if ($this->model->delete($MaSV)) {
                $_SESSION['success'] = "Xóa sinh viên thành công!";
            } else {
                $_SESSION['error'] = "Lỗi xóa sinh viên!";
            }
        }
        header("Location: index.php?controller=sinhvien&action=index");
        exit();
    }

    // Hiển thị chi tiết sinh viên
    public function detail()
    {
        if (!isset($_GET['MaSV'])) {
            header("Location: index.php?controller=sinhvien&action=index");
            exit();
        }
        $MaSV = $_GET['MaSV'];
        $student = $this->model->getById($MaSV);
        require_once __DIR__ . '/../views/sinhvien/detail.php';
    }
}
