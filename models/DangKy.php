<?php
// models/DangKy.php
require_once "BaseModel.php";

class DangKy extends BaseModel
{

    // Tạo đăng ký mới và trả về MaDK vừa tạo
    public function create($MaSV, $NgayDK)
    {
        $stmt = $this->conn->prepare("INSERT INTO DangKy (NgayDK, MaSV) VALUES (?, ?)");
        $stmt->bind_param("ss", $NgayDK, $MaSV);
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    // Kiểm tra xem sinh viên đã đăng ký học phần đó chưa
    public function isCourseRegistered($MaSV, $MaHP)
    {
        $sql = "SELECT COUNT(*) AS cnt 
                FROM DangKy d
                JOIN ChiTietDangKy ct ON d.MaDK = ct.MaDK
                WHERE d.MaSV = ? AND ct.MaHP = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed in isCourseRegistered: " . $this->conn->error);
        }
        $stmt->bind_param("ss", $MaSV, $MaHP);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['cnt'] > 0;
    }
}
