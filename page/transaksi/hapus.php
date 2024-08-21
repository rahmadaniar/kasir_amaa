<?php

 if(empty($_GET['id_transaksi'])) header("Location: index.php");

 $id_transaksi = $_GET['id_transaksi'];

 $pdo = koneksi::connect();
 $transaksi = Transaksi::getInstance($pdo);
 $result = $transaksi->hapus($id_transaksi);
 koneksi::disconnect();
 
 if ($result) {
     echo "<script>window.location.href = 'index.php?page=transaksi';</script>";
 } else {
     echo "Terjadi kesalahan saat menghapus data.";
 }
 
 ?>