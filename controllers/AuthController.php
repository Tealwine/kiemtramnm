<?php
// controllers/AuthController.php
session_start();
require_once __DIR__ . '/../models/SinhVien.php';

class AuthController
{
    private $svModel;

    public function __construct()
    {
        $this->svModel = new SinhVien();
    }

    // Hiển thị trang đăng nhập và xử lý xác thực chỉ qua mã sinh viên
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $MaSV = $_POST['MaSV'];
            // Sử dụng model SinhVien để kiểm tra xem MaSV có tồn tại không
            $student = $this->svModel->getById($MaSV);
            if ($student) {
                $_SESSION['user'] = $student['MaSV'];
                header("Location: index.php?controller=sinhvien&action=index");
                exit();
            } else {
                $error = "Mã sinh viên không tồn tại!";
            }
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    // Đăng xuất
    public function logout()
    {
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}
