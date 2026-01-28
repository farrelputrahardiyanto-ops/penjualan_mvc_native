<?php


require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/user.php';


$db = new Database;
$userModel = new User($db->conn);





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
        <form action="">
            <h1 class="h1 text-center">Tambah User</h1>
            <div class="mb3">
                <label for="" class="form-label">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="mb3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb3">
                <label for="" class="form-label">Konfirmasi Password</label>
                <input type="password" name="konfirmasi_password" class="form-control">
            </div>
            <div class="mb3">
                <label for="" class="form-label">User Nama</label>
                <input type="text" name="user_nama" class="form-control">
            </div>
        </form>
    </div>
</body>
</html>