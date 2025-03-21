<?php
// controllers/HocPhanController.php
session_start();
require_once __DIR__ . '/../models/HocPhan.php';

class HocPhanController
{
    private $model;

    public function __construct()
    {
        $this->model = new HocPhan();
    }

    // Hiển thị danh sách học phần để đăng ký
    public function index()
    {
        $courses = $this->model->getAll();
        require_once __DIR__ . '/../views/hocphan/index.php';
    }
}
