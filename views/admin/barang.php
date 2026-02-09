<?php
session_start();


require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/barang.php';



$db = new Database;
$barangModel = new Barang($db->conn);

$stmt = $barangModel->Read();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


include_once "../tamplate/navbar-admin.php";

?>




<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Barang</h3>
        <a href="create-barang.php" class="btn btn-primary btn-sm">+ Tambah Barang</a>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                    <?php $no = 1;  foreach ($data as $row): ?>
                    
                    <?php  ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                            <td>Rp <?= htmlspecialchars( number_format($row['harga_beli']) ) ?></td>
                            <td>Rp <?= htmlspecialchars( number_format($row['harga_jual']) ) ?></td>
                            <td><?= htmlspecialchars($row['stok']) ?></td>
                            
                            <td class="text-center d-flex">
                                <form action="edit-barang.php" method="post" >
                                     <input type="hidden" name="id_barang" value="<?= $row['id_barang'] ?>">
                                      <button type="submit" class="btn btn-warning btn-sm mx-1" name="delete">
                                             Edit
                                    </button>
                                </form>
                                <form action="../../controller/barang.php" method="POST">
                                    <input type="hidden" name="id_barang" value="<?= $row['id_barang'] ?>">
                                     <button type="submit" class="btn btn-danger btn-sm mx-1" name="delete" onclick="return confirm('Yakin hapus?')">
                                             Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php  endforeach;  ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>