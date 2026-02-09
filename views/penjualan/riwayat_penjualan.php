<?php
session_start();

require_once "../../config/database.php";
require_once "../../models/penjualan.php";

$user = $_SESSION['user'] ?? null;
if (!$user) {
    header("Location: ../../index.php");
    exit;
}

$db = new Database;
$penjualan = new Penjualan($db->conn);

$stmt = $penjualan->ReadRiwayat();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once ($user['user_status'] == 1)
    ? "../tamplate/navbar-admin.php"
    : "../tamplate/navbar-kasir.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Riwayat Penjualan</h3>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCetak">
    Cetak Riwayat
</button>
    </div>


    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Barang</th>
            <th>Total</th>
            <th width="150">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($data as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['tgl_jual'] ?></td>
            <td><?= $row['user_nama'] ?></td>
            <td><?= $row['barang'] ?></td>
            <td>Rp <?= number_format((int)$row['total_harga']) ?></td>
            <td>
                <a href="edit-penjualan.php?id=<?= $row['id_penjualan'] ?>"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="../../controller/penjualan.php"
                      method="post"
                      style="display:inline"
                      onsubmit="return confirm('Hapus transaksi ini?')">
                    <input type="hidden" name="id_penjualan"
                           value="<?= $row['id_penjualan'] ?>">
                    <button type="submit"
                            name="delete_penjualan"
                            class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalCetak" tabindex="-1">
  <div class="modal-dialog">
    <form action="cetak-riwayat.php" method="get" target="_blank">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cetak Riwayat Penjualan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label>Dari Tanggal</label>
            <input type="date" name="dari" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Sampai Tanggal</label>
            <input type="date" name="sampai" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-success">Cetak</button>
        </div>
      </div>
    </form>
  </div>
</div>

