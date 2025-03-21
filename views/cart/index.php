<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Giỏ Hàng Đăng Ký Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .table thead th {
            background-color: #007bff;
            color: #fff;
        }

        .btn-custom {
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            opacity: 0.9;
        }

        .action-btn {
            margin-bottom: 10px;
        }

        .summary-box {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }

        .summary-box h4 {
            color: #007bff;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container">
        <h2 class="mb-4 text-center">Giỏ Hàng Đăng Ký Học Phần</h2>
        <!-- Hiển thị thông tin sinh viên -->
        <?php include_once __DIR__ . '/../partials/student_info.php'; ?>

        <!-- Thông báo lỗi/success -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Giỏ hàng đăng ký học phần -->
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mã Học Phần</th>
                                <th>Tên Học Phần</th>
                                <th>Số Tín Chỉ</th>
                                <th>Số Lượng</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $MaHP => $course): ?>
                                <tr>
                                    <td><?php echo $MaHP; ?></td>
                                    <td><?php echo $course['TenHP']; ?></td>
                                    <td><?php echo $course['SoTinChi']; ?></td>
                                    <td><?php echo $course['quantity']; ?></td>
                                    <td>
                                        <a href="index.php?controller=cart&action=index&delete=1&MaHP=<?php echo $MaHP; ?>"
                                            class="btn btn-danger btn-sm action-btn"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa học phần <?php echo $MaHP; ?> khỏi giỏ hàng?')">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between flex-wrap">
                        <a href="index.php?controller=cart&action=index&clear=1"
                            class="btn btn-warning btn-custom action-btn"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ học phần trong giỏ?')">
                            Xóa Tất Cả
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tính toán tổng số môn và tổng số tín chỉ -->
            <?php
            $totalCourses = count($_SESSION['cart']);
            $totalCredits = 0;
            foreach ($_SESSION['cart'] as $course) {
                $totalCredits += $course['SoTinChi'] * $course['quantity'];
            }
            ?>
            <div class="summary-box">
                <h4>Tóm tắt đăng ký</h4>
                <p><strong>Tổng số môn:</strong> <?php echo $totalCourses; ?></p>
                <p><strong>Tổng số tín chỉ:</strong> <?php echo $totalCredits; ?></p>
            </div>
            <div class="text-center">
                <!-- Nút chuyển đến trang xác nhận -->
                <a href="index.php?controller=cart&action=confirm" class="btn btn-success btn-custom">Tiếp tục</a>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Chưa có học phần nào trong giỏ hàng!</div>
        <?php endif; ?>
        <div class="text-center mt-3">
            <a href="index.php?controller=hocphan&action=index" class="btn btn-primary btn-custom">Tiếp tục Đăng Ký Học Phần</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>