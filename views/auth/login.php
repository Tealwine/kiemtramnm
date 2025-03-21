<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đăng Nhập Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            margin-top: 100px;
        }

        .login-card {
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            border-radius: 8px;
        }

        .login-card h2 {
            margin-bottom: 30px;
            font-weight: 600;
            color: #333;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-custom {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0069d9;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="login-card">
                    <h2 class="text-center">Đăng Nhập Sinh Viên</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="post" action="index.php?controller=auth&action=login">
                        <div class="mb-3">
                            <label for="MaSV" class="form-label">Mã Sinh Viên</label>
                            <input type="text" name="MaSV" id="MaSV" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Đăng Nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>