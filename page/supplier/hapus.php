<?php

 if(empty($_GET['id_supplier'])) header("Location: index.php");

 $id_supplier = $_GET['id_supplier'];

 $pdo = koneksi::connect();
 $supplier = supplier::getInstance($pdo);
 $result = $supplier->hapus($id_supplier);
 koneksi::disconnect();
 
 if ($result) {
     echo "<script>window.location.href = 'index.php?page=supplier';</script>";
 } else {
     echo "Terjadi kesalahan saat menghapus data.";
 }
 
 ?>