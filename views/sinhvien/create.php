<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Thêm Sinh Viên</title>
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

        .btn-custom {
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card card-form">
            <h2>Thêm Sinh Viên</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <!-- Lưu ý: thêm thuộc tính enctype để hỗ trợ upload file -->
            <form method="post" action="index.php?controller=sinhvien&action=create" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="MaSV" class="form-label">Mã Sinh Viên</label>
                    <input type="text" name="MaSV" id="MaSV" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="HoTen" class="form-label">Họ Tên</label>
                    <input type="text" name="HoTen" id="HoTen" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="GioiTinh" class="form-label">Giới Tính</label>
                    <select name="GioiTinh" id="GioiTinh" class="form-select">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                    <input type="date" name="NgaySinh" id="NgaySinh" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="Hinh" class="form-label">Hình Ảnh</label>
                    <input type="file" name="Hinh" id="Hinh" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="MaNganh" class="form-label">Mã Ngành Học</label>
                    <!-- Sửa thành dropdown với 2 lựa chọn CNTT và QTKD -->
                    <select name="MaNganh" id="MaNganh" class="form-select" required>
                        <option value="">Chọn ngành học</option>
                        <option value="CNTT">CNTT</option>
                        <option value="QTKD">QTKD</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-custom">Thêm Sinh Viên</button>
                    <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary btn-custom">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>