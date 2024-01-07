<?php

// Create the class database
class Database
{
    private $host = "localhost";
    private $db_name = "api_php";
    private $username = "root";
    private $password = "root";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
            // echo "connection done";
        } catch (PDOException $e) {
            echo "connection error " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>