<?php

 if(empty($_GET['id_barang'])) header("Location: index.php");

 $id_barang = $_GET['id_barang'];

 $pdo = koneksi::connect();
 $sql = "DELETE FROM barang WHERE id_barang = ?";
 $q = $pdo->prepare($sql);
 $q->execute(array($id_barang));
 koneksi::disconnect();
 echo "<script> window.location.href = 'index.php?page=barang' </script> ";