<?php
// index.php - Front Controller
// Ví dụ đơn giản chuyển hướng dựa trên tham số GET
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($controller) {
    case 'auth':
        require_once __DIR__ . '/controllers/AuthController.php';
        $obj = new AuthController();
        break;
    case 'sinhvien':
        require_once __DIR__ . '/controllers/SinhVienController.php';
        $obj = new SinhVienController();
        break;
    case 'hocphan':
        require_once __DIR__ . '/controllers/HocPhanController.php';
        $obj = new HocPhanController();
        break;
    case 'cart':
        require_once __DIR__ . '/controllers/CartController.php';
        $obj = new CartController();
        break;
    default:
        die("Controller không tồn tại!");
}

if (method_exists($obj, $action)) {
    $obj->$action();
} else {
    die("Action không tồn tại!");
}
