<?php

class Penjualan {
    private $conn;
    private string $table = "penjualan";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create header transaksi
    public function Create($tgl_jual, $total_harga, $user_id)
    {
        $sql = "INSERT INTO {$this->table} 
                (tgl_jual, total_harga, user_id)
                VALUES (:tgl, :total, :user)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tgl', $tgl_jual);
        $stmt->bindParam(':total', $total_harga);
        $stmt->bindParam(':user', $user_id);
        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    // ambil 1 transaksi
    public function FindById($id)
    {
        $sql = "SELECT * FROM {$this->table}
                WHERE id_penjualan = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // list transaksi
    public function Read()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id_penjualan DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // update total
    public function UpdateTotal($id, $total)
    {
        $sql = "UPDATE {$this->table}
                SET total_harga = :total
                WHERE id_penjualan = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }


    // RIWAYAT PENJUALAN (JOIN SEMUA)
public function ReadRiwayat()
{
    $sql = "SELECT 
                p.id_penjualan,
                p.tgl_jual,
                p.total_harga,
                u.user_nama,
                GROUP_CONCAT(
                    CONCAT(b.nama_barang, ' (', dp.qty, ')')
                    SEPARATOR ', '
                ) AS barang
            FROM penjualan p
            JOIN user u ON p.user_id = u.user_id
            JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan
            JOIN barang b ON dp.id_barang = b.id_barang
            GROUP BY p.id_penjualan
            ORDER BY p.id_penjualan DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
}

// UPDATE HEADER PENJUALAN
public function Update($id, $tgl_jual)
{
    $sql = "UPDATE penjualan 
            SET tgl_jual = :tgl 
            WHERE id_penjualan = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':tgl', $tgl_jual);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// DELETE TRANSAKSI (HEADER)
public function Delete($id)
{
    $sql = "DELETE FROM penjualan WHERE id_penjualan = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

public function ReadRiwayatByTanggal($dari, $sampai)
{
    $sql = "SELECT 
                p.id_penjualan,
                p.tgl_jual,
                p.total_harga,
                u.user_nama,
                GROUP_CONCAT(
                    CONCAT(b.nama_barang, ' (', dp.qty, ')')
                    SEPARATOR ', '
                ) AS barang
            FROM penjualan p
            JOIN user u ON p.user_id = u.user_id
            JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan
            JOIN barang b ON dp.id_barang = b.id_barang
            WHERE p.tgl_jual BETWEEN :dari AND :sampai
            GROUP BY p.id_penjualan
            ORDER BY p.tgl_jual ASC";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':dari', $dari);
    $stmt->bindParam(':sampai', $sampai);
    $stmt->execute();
    return $stmt;
}


}
