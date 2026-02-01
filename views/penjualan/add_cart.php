<?php
session_start();

$id = $_POST['id_barang'];

if (!isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = [
        'nama' => $_POST['nama_barang'],
        'harga' => $_POST['harga_jual'],
        'qty' => 1
    ];
} else {
    $_SESSION['cart'][$id]['qty']++;
}

header("Location: index.php");
