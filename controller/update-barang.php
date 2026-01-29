<?php

include_once '../config/database.php';
include_once '../models/barang.php';

if(isset($_POST['submit'])){
    $db = new Database;
    $barangModel =  new Barang($db->conn);

    $id = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    $barang = $barangModel->Update($id, $nama_barang, $harga_beli, $harga_jual, $stok);
}