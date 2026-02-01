<?php
session_start();

$id = $_POST['id_barang'];
$qty = $_POST['qty'];

if ($qty > 0) {
    $_SESSION['cart'][$id]['qty'] = $qty;
}

header("Location: index.php");
