<?php
session_start();
include "database/config.php";
include "database/class/auth.php";

// Inisialisasi koneksi database dan objek Auth
$pdo = koneksi::connect();
$auth = Auth::getInstance($pdo);
$currentUser = $auth->getUser();

// Cek apakah pengguna sudah login
if (!$auth->isLoggedIn()) {
    $login = isset($_GET['auth']) ? $_GET['auth'] : 'auth';
    switch ($login) {
        case 'login':
            include 'auth/login.php';
            break;
        case 'register':
            include 'auth/register.php';
            break;
        case 'forgot-password':
            include 'auth/forgot-password.php';
            break;
        default:
            include 'auth/login.php';
            break;
    }
} else {


    if (isset($_GET['page']) && $_GET['page'] === 'logout') {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
            session_destroy();
            header("Location: index.php");
            exit();
        }
        include('page/user/logout.php');
    } else {

        $cetak = isset($_GET['cetak']) ? $_GET['cetak'] : 'cetak';
        switch ($cetak) {
            case 'struk':
                include 'page/transaksi/cetak_laporan.php';
            case 'transaksi':
                include 'page/transaksi/cetak_struk.php';
        }
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Kasir ama</title>
        <?php include 'layouts/load_css.php'; ?>
    </head>

    <body>
        <?php include("layouts/header.php"); ?>

        <div class="main-content">
            <section class="section">

                <?php
                $page = isset($_GET["page"]) ? $_GET["page"] : 'dashboard';
                switch ($page) {
                    case 'user':
                        include('page/user/default.php');
                        break;

                    case 'member':
                        include('page/member/default.php');
                        break;

                    case 'barang':
                        include('page/barang/default.php');
                        break;

                    case 'transaksi':
                        include('page/transaksi/default.php');
                        break;

                    case 'supplier':
                        include('page/supplier/default.php');
                        break;

                    case 'jenis_barang':
                        include('page/jenis_barang/default.php');
                        break;

                    case 'dashboard':
                        include('page/dashboard/index.php');
                        break;

                    default:
                        include('page/dashboard/index.php');
                }
                ?>

            </section>
        </div>

        <!-- General JS Scripts -->
        <?php
        include 'layouts/footer.php';
        include("layouts/load_js.php");
        ?>
    </body>

    </html>

<?php
}
// Tutup else statement untuk login check
?>