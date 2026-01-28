<?php

include_once "../config/database.php";
include_once "../models/user.php";

$db = new Database;
$userModel = new User($db->conn);

if(isset($_POST['submit'])){
    if($_POST['password'] == $_POST['konfirmasi_password']){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_nama = $_POST['user_nama'];
        $user_status = $_POST['status'];

        $user = $userModel->Create($username, $password, $user_nama, $user_status);
    }
}