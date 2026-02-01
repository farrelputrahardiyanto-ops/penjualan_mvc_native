<?php
session_start();

include_once "../config/database.php";
include_once "../models/penjualan.php";
include_once "../models/barang.php";

$db = new Database;
$penjualanModel = new Penjualan($db->conn);
$barangModel = new Barang($db->conn);

// checkout transaksi
if (isset($_POST['checkout'])) {
    try {

        if (empty($_SESSION['cart'])) {
            header("location: ../views/penjualan/index.php");
            exit;
        }

        $user = $_SESSION['user'];

        $user_id = $user['user_id']; // dari session login
        $tgl_jual = date('Y-m-d');

        foreach ($_SESSION['cart'] as $id_barang => $item) {

            $total_harga = $item['qty'] * $item['harga'];

            // insert penjualan
            $penjualanModel->Create(
                $id_barang,
                $tgl_jual,
                $total_harga,
                $user_id
            );

            // update stok barang
            $barangModel->KurangiStok($id_barang, $item['qty']);
        }

        unset($_SESSION['cart']);

        header("location: ../views/penjualan/index.php");

    } catch (Throwable $th) {
        echo "Error: " . $th->getMessage();
    }
}