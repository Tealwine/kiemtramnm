<?php
// models/HocPhan.php
require_once "BaseModel.php";

class HocPhan extends BaseModel
{

    // Lấy tất cả học phần
    public function getAll()
    {
        $sql = "SELECT * FROM HocPhan";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Cập nhật số lượng dự kiến sinh viên (giả sử cột SoLuongSV tồn tại)
    public function updateSoLuongSV($MaHP, $soLuong)
    {
        $stmt = $this->conn->prepare("UPDATE HocPhan SET SoLuongSV = SoLuongSV - ? WHERE MaHP = ?");
        $stmt->bind_param("is", $soLuong, $MaHP);
        return $stmt->execute();
    }
}
