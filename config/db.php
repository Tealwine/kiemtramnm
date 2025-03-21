<?php
// config/db.php
class Database
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "test1"; // cập nhật tên database
    public $conn;

    public function getConnection()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
        mysqli_set_charset($this->conn, "utf8");
        return $this->conn;
    }
}
