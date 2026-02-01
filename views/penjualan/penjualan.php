<?php

session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/penjualan.php';


$db = new Database;
$penjualanModel = new Penjualan($db->conn);


$stmt = $penjualanModel->Read();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


$user = $_SESSION['user'];

if(!$user){
    // belum login
    header("Location: ../../index.php");
    exit;
}

if($user['user_status'] == 1){
    require_once "../tamplate/navbar-admin.php";
}elseif($user['user_status'] == 2){
    require_once "../tamplate/navbar-kasir.php";
}

?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data User</h3>
        <a href="create-barang.php" class="btn btn-primary btn-sm">+ Tambah User</a>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Tgl Jual</th>
                    <th>Total Harga</th>
                    <th>User ID</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                    <?php $no = 1;  foreach ($data as $row): ?>
                    
                    <?php  ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['id_barang']) ?></td>
                            <td><?= htmlspecialchars($row['tgl_jual']) ?></td>
                            <td><?= htmlspecialchars($row['total_harga']) ?></td>
                            <td><?= htmlspecialchars($row['user_id']) ?></td>
                            
                            <td class="text-center d-flex">
                                <form action="edit-barang.php" method="post" >
                                     <input type="hidden" name="id_penjualan" value="<?= $row['id_penjualan'] ?>">
                                      <button type="submit" class="btn btn-warning btn-sm mx-1" name="delete">
                                             Edit
                                    </button>
                                </form>
                                <form action="../../controller/barang.php" method="POST">
                                    <input type="hidden" name="id_penjualan" value="<?= $row['id_penjualan'] ?>">
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