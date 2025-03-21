<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Chi Tiết Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .detail-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
            background: #fff;
            padding: 20px;
        }

        .detail-card h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .detail-table th {
            width: 30%;
            background-color: #007bff;
            color: #fff;
            font-weight: 500;
        }

        .detail-table td {
            background-color: #f8f9fa;
            color: #333;
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
        <div class="card detail-card">
            <h2>Chi Tiết Sinh Viên</h2>
            <table class="table detail-table">
                <tr>
                    <th>Mã Sinh Viên</th>
                    <td><?php echo $student['MaSV']; ?></td>
                </tr>
                <tr>
                    <th>Họ Tên</th>
                    <td><?php echo $student['HoTen']; ?></td>
                </tr>
                <tr>
                    <th>Giới Tính</th>
                    <td><?php echo $student['GioiTinh']; ?></td>
                </tr>
                <tr>
                    <th>Ngày Sinh</th>
                    <td><?php echo $student['NgaySinh']; ?></td>
                </tr>
                <tr>
                    <th>Hình Ảnh</th>
                    <td>
                        <?php if (!empty($student['Hinh'])): ?>
                            <img src="<?php echo $student['Hinh']; ?>" alt="Hình ảnh" style="max-width:150px;" class="img-fluid rounded">
                        <?php else: ?>
                            Không có hình ảnh
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Mã Ngành Học</th>
                    <td><?php echo $student['MaNganh']; ?></td>
                </tr>
            </table>
            <div class="text-center">
                <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary btn-custom">Quay lại</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>