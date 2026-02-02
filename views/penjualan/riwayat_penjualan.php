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

<div class="container mt-4">
    <h4>Riwayat Penjualan</h4>

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Barang</th>
            <th>Total</th>
            <th>Aksi</th>
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
