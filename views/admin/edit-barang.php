<?php


require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/barang.php';


$db = new Database;
$barangModel = new Barang($db->conn);

$id = $_GET['id'];

$read = $barangModel->ReadById($id);
$data = $read->fetchAll(PDO::FETCH_ASSOC);









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
    <?php  foreach($data as $row): ?>
    <div class="container bg-body-secondary mt-5 rounded py-4">
        <form action="../../controller/update-barang.php" method="post">
                <input type="hidden" name="id_barang" value="<?= $row['id_barang'] ?>">

            <h1 class="h1 text-center">Edit User</h1>
            <div class="mb3">
                <label for="" class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="<?= $row['nama_barang'] ?>">
            </div>
            <div class="mb3">
                <label for="" class="form-label">Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" value="<?=  $row['harga_beli'] ?>">
            </div>
            <div class="mb3">
                <label for="" class="form-label">Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" value="<?=  $row['harga_jual'] ?>">
            </div>
             <div class="mb3">
                <label for="" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="<?=  $row['stok'] ?>">
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </form>
    </div>

    <?php endforeach; ?>
</body>
</html>