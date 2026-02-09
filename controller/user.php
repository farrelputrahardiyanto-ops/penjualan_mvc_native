<?php

include_once "../config/database.php";
include_once "../models/user.php";

$db = new Database;
$userModel = new User($db->conn);

if(isset($_POST['create'])){
   try {
     if($_POST['password'] == $_POST['konfirmasi_password']){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_nama = $_POST['user_nama'];
        $user_status = $_POST['status'];

        $user = $userModel->Create($username, $password, $user_nama, $user_status);

        header("location: ../views/admin/index.php");
    }
   } catch (Exception $e) {
    echo $e->getMessage();
   }
}elseif(isset($_POST['update'])){
    try {
    $id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password_baru'];
    $konfir_passsword = $_POST['konfirmasi_password'];
    $user_nama = $_POST['user_nama'];
    $user_status = $_POST['status'];

    if(!empty($password)){
       if($password == $konfir_passsword){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

         $user = $userModel->Update($id, $username, $password_hash , $user_nama, $user_status);
       }
    }elseif(empty($password)){
        $user = $userModel->UpdateWithoutNewPassword($id, $username, $user_nama, $user_status);
    }
    header("location: ../views/admin/index.php");

    } catch (Exception $e) {
    echo $e->getMessage();
   }
}elseif(isset($_POST['delete'])){
    try {
        
            $id = $_POST['user_id'];

            $user = $userModel->Delete($id);
            header("location: ../views/admin/index.php");
        
    } catch (Exception $e) {
    echo $e->getMessage();
   }
}