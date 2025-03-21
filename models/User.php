<?php
// models/User.php
require_once "BaseModel.php";

class User extends BaseModel
{

    // Xác thực đăng nhập
    public function login($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password); // Lưu ý: password nên được mã hoá
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
