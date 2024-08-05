<?php

 if(empty($_GET['id_user'])) header("Location: index.php");

 $id_user = $_GET['id_user'];

 $pdo = koneksi::connect();
 $user = User::getInstance($pdo);
 $result = $user->delete($id_user);
 koneksi::disconnect();
 
 if ($result) {
     echo "<script>window.location.href = 'index.php?page=user';</script>";
 } else {
     echo "Terjadi kesalahan saat menghapus data.";
 }
 
 ?>