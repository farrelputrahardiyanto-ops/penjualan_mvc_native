<?php


class Database{

    private string $host = "localhost";
    private string $db = "db_penjualan";
    private string $user = "root";
    private string $pass = "";


    public $conn;


    public function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host}; dbname={$this->db}",
                $this->user,
                $this->pass
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;

        } catch (Exception $e) {
            echo ("Koneksi Gagal: ". $e->getMessage());
        }
    }
}