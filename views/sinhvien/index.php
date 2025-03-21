<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Danh sách Sinh Viên</title>
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

        .student-img {
            max-width: 80px;
            max-height: 80px;
            border-radius: 5px;
        }

        .table thead th {
            background-color: #007bff;
            color: #fff;
            font-weight: 500;
        }

        .btn-custom {
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            opacity: 0.9;
        }

        .action-btns a {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container">
        <h2>Danh sách Sinh Viên</h2>
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

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Mã Sinh Viên</th>
                        <th>Mã Ngành</th>
                        <th>Họ Tên</th>

                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Hình Ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $sv): ?>
                        <tr>
                            <td><?php echo $sv['MaSV']; ?></td>
                            <td><?php echo $sv['MaNganh']; ?></td>
                            <td><?php echo $sv['HoTen']; ?></td>
                            <td><?php echo $sv['GioiTinh']; ?></td>
                            <td><?php echo $sv['NgaySinh']; ?></td>
                            <td class="text-center">
                                <?php if (!empty($sv['Hinh'])): ?>
                                    <img src="<?php echo $sv['Hinh']; ?>" alt="Hình ảnh" class="student-img">
                                <?php else: ?>
                                    <span class="text-muted">Không có hình ảnh</span>
                                <?php endif; ?>
                            </td>


                            <td class="action-btns">
                                <a href="index.php?controller=sinhvien&action=detail&MaSV=<?php echo $sv['MaSV']; ?>" class="btn btn-info btn-sm btn-custom">Chi tiết</a>
                                <a href="index.php?controller=sinhvien&action=edit&MaSV=<?php echo $sv['MaSV']; ?>" class="btn btn-warning btn-sm btn-custom">Sửa</a>
                                <a href="index.php?controller=sinhvien&action=delete&MaSV=<?php echo $sv['MaSV']; ?>" class="btn btn-danger btn-sm btn-custom" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="index.php?controller=cart&action=index" class="btn btn-success btn-custom">Đăng ký Học Phần</a>

            <a href="index.php?controller=sinhvien&action=create" class="btn btn-primary btn-custom">Thêm Sinh Viên</a>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
