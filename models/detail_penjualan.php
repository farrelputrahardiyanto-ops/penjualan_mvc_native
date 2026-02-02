<?php

class DetailPenjualan {
    private $conn;
    private string $table = "detail_penjualan";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function Create($id_penjualan, $id_barang, $qty, $harga)
    {
        $subtotal = $qty * $harga;

        $sql = "INSERT INTO {$this->table}
                VALUES (NULL, :penjualan, :barang, :qty, :harga, :subtotal)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':penjualan' => $id_penjualan,
            ':barang' => $id_barang,
            ':qty' => $qty,
            ':harga' => $harga,
            ':subtotal' => $subtotal
        ]);
    }

    public function ReadByPenjualan($id)
    {
        $sql = "SELECT dp.*, b.nama_barang
                FROM {$this->table} dp
                JOIN barang b ON dp.id_barang = b.id_barang
                WHERE dp.id_penjualan = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function UpdateQty($id_detail, $qty)
    {
        $sql = "UPDATE {$this->table}
                SET qty = :qty,
                    subtotal = qty * harga_jual
                WHERE id_detail = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':id', $id_detail);
        $stmt->execute();
    }

    public function Delete($id_detail)
    {
        $sql = "DELETE FROM {$this->table}
                WHERE id_detail = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_detail);
        $stmt->execute();
    }

    public function HitungTotal($id_penjualan)
    {
        $sql = "SELECT SUM(subtotal) total
                FROM {$this->table}
                WHERE id_penjualan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id_penjualan);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }
}
