


<?php

$user = $_SESSION['user'];

?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">




    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a href="../penjualan/index.php" class="navbar-brand"><i class="bi bi-cart3 "></i>Marketplace</a>
            <button class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../penjualan/penjualan.php" class="nav-link"><i class="bi bi-receipt">Penjualan</a>
                    </li>
                </ul>


                <ul class="navbar-nav text-white ms-auto">
                    <li class="nav-item"><span class="nav-link active">
                        Hallo,<?php echo $user['username']; ?>
                    </span></li>
                     

                </ul>
            </div>
        </div>
    </nav>