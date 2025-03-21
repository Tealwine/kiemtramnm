<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Học Phần Đã Đăng Ký</title>
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
            background-color: #28a745;
            color: #fff;
        }

        .btn-custom {
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            opacity: 0.9;
        }

        .action-links a {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container">
        <h2>Danh Sách Học Phần Đã Đăng Ký</h2>
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
        <?php if (count($registeredCourses) > 0): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mã Học Phần</th>
                                <th>Tên Học Phần</th>
                                <th>Số Tín Chỉ</th>
                                <th>Ngày Đăng Ký</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registeredCourses as $course): ?>
                                <tr>
                                    <td><?php echo $course['MaHP']; ?></td>
                                    <td><?php echo $course['TenHP']; ?></td>
                                    <td><?php echo $course['SoTinChi']; ?></td>
                                    <td><?php echo $course['NgayDK']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">Bạn chưa đăng ký học phần nào!</div>
        <?php endif; ?>
        <div class="text-center action-links">
            <a href="index.php?controller=hocphan&action=index" class="btn btn-primary btn-custom mt-3">Tiếp tục Đăng Ký Học Phần</a>
            <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary btn-custom mt-3">Quay lại trang Sinh Viên</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>