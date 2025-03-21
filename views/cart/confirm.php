<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Xác Nhận Đăng Ký Học Phần</title>
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

        .summary-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
            background: #fff;
            padding: 20px;
            margin-bottom: 30px;
        }

        .summary-card h4 {
            margin-bottom: 20px;
            color: #007bff;
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
    </style>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <?php
    if (!isset($notRegistered) || !is_array($notRegistered)) {
        $notRegistered = [];
    }
    ?>

    <div class="container">
        <h2>Xác Nhận Đăng Ký Học Phần</h2>
        <!-- Hiển thị thông tin sinh viên -->
        <?php include_once __DIR__ . '/../partials/student_info.php'; ?>

        <!-- Nếu có học phần đã đăng ký trước đó, hiển thị cảnh báo -->
        <?php if (!empty($alreadyRegistered)): ?>
            <div class="alert alert-warning">
                Các học phần sau đã được đăng ký trước đó: <strong><?php echo implode(', ', array_keys($alreadyRegistered)); ?></strong>
            </div>
        <?php endif; ?>

        <div class="summary-card">
            <h4>Tóm tắt đăng ký</h4>
            <p><strong>Tổng số môn cần đăng ký:</strong> <?php echo $totalCourses; ?></p>
            <p><strong>Tổng số tín chỉ cần đăng ký:</strong> <?php echo $totalCredits; ?></p>
            <hr>
            <h5>Danh sách học phần cần đăng ký:</h5>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã Học Phần</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Số Lượng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notRegistered as $MaHP => $course): ?>
                        <tr>
                            <td><?php echo $MaHP; ?></td>
                            <td><?php echo $course['TenHP']; ?></td>
                            <td><?php echo $course['SoTinChi']; ?></td>
                            <td><?php echo $course['quantity']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <?php if (!empty($notRegistered)): ?>
                <form method="post" action="index.php?controller=cart&action=confirm">
                    <button type="submit" name="confirm_registration" class="btn btn-success btn-custom">Xác Nhận Đăng Ký</button>
                </form>
            <?php else: ?>
                <div class="alert alert-info">Tất cả các học phần trong giỏ đã được đăng ký. Không có học phần nào cần đăng ký thêm.</div>
            <?php endif; ?>
            <a href="index.php?controller=cart&action=index" class="btn btn-secondary btn-custom mt-3">Quay lại giỏ hàng</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
