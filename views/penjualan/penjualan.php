<?php
session_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/penjualan.php';
require_once __DIR__ . '/../../models/detail_penjualan.php';

$db = new Database;
$penjualanModel = new Penjualan($db->conn);
$detailModel    = new DetailPenjualan($db->conn);

// ================= AUTH =================
$user = $_SESSION['user'] ;


if(!$user){
    // belum login
    header("Location: ../../index.php");
    exit;
}

if($user['user_status'] == 1){
    require_once "../tamplate/navbar-admin.php";
}elseif($user['user_status'] == 2){
    require_once "../tamplate/navbar-kasir.php";
}

// ================= GET ID =================
if (!isset($_GET['id'])) {
    echo "ID penjualan tidak ditemukan";
    exit;
}

$id_penjualan = $_GET['id'];


// ================= DATA =================
$penjualan = $penjualanModel->FindById($id_penjualan);
$data      = $detailModel->ReadByPenjualan($id_penjualan);
?>

<div class="container mt-4">
    <h4>Detail Penjualan</h4>

    <p>
        <strong>Tanggal:</strong> <?= $penjualan['tgl_jual'] ?><br>
        <strong>Total:</strong> Rp <?= number_format($penjualan['total_harga']) ?>
    </p>

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($data)): ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
        <?php endif; ?>

        <?php $no = 1; foreach ($data as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td>
                <form action="../../controller/penjualan.php" method="post" class="d-flex gap-1">
                    <input type="hidden" name="id_detail" value="<?= $row['id_detail'] ?>">
                    <input type="hidden" name="id_penjualan" value="<?= $row['id_penjualan'] ?>">
                    <input type="number" name="qty" value="<?= $row['qty'] ?>"
                           min="1" class="form-control form-control-sm" style="width:70px">
                    <button type="submit" name="update_detail"
                            class="btn btn-warning btn-sm">
                        Update
                    </button>
                </form>
            </td>
            <td>Rp <?= number_format($row['harga_jual']) ?></td>
            <td>Rp <?= number_format($row['subtotal']) ?></td>
            <td>
                <form action="../../controller/penjualan.php" method="post"
                      onsubmit="return confirm('Hapus item ini?')">
                    <input type="hidden" name="id_detail" value="<?= $row['id_detail'] ?>">
                    <input type="hidden" name="id_penjualan" value="<?= $row['id_penjualan'] ?>">
                    <button type="submit" name="delete_detail"
                            class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="riwayat_penjualan.php" class="btn btn-primary center">Selesai</a>
</div>
