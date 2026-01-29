<?php

include_once "../config/database.php";
include_once "../models/user.php";


$id = $_GET['user_id'];

$db = new Database;
$userModel = new User($db->conn);

$user = $userModel->Delete($id);