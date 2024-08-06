<?php
session_start();


if (isset($_GET['page'])) {
    $halaman_get = $_GET['page'];
} else {
    $halaman_get = "";
}

if (!isset($_SESSION['user'])) {
    if ($halaman_get == "register") {
        // Dibiarkan saja alias diperbolehkan
    } else if ($halaman_get != "login") {
        // Memaksakan user masuk ke halaman login
        header('Location: index.php?page=login');
        exit();
    }
} else {
    // user udah login otomatis login
    if ($halaman_get == "login") {
        // masuk ke dalam index.php alias dashboard
        header('Location: index.php');
        exit();
    }
}


if (isset($_SESSION['user'])) {
    if ($halaman_get == "login" ||  $halaman_get == "register") {
        header('Location: index.php?');
    }
}

switch ($halaman_get) {
    case 'barang':
        $title = "Halaman Barang";
        include('layouts/header.php');
        include('page/barang/default.php');
        include('layouts/footer.php');
        break;

    case 'jenis_barang':
        $title = "Halaman Jenis Barang";
        include('layouts/header.php');
        include('page/jenis_barang/default.php');
        include('layouts/footer.php');
        break;

    case 'member':
        $title = "Halaman Member";
        include('layouts/header.php');
        include('page/member/default.php');
        include('layouts/footer.php');
        break;

    case 'supplier':
        $title = "Halaman Supplier";
        include('layouts/header.php');
        include('page/supplier/default.php');
        include('layouts/footer.php');
        break;

    case 'transaksi':
        $title = "Halaman Transaksi";
        include('layouts/header.php');
        include('page/transaksi/default.php');
        include('layouts/footer.php');
        break;

    case 'user':
        $title = "Halaman user";
        include('layouts/header.php');
        include('page/user/default.php');
        include('layouts/footer.php');
        break;

    case 'login':
        $title = "Halaman login";
        include('page/user/login.php');
        break;

    case 'logout':
        include('page/user/logout.php');
        break;

    case 'register':
        $title = "Halaman register";
        include('page/user/register.php');
        break;


    default:
        # code...
        $title = "Halaman Utama";
        include('layouts/header.php');
        include('default.php');
        include('layouts/footer.php');
        break;
}