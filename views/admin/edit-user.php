<?php


require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/user.php';


$db = new Database;
$userModel = new User($db->conn);

$id = $_GET['user_id'];

$read = $userModel->ReadById($id);
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
        <form action="../../controller/update-user.php" method="post">
                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">

            <h1 class="h1 text-center">Edit User</h1>
            <div class="mb3">
                <label for="" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>">
            </div>
            <div class="mb3">
                <label for="" class="form-label">Password Baru</label>
                <input type="password" name="password_baru" class="form-control">
            </div>
            <div class="mb3">
                <label for="" class="form-label">Konfirmasi Password</label>
                <input type="password" name="konfirmasi_password" class="form-control">
            </div>
            <div class="mb3">
                <label for="" class="form-label">User Nama</label>
                <input type="text" name="user_nama" class="form-control" value="<?=  $row['user_nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <select name="status" aria-label="Default select example" id="" class="form-select">
                    <option selected></option>
                    <option value="1">Admin</option>
                    <option value="2">Kasir</option>
                </select>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </form>
    </div>

    <?php endforeach; ?>
</body>
</html>