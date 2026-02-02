


<?php

$user = $_SESSION['user'];

?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>




    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a href="../penjualan/index.php" class="navbar-brand"><i class="bi bi-cart3 "></i>Marketplace</a>
            <button class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                  
                 <li class="nav-item">
                        <a href="../penjualan/riwayat_penjualan.php" class="nav-link"><i class="bi bi-receipt"></i>Penjualan</a>
                    </li>
                </ul>


                <ul class="navbar-nav text-white ms-auto">
                    <li class="nav-item"><span class="nav-link active">
                        Hallo,<?php echo $user['username']; ?>
                    </span></li>
                     <li class="nav-item"><a href="../../controller/logout.php" class="nav-link" onclick= "return confirm('Yakin ingin Logout?');"><i class="bi bi-box-arrow-right"></i> Logout</a></li>

                </ul>
            </div>
        </div>
    </nav>