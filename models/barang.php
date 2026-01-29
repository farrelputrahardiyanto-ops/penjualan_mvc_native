<?php


class Barang{

    public $conn;
    private string $table = "barang";

    public string $id_barang;
    public string $nama_barang;
    public int $harga_beli;
    public int $harga_jual;
    public int $stok;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //create
    public function Create($nama_barang, $harga_beli, $harga_jual, $stok){
        $query = "INSERT INTO {$this->table} VALUES (NULL, :nama_barang, :harga_beli, :harga_jual, :stok)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama_barang", $nama_barang);
        $stmt->bindParam(":harga_beli", $harga_beli);
        $stmt->bindParam(":harga_jual", $harga_jual);
        $stmt->bindParam(":stok", $stok);

        return $stmt->execute();

    }

    //update
    public function Update($id, $nama_barang, $harga_beli, $harga_jual, $stok){
        $query = "UPDATE {$this->table} SET harga_beli = :harga_beli,
                                        harga_jual = :harga_jual,
                                        stok = :stok 
                                        WHERE id_barang = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam("harga_beli", $harga_beli);
        $stmt->bindParam("harga_jual", $harga_jual);
        $stmt->bindParam("stok", $stok);

        $stmt->execute();

        return $stmt;
        
        
    }



    //read
    public function Read(){
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    //read by id
    public function ReadById($id){
        $query = "SELECT * FROM {$this->table} WHERE id_barang = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();
        return $stmt;
    }


    
    //delete
    public function Delete($id){
        $query = "DELETE FROM {$this->table} WHERE id_barang = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam("id", $id);

        $stmt->execute();

        return $stmt;

    }

}