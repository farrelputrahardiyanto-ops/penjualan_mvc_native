<?php
session_start();

require_once "../../config/database.php";
require_once "../../models/penjualan.php";

if (!isset($_GET['id'])) {
    header("Location: riwayat.php");
    exit;
}

$db = new Database;
$penjualan = new Penjualan($db->conn);

$data = $penjualan->FindById($_GET['id']);
if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}

require_once "../tamplate/navbar-admin.php";
?>

<div class="container mt-4">
    <h4>Edit Penjualan</h4>

    <form action="../../controller/penjualan.php" method="post">
        <input type="hidden" name="id_penjualan"
               value="<?= $data['id_penjualan'] ?>">

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tgl_jual"
                   class="form-control"
                   value="<?= $data['tgl_jual'] ?>" required>
        </div>

        <button type="submit"
                name="update_penjualan"
                class="btn btn-primary">
            Simpan
        </button>

        <a href="riwayat.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
