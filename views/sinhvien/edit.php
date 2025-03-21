<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sửa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card-form {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
            background: #fff;
            padding: 30px;
        }

        .card-form h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .form-label {
            font-weight: 500;
        }

        .img-preview {
            max-width: 150px;
            border-radius: 5px;
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
        <div class="card card-form">
            <h2>Sửa Thông Tin Sinh Viên</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post" action="index.php?controller=sinhvien&action=edit&MaSV=<?php echo $student['MaSV']; ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="MaSV" class="form-label">Mã Sinh Viên</label>
                    <input type="text" name="MaSV" id="MaSV" class="form-control" value="<?php echo $student['MaSV']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="HoTen" class="form-label">Họ Tên</label>
                    <input type="text" name="HoTen" id="HoTen" class="form-control" value="<?php echo $student['HoTen']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="GioiTinh" class="form-label">Giới Tính</label>
                    <select name="GioiTinh" id="GioiTinh" class="form-select">
                        <option value="Nam" <?php if ($student['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php if ($student['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                    <input type="date" name="NgaySinh" id="NgaySinh" class="form-control" value="<?php echo $student['NgaySinh']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="Hinh" class="form-label">Hình Ảnh</label>
                    <?php if (!empty($student['Hinh'])): ?>
                        <div class="mb-2">
                            <img src="<?php echo $student['Hinh']; ?>" alt="Hình ảnh" class="img-preview">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="Hinh" id="Hinh" class="form-control">
                    <small class="text-muted">Chọn file để thay đổi hình ảnh, nếu không thì giữ nguyên ảnh hiện tại.</small>
                </div>
                <div class="mb-3">
                    <label for="MaNganh" class="form-label">Mã Ngành Học</label>
                    <select name="MaNganh" id="MaNganh" class="form-select" required>
                        <option value="CNTT" <?php if ($student['MaNganh'] == 'CNTT') echo 'selected'; ?>>CNTT</option>
                        <option value="QTKD" <?php if ($student['MaNganh'] == 'QTKD') echo 'selected'; ?>>QTKD</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-custom">Cập Nhật</button>
                    <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary btn-custom">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>