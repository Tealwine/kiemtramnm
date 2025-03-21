<?php
// models/BaseModel.php
class BaseModel
{
    protected $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../config/db.php';
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getConn()
    {
        return $this->conn;
    }
}
