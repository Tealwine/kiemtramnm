<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đăng ký Học Phần</title>
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

        .course-card {
            margin-bottom: 20px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
            transition: transform 0.2s;
            background: #fff;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 20px;
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
    <div class="container">
        <h2>Danh sách Học Phần</h2>
        <div class="text-center mb-4">
            <a href="index.php?controller=cart&action=index" class="btn btn-success btn-custom">Xem Giỏ Hàng</a>
        </div>
        <div class="row">
            <?php foreach ($courses as $course): ?>
                <div class="col-md-4 course-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $course['TenHP']; ?></h5>
                            <p class="card-text">Số Tín Chỉ: <?php echo $course['SoTinChi']; ?></p>
                            <p class="card-text">Số lượng dự kiến: <?php echo isset($course['SoLuongSV']) ? $course['SoLuongSV'] : 'N/A'; ?></p>
                            <form method="post" action="index.php?controller=cart&action=index">
                                <input type="hidden" name="MaHP" value="<?php echo $course['MaHP']; ?>">
                                <input type="hidden" name="TenHP" value="<?php echo $course['TenHP']; ?>">
                                <input type="hidden" name="SoTinChi" value="<?php echo $course['SoTinChi']; ?>">
                                <button type="submit" class="btn btn-primary btn-custom">Đăng ký</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary btn-custom">Quay lại trang Sinh Viên</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>