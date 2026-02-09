<?php
session_start();
require_once "../../config/database.php";
require_once "../../models/penjualan.php";

if (!isset($_GET['dari'], $_GET['sampai'])) {
    die("Tanggal tidak valid");
}

$db = new Database;
$penjualan = new Penjualan($db->conn);

$dari = $_GET['dari'];
$sampai = $_GET['sampai'];

$stmt = $penjualan->ReadRiwayatByTanggal($dari, $sampai);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Riwayat Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="text-center mb-4">
        <h4>LAPORAN RIWAYAT PENJUALAN</h4>
        <p>Periode: <?= $dari ?> s/d <?= $sampai ?></p>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Barang</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1; 
        $grandTotal = 0;
        foreach ($data as $row): 
            $grandTotal += $row['total_harga'];
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['tgl_jual'] ?></td>
            <td><?= $row['user_nama'] ?></td>
            <td><?= $row['barang'] ?></td>
            <td>Rp <?= number_format($row['total_harga']) ?></td>
        </tr>
        <?php endforeach ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="4" class="text-end">Grand Total</th>
            <th>Rp <?= number_format($grandTotal) ?></th>
        </tr>
        </tfoot>
    </table>

    <div class="no-print mt-3">
    <a onclick="window.history.back()" href="riwayat_penjualan.php"  class="btn btn-secondary">
        ← Kembali
        </a>

    <button onclick="window.print()" class="btn btn-primary">
        Cetak
    </button>
</div>

</div>

</body>
</html>
