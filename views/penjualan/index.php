<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/barang.php';

$db = new Database();

$barangModel = new Barang($db->conn);

// ambil barang
$stmt = $barangModel->Read();
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);



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





if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid mt-4 px-5">
    <div class="row">

        <!-- KIRI : PRODUK -->
        <div class="col-md-8">
            <h4>Daftar Barang</h4>
            <div class="row">

                <?php foreach ($barang as $b): ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= $b['nama_barang'] ?></h5>
                            <p class="mb-1">Harga: <b>Rp <?= number_format($b['harga_jual']) ?></b></p>
                            <p class="mb-2">Stok: <?= $b['stok'] ?></p>

                            <form action="add_cart.php" method="post">
                                <input type="hidden" name="id_barang" value="<?= $b['id_barang'] ?>">
                                <input type="hidden" name="nama_barang" value="<?= $b['nama_barang'] ?>">
                                <input type="hidden" name="harga_jual" value="<?= $b['harga_jual'] ?>">
                                <button class="btn btn-primary btn-sm w-100"
                                    <?= $b['stok'] == 0 ? 'disabled' : '' ?>>
                                    + Tambah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- KANAN : KERANJANG -->
        <div class="col-md-4">
            <h4>Transaksi</h4>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $grandTotal = 0; ?>
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                    <?php
                        $total = $item['qty'] * $item['harga'];
                        $grandTotal += $total;
                    ?>
                    <tr>
                        <td><?= $item['nama'] ?></td>
                        <td>
                            <form action="update_cart.php" method="post">
                                <input type="hidden" name="id_barang" value="<?= $id ?>">
                                <input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" class="form-control form-control-sm">
                                <button class="btn btn-sm btn-warning mt-1 w-100">Update</button>
                            </form>
                        </td>
                        <td>Rp <?= number_format($total) ?></td>
                        <td>
                            <a href="remove_cart.php?id=<?= $id ?>" class="btn btn-danger btn-sm">X</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <h5>Total: <b>Rp <?= number_format($grandTotal) ?></b></h5>

            <form action="../../controller/penjualan.php" method="post">
                <button class="btn btn-success w-100 mt-2" name="checkout">Simpan Transaksi</button>
            </form>
        </div>

    </div>
</div>

</body>
</html>
