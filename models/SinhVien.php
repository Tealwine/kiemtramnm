<?php
// models/SinhVien.php
require_once "BaseModel.php";

class SinhVien extends BaseModel
{

    // Lấy tất cả sinh viên
    public function getAll()
    {
        $sql = "SELECT * FROM SinhVien";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Lấy chi tiết sinh viên theo MaSV
    public function getById($MaSV)
    {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
        $stmt->bind_param("s", $MaSV);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Tạo mới sinh viên
    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $data['MaSV'], $data['HoTen'], $data['GioiTinh'], $data['NgaySinh'], $data['Hinh'], $data['MaNganh']);
        return $stmt->execute();
    }

    // Cập nhật sinh viên
    public function update($data)
    {
        $stmt = $this->conn->prepare("UPDATE SinhVien SET HoTen=?, GioiTinh=?, NgaySinh=?, Hinh=?, MaNganh=? WHERE MaSV=?");
        $stmt->bind_param("ssssss", $data['HoTen'], $data['GioiTinh'], $data['NgaySinh'], $data['Hinh'], $data['MaNganh'], $data['MaSV']);
        return $stmt->execute();
    }

    // Xóa sinh viên
    public function delete($MaSV)
    {
        $stmt = $this->conn->prepare("DELETE FROM SinhVien WHERE MaSV = ?");
        $stmt->bind_param("s", $MaSV);
        return $stmt->execute();
    }
}
