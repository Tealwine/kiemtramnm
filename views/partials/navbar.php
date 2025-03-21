<!-- views/partials/navbar.php -->
<style>
    .navbar-custom {
        background: linear-gradient(135deg, #007bff, #0056b3);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-custom .nav-link {
        color: #fff !important;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .navbar-custom .nav-link:hover {
        color: #d1e9ff !important;
    }

    .navbar-custom .navbar-brand {
        font-weight: bold;
        color: #fff !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="index.php">Quản Lý Sinh Viên</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=sinhvien&action=index">Sinh Viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=hocphan&action=index">Học Phần</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=cart&action=index">Đăng ký học phần</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=cart&action=registered">Học phần đã đăng ký</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=auth&action=logout">Đăng Xuất</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=auth&action=login">Đăng Nhập</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>