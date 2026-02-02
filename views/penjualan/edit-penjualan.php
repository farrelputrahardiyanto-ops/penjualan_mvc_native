<?php
session_start();

require_once "../../config/database.php";
require_once "../../models/penjualan.php";
require_once "../../models/detail_penjualan.php";

if (!isset($_GET['id'])) {
    header("Location: riwayat_penjualan.php");
    exit;
}

$db = new Database;
$penjualan = new Penjualan($db->conn);
$detail = new DetailPenjualan($db->conn);

$data = $penjualan->FindById($_GET['id']);
$details = $detail->GetByPenjualan($_GET['id'])->fetchAll(PDO::FETCH_ASSOC);

if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}

require_once "../tamplate/navbar-admin.php";
?>

<div class="container mt-4">
    <h4>Edit Penjualan</h4>

    <!-- EDIT HEADER -->
    <form action="../../controller/penjualan.php" method="post" class="mb-4">
        <input type="hidden" name="id_penjualan" value="<?= $data['id_penjualan'] ?>">

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tgl_jual"
                   class="form-control"
                   value="<?= $data['tgl_jual'] ?>" required>
        </div>

        <button type="submit" name="update_penjualan" class="btn btn-primary">
            Simpan Tanggal
        </button>
    </form>

    <!-- DETAIL BARANG -->
    <h5>Detail Barang</h5>
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Barang</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($details as $d): ?>
            <tr>
                <td><?= $d['nama_barang'] ?></td>
                <td>
                    <form action="../../controller/penjualan.php"
                          method="post"
                          class="d-flex gap-1">
                        <input type="hidden" name="id_detail" value="<?= $d['id_detail'] ?>">
                        <input type="hidden" name="id_penjualan" value="<?= $data['id_penjualan'] ?>">

                        <input type="number"
                               name="qty"
                               value="<?= $d['qty'] ?>"
                               min="1"
                               class="form-control form-control-sm"
                               style="width:80px">

                        <button name="update_detail"
                                class="btn btn-success btn-sm">
                            Update
                        </button>
                    </form>
                </td>
                <td>Rp <?= number_format($d['harga_jual']) ?></td>
                <td>Rp <?= number_format($d['subtotal']) ?></td>
                <td>
                    <form action="../../controller/penjualan.php"
                          method="post"
                          onsubmit="return confirm('Hapus item ini?')">
                        <input type="hidden" name="id_detail" value="<?= $d['id_detail'] ?>">
                        <input type="hidden" name="id_penjualan" value="<?= $data['id_penjualan'] ?>">
                        <button name="delete_detail"
                                class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <a href="riwayat_penjualan.php" class="btn btn-secondary">Kembali</a>
</div>
