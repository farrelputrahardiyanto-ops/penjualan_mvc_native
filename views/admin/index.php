<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/user.php';



$db = new Database;
$userModel = new User($db->conn);

$data = $userModel->Read();

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
        <a href="tambah.php" class="btn btn-primary btn-sm">+ Tambah User</a>
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
                    <?php $no = 1; ?>
                    
                    <?php while ($row = $data->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($u['user_nama']) ?></td>
                            
                            <td class="text-center">
                                <a href="edit.php?username=<?= $row['user_id'] ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="delete.php?username=<?= $row['user_id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin mau hapus user ini?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>