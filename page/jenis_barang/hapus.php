<?php

 if(empty($_GET['id_jenis_barang'])) header("Location: index.php");

 $id_jenis_barang = $_GET['id_jenis_barang'];

 $pdo = koneksi::connect();
 $sql = "DELETE FROM jenis_barang WHERE id_jenis_barang = ?";
 $q = $pdo->prepare($sql);
 $q->execute(array($id_jenis_barang));
 koneksi::disconnect();
 echo "<script> window.location.href = 'index.php?page=jenis_barang' </script> ";