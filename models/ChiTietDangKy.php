<?php
// models/ChiTietDangKy.php
require_once "BaseModel.php";

class ChiTietDangKy extends BaseModel
{

    // Lưu chi tiết đăng ký cho một học phần
    public function create($MaDK, $MaHP)
    {
        $stmt = $this->conn->prepare("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)");
        $stmt->bind_param("is", $MaDK, $MaHP);
        return $stmt->execute();
    }
}
