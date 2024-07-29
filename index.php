<?php

if(isset($_GET['page']))
{
    $halaman_get = $_GET['page'];
}else{
    $halaman_get = "";
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

    
    default:
        # code...
        $title = "Halaman Utama";
        include('layouts/header.php');
        include('default.php');
        include('layouts/footer.php');
        break;
}

?>
