<?php

include_once '../config/database.php';
include_once '../models/barang.php';

    $db = new Database;
    $barangModel =  new Barang($db->conn);

if(isset($_POST['create'])){
    try {
           

    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    $barang = $barangModel->Create($nama_barang, $harga_beli, $harga_jual, $stok);

    header("location: ../views/admin/barang.php");
    } catch (\Throwable $th) {
        //throw $th;
    }
 
}elseif(isset($_POST['update'])){
    try {
    $id = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    $barang = $barangModel->Update($id, $nama_barang, $harga_beli, $harga_jual, $stok);

    header("location: ../views/admin/barang.php");
    } catch (\Throwable $th) {
        //throw $th;
    }

   

}elseif(isset($_POST['delete'])){
    try {
        $id = $_POST['id_barang'];

        $barang = $barangModel->Delete($id);

        header("location: ../views/admin/barang.php");
    } catch (\Throwable $th) {
        //throw $th;
    }
}