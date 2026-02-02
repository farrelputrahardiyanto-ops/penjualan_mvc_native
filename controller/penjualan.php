<?php
session_start();

require_once "../config/database.php";
require_once "../models/penjualan.php";
require_once "../models/detail_penjualan.php";
require_once "../models/barang.php";

$db = new Database;
$penjualan = new Penjualan($db->conn);
$detail = new DetailPenjualan($db->conn);
$barang = new Barang($db->conn);

// CHECKOUT
if (isset($_POST['checkout'])) {

    if (empty($_SESSION['cart'])) {
        header("Location: ../views/penjualan/index.php");
        exit;
    }

    $user = $_SESSION['user'];
    $tgl = date('Y-m-d');

    // buat header
    $id_penjualan = $penjualan->Create($tgl, 0, $user['user_id']);

    foreach ($_SESSION['cart'] as $id_barang => $item) {
        $detail->Create(
            $id_penjualan,
            $id_barang,
            $item['qty'],
            $item['harga']
        );

        $barang->KurangiStok($id_barang, $item['qty']);
    }

    // update total
    $total = $detail->HitungTotal($id_penjualan);
    $penjualan->UpdateTotal($id_penjualan, $total);

    unset($_SESSION['cart']);

    header("Location: ../views/penjualan/penjualan.php?id=$id_penjualan");
}

// UPDATE DETAIL
if (isset($_POST['update_detail'])) {
    $detail->UpdateQty($_POST['id_detail'], $_POST['qty']);
    $total = $detail->HitungTotal($_POST['id_penjualan']);
    $penjualan->UpdateTotal($_POST['id_penjualan'], $total);

    header("Location: ../views/penjualan/penjualan.php?id=".$_POST['id_penjualan']);
}

// DELETE DETAIL
if (isset($_POST['delete_detail'])) {
    $detail->Delete($_POST['id_detail']);
    $total = $detail->HitungTotal($_POST['id_penjualan']);
    $penjualan->UpdateTotal($_POST['id_penjualan'], $total);

    header("Location: ../views/penjualan/penjualan.php?id=".$_POST['id_penjualan']);
}


// UPDATE PENJUALAN
if (isset($_POST['update_penjualan'])) {
    $penjualan->Update(
        $_POST['id_penjualan'],
        $_POST['tgl_jual']
    );

    header("Location: ../views/penjualan/riwayat_penjualan.php");
}

// DELETE PENJUALAN + DETAIL
if (isset($_POST['delete_penjualan'])) {
    $id = $_POST['id_penjualan'];

    // hapus detail dulu (BIAR AMAN)
    $db->conn->prepare(
        "DELETE FROM detail_penjualan WHERE id_penjualan = ?"
    )->execute([$id]);

    $penjualan->Delete($id);

    header("Location: ../views/penjualan/riwayat_penjualan.php");
}
