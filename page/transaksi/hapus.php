<?php

 if(empty($_GET['id_transaksi'])) header("Location: index.php");

 $id_transaksi = $_GET['id_transaksi'];

 $pdo = koneksi::connect();
 $sql = "DELETE FROM transaksi WHERE id_transaksi = ?";
 $q = $pdo->prepare($sql);
 $q->execute(array($id_transaksi));
 koneksi::disconnect();
 echo "<script> window.location.href = 'index.php?page=transaksi' </script> ";