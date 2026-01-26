<?php

session_start();

include_once "../config/database.php";
include_once "../models/user.php";

$db = new Database;

$userModel =  new User($db->conn);

$username = $_POST['username'];
$password = $_POST['password'];

$user = $userModel->Login($username, $password);

if($user){
    $_SESSION['user'] = $user;

    if($user['user_status'] == 1){
        header("Location: ../views/admin/index.php");
    }elseif($user['user_status'] == 2){
        header("Location: ../views/kasir/index.php");
    }

}