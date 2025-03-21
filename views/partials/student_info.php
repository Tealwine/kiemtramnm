<?php
// views/partials/student_info.php
if (isset($_SESSION['user'])) {
    require_once __DIR__ . '/../../models/SinhVien.php';
    $svModel = new SinhVien();
    $student = $svModel->getById($_SESSION['user']);
    if ($student):
?>
        <style>
            .student-card {
                margin-bottom: 30px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border: none;
                border-radius: 8px;
                background: #fff;
            }

            .student-card .card-header {
                background: #007bff;
                color: #fff;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }

            .student-card img {
                max-width: 100%;
                border-radius: 8px;
            }

            .student-card .info-label {
                font-weight: 600;
                color: #555;
            }

            .student-card .info-value {
                color: #333;
            }
        </style>
        <div class="card student-card">
            <div class="card-header">
                <h5 class="mb-0">Thông Tin Sinh Viên</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <?php if (!empty($student['Hinh'])): ?>
                            <img src="<?php echo $student['Hinh']; ?>" alt="Hình ảnh sinh viên" class="img-fluid">
                        <?php else: ?>
                            <img src="default.png" alt="No Image" class="img-fluid">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-9">
                        <p><span class="info-label">Mã Sinh Viên:</span> <span class="info-value"><?php echo $student['MaSV']; ?></span></p>
                        <p><span class="info-label">Họ Tên:</span> <span class="info-value"><?php echo $student['HoTen']; ?></span></p>
                        <p><span class="info-label">Giới Tính:</span> <span class="info-value"><?php echo $student['GioiTinh']; ?></span></p>
                        <p><span class="info-label">Ngày Sinh:</span> <span class="info-value"><?php echo $student['NgaySinh']; ?></span></p>
                        <p><span class="info-label">Mã Ngành Học:</span> <span class="info-value"><?php echo $student['MaNganh']; ?></span></p>
                    </div>
                </div>
            </div>
        </div>
<?php
    else:
        echo "<div class='alert alert-info'>Không tìm thấy thông tin sinh viên.</div>";
    endif;
}
?>