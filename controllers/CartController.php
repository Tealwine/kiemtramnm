<?php
// controllers/CartController.php
session_start();
require_once __DIR__ . '/../models/DangKy.php';
require_once __DIR__ . '/../models/ChiTietDangKy.php';
require_once __DIR__ . '/../models/HocPhan.php';

class CartController
{

    private $dkModel;
    private $ctdkModel;
    private $hpModel;

    public function __construct()
    {
        $this->dkModel = new DangKy();
        $this->ctdkModel = new ChiTietDangKy();
        $this->hpModel = new HocPhan();
    }

    // Trang giỏ hàng: xử lý thêm, xóa từng học phần, xóa tất cả, lưu đăng ký
    public function index()
    {
        // Khởi tạo giỏ hàng nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Xử lý thêm học phần vào giỏ (submit từ view HocPhan)
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['MaHP'])) {
            $MaHP = $_POST['MaHP'];
            $TenHP = $_POST['TenHP'];
            $SoTinChi = $_POST['SoTinChi'];
            // Nếu học phần đã có trong giỏ, báo lỗi
            if (isset($_SESSION['cart'][$MaHP])) {
                $_SESSION['error'] = "Học phần $MaHP đã được chọn trong giỏ hàng!";
            } else {
                $_SESSION['cart'][$MaHP] = [
                    'TenHP' => $TenHP,
                    'SoTinChi' => $SoTinChi,
                    'quantity' => 1
                ];
                $_SESSION['success'] = "Đã thêm học phần $MaHP vào giỏ hàng!";
            }
            header("Location: index.php?controller=cart&action=index");
            exit();
        }

        // Xử lý xóa từng học phần khỏi giỏ
        if (isset($_GET['delete']) && isset($_GET['MaHP'])) {
            $MaHP = $_GET['MaHP'];
            if (isset($_SESSION['cart'][$MaHP])) {
                unset($_SESSION['cart'][$MaHP]);
                $_SESSION['success'] = "Đã xóa học phần $MaHP khỏi giỏ hàng!";
            }
            header("Location: index.php?controller=cart&action=index");
            exit();
        }

        // Xử lý xóa toàn bộ học phần (clear giỏ hàng)
        if (isset($_GET['clear'])) {
            unset($_SESSION['cart']);
            $_SESSION['success'] = "Đã xóa tất cả học phần trong giỏ hàng!";
            header("Location: index.php?controller=cart&action=index");
            exit();
        }

        // Xử lý lưu đăng ký học phần
        if (isset($_POST['save_registration'])) {
            if (!isset($_SESSION['user'])) {
                $_SESSION['error'] = "Bạn phải đăng nhập để đăng ký học phần!";
                header("Location: index.php?controller=auth&action=login");
                exit();
            }
            $MaSV = $_SESSION['user']; // lấy mã sinh viên từ session
            $NgayDK = date('Y-m-d');
            $MaDK = $this->dkModel->create($MaSV, $NgayDK);
            if ($MaDK) {
                $notRegistered = [];
                foreach ($_SESSION['cart'] as $MaHP => $course) {
                    // Kiểm tra nếu học phần đã đăng ký
                    if ($this->dkModel->isCourseRegistered($MaSV, $MaHP)) {
                        $notRegistered[] = $MaHP;
                        continue; // bỏ qua học phần này
                    }
                    // Lưu chi tiết đăng ký
                    $this->ctdkModel->create($MaDK, $MaHP);
                    // Cập nhật số lượng dự kiến của học phần (nếu cần)
                    $this->hpModel->updateSoLuongSV($MaHP, $course['quantity']);
                }
                if (count($notRegistered) > 0) {
                    $_SESSION['success'] = "Một số học phần (" . implode(', ', $notRegistered) . ") đã được đăng ký trước đó. Các học phần khác đã được lưu thành công!";
                } else {
                    $_SESSION['success'] = "Đăng ký học phần thành công!";
                }
                unset($_SESSION['cart']);
            } else {
                $_SESSION['error'] = "Lỗi trong quá trình đăng ký học phần!";
            }
            header("Location: index.php?controller=cart&action=index");
            exit();
        }
        require_once __DIR__ . '/../views/cart/index.php';
    }

    // Action hiển thị các học phần đã đăng ký của sinh viên
    public function registered()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Bạn phải đăng nhập!";
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        $MaSV = $_SESSION['user'];
        $sql = "SELECT c.MaHP, c.TenHP, c.SoTinChi, d.NgayDK 
                FROM DangKy d
                JOIN ChiTietDangKy ct ON d.MaDK = ct.MaDK
                JOIN HocPhan c ON ct.MaHP = c.MaHP
                WHERE d.MaSV = ?";
        // Sử dụng getter getConn() từ BaseModel của dkModel
        $conn = $this->dkModel->getConn();
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $MaSV);
        $stmt->execute();
        $result = $stmt->get_result();
        $registeredCourses = [];
        while ($row = $result->fetch_assoc()) {
            $registeredCourses[] = $row;
        }
        require_once __DIR__ . '/../views/cart/registered.php';
    }
    public function confirm()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Bạn phải đăng nhập!";
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        // Nếu người dùng nhấn nút xác nhận đăng ký
        if (isset($_POST['confirm_registration'])) {
            // Thực hiện quá trình lưu đăng ký như cũ (với kiểm tra trùng lặp, cập nhật số lượng,...)
            // Sau đó, chuyển hướng và hiển thị thông báo thành công
            // (Bạn có thể tái sử dụng logic từ action index để lưu đăng ký)
            // Ví dụ:
            $MaSV = $_SESSION['user'];
            $NgayDK = date('Y-m-d');
            $MaDK = $this->dkModel->create($MaSV, $NgayDK);
            if ($MaDK) {
                foreach ($_SESSION['cart'] as $MaHP => $course) {
                    if (!$this->dkModel->isCourseRegistered($MaSV, $MaHP)) {
                        $this->ctdkModel->create($MaDK, $MaHP);
                        $this->hpModel->updateSoLuongSV($MaHP, $course['quantity']);
                    }
                }
                unset($_SESSION['cart']);
                $_SESSION['success'] = "Đăng ký học phần thành công!";
            } else {
                $_SESSION['error'] = "Lỗi trong quá trình đăng ký học phần!";
            }
            header("Location: index.php?controller=cart&action=index");
            exit();
        }
        // Tính toán tổng số môn và tổng số tín chỉ từ giỏ hàng
        $totalCourses = count($_SESSION['cart']);
        $totalCredits = 0;
        foreach ($_SESSION['cart'] as $course) {
            $totalCredits += $course['SoTinChi'] * $course['quantity'];
        }
        $courses = $_SESSION['cart'];
        require_once __DIR__ . '/../views/cart/confirm.php';
    }
}
