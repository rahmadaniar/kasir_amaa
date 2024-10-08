<?php
$pdo = koneksi::connect();

$sqlUser = 'SELECT COUNT(*) FROM user';
$resultUser = $pdo->query($sqlUser);
$jumlahuser = $resultUser->fetchColumn();

$sqlBarang = 'SELECT COUNT(*) FROM barang';
$resultBarang = $pdo->query($sqlBarang);
$jumlahbarang = $resultBarang->fetchColumn();

$sqlJenisBarang = 'SELECT COUNT(*) FROM jenis_barang';
$resultJenisBarang = $pdo->query($sqlJenisBarang);
$jumlah_jenis_barang = $resultJenisBarang->fetchColumn();

$sqlsupplier = 'SELECT COUNT(*) FROM supplier';
$resultsupplier = $pdo->query($sqlsupplier);
$jumlahsupplier = $resultsupplier->fetchColumn();

$sqlmember = 'SELECT COUNT(*) FROM member';
$resultmember = $pdo->query($sqlmember);
$jumlahmember = $resultmember->fetchColumn();

$sqltransaksi = 'SELECT COUNT(*) FROM transaksi';
$resulttransaksi = $pdo->query($sqltransaksi);
$jumlahtransaksi = $resulttransaksi->fetchColumn();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home</h1>
    </div>


    <div class="row">

        <?php if ($_SESSION['user']['role'] == "SuperAdmin") : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=user" style="text-decoration: none;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        User</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahuser ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['user']['role'] == "SuperAdmin" || $_SESSION['user']['role'] == "Admin" || $_SESSION['user']['role'] == "Kasir") : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=barang" style="text-decoration: none;">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Barang</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahbarang ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-box fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['user']['role'] == "SuperAdmin" || $_SESSION['user']['role'] == "Admin" || $_SESSION['user']['role'] == "Kasir") : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=member" style="text-decoration: none;">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Member</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahmember ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['user']['role'] == "SuperAdmin" || $_SESSION['user']['role'] == "Admin") : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=supplier" style="text-decoration: none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Supllier</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahsupplier ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-truck fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['user']['role'] == "SuperAdmin" || $_SESSION['user']['role'] == "Admin" || $_SESSION['user']['role'] == "Kasir") : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=transaksi" style="text-decoration: none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Transaksi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahtransaksi ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['user']['role'] == "SuperAdmin" || $_SESSION['user']['role'] == "Admin" || $_SESSION['user']['role'] == "Kasir") : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=jenis_barang" style="text-decoration: none;">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Jenis Barang</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_jenis_barang ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tags fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>


    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Pendapatan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sumber Pendapatan</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
