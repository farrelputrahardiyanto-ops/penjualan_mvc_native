<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/user.php';



$db = new Database;
$userModel = new User($db->conn);

$stmt = $userModel->Read();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


include_once "../tamplate/navbar-admin.php";

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
        <a href="create-user.php" class="btn btn-primary btn-sm">+ Tambah User</a>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                    <?php $no = 1;  foreach ($data as $row): ?>
                    
                    <?php  ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['user_nama']) ?></td>
                            <td><?php if($row['user_status'] == 1){
                                $status = "Admin";
                                 }elseif($row['user_status'] == 2){
                                    $status = "Kasir";
                                    }    echo $status;?></td>
                            
                            <td class="text-center">
                                <a href="edit-user.php?user_id=<?= $row['user_id'] ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="delete.php?user_id=<?= $row['user_id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin mau hapus user ini?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php  endforeach;  ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>