<?php


require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/barang.php';


$db = new Database;
$barangModel = new Barang($db->conn);





include_once '../tamplate/navbar-admin.php';
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container bg-body-secondary mt-5 rounded py-4">
        <form action="../../controller/create-barang.php" method="post">
            <h1 class="h1 text-center">Tambah Barang</h1>
            <div class="mb3">
                <label for="" class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control">
            </div>
            <div class="mb3">
                <label for="" class="form-label">Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control">
            </div>
            <div class="mb3">
                <label for="" class="form-label">Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control">
            </div>
            <div class="mb3">
                <label for="" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control">
            </div>
        
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>