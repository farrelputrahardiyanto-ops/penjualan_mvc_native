<?php


class Penjualan{

    public $conn;
    private string $table = "penjualan";

    public int $id_penjualan;
    public string $id_barang;
    public string $tgl_jual;
    public int $total_harga;
    public int $user_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //read
    public function Read(){
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }


    // create penjualan
    public function Create($id_barang, $tgl_jual, $total_harga, $user_id)
    {
        $sql = "INSERT INTO {$this->table}
                (id_barang, tgl_jual, total_harga, user_id)
                VALUES (:id_barang, :tgl_jual, :total_harga, :user_id)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id_barang', $id_barang);
        $stmt->bindParam(':tgl_jual', $tgl_jual);
        $stmt->bindParam(':total_harga', $total_harga);
        $stmt->bindParam(':user_id', $user_id);

        $stmt->execute();
        return $stmt;
    }



     // read by id
    public function ReadById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_penjualan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    // delete (optional)
    public function Delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id_penjualan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

     public function AnotherRead()
    {
        $sql = "SELECT p.*, b.nama_barang, u.username
                FROM penjualan p
                JOIN barang b ON p.id_barang = b.id_barang
                JOIN user u ON p.user_id = u.user_id
                ORDER BY p.id_penjualan DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }





}