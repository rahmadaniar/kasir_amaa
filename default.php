<?php
$pdo = koneksi::connect();


$sqlBarang ='SELECT COUNT(*) FROM barang';
$resultBarang = $pdo->query($sqlBarang);
$jumlahbarang = $resultBarang->fetchColumn();

$sqlJenisBarang ='SELECT COUNT(*) FROM jenis_barang';
$resultJenisBarang = $pdo->query($sqlJenisBarang);
$jumlah_jenis_barang = $resultJenisBarang->fetchColumn();

$sqlsupplier ='SELECT COUNT(*) FROM supplier';
$resultsupplier = $pdo->query($sqlsupplier);
$jumlahsupplier = $resultsupplier->fetchColumn();

$sqlmember ='SELECT COUNT(*) FROM member';
$resultmember = $pdo->query($sqlmember);
$jumlahmember = $resultmember->fetchColumn();

$sqltransaksi ='SELECT COUNT(*) FROM transaksi';
$resulttransaksi = $pdo->query($sqltransaksi);
$jumlahtransaksi = $resulttransaksi->fetchColumn();

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Home</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-3">
                <div class="card border-secondary">
                    <div class="card-body">
                        <h2><a href="index.php?page=user"  class=".text text-secondary">User</a></h2>
                        0
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card border-secondary">
                    <div class="card-body">
                    <h2><a href="index.php?page=member"  class=".text text-secondary">Member</a></h2>
                    <?= $jumlahmember ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card border-secondary">
                    <div class="card-body">
                    <h2><a href="index.php?page=supplier" class=".text text-secondary">Supplier</a></h2>
                    <?= $jumlahsupplier ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-3">
            <div class="card border-info">
                    <div class="card-body">
                    <h2><a href="index.php?page=jenis_barang"  class=".text text-info">Jenis Barang</a></h2>
                    <?= $jumlah_jenis_barang ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card border-info">
                    <div class="card-body">
                    <h2><a href="index.php?page=barang"  class=".text text-info">Barang</a></h2>
                    <?= $jumlahbarang ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card border-info">
                    <div class="card-body">
                    <h2><a href="index.php?page=transaksi"  class=".text text-info">Transaksi</a></h2>
                    <?= $jumlahtransaksi ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
