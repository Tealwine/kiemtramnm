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

        .card-header h5 {
            margin: 0;
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
                        <form method="post" action="index.php?controller=cart&action=index">
                            <button type="submit" name="save_registration" class="btn btn-success btn-custom">
                                Lưu Đăng Ký
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Chưa có học phần nào trong giỏ hàng!</div>
        <?php endif; ?>
        <div class="text-center">
            <a href="index.php?controller=hocphan&action=index" class="btn btn-primary btn-custom">
                Tiếp tục Đăng Ký Học Phần
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>