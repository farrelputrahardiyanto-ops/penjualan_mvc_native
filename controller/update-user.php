<?php


include_once "../config/database.php";
include_once "../models/user.php";


$db = new Database;
$userModel = new User($db->conn);

if(isset($_POST['submit'])){
    $id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password_baru'];
    $konfir_passsword = $_POST['konfirmasi_password'];
    $user_nama = $_POST['user_nama'];
    $user_status = $_POST['status'];

    if($password == $konfir_passsword){
        $user = $userModel->Update($id, $username, $password, $user_nama, $user_status);
    }
}