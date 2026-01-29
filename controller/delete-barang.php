<?php

include_once '../config/database.php';
include_once '../models/barang.php';

$db = new Database;
$barangModel = new Barang($db->conn);

$id = $_GET['id'];

$barang = $barangModel->Delete($id);