<?php

 if(empty($_GET['id_member'])) header("Location: index.php");

 $id_member = $_GET['id_member'];

 $pdo = koneksi::connect();
 $sql = "DELETE FROM member WHERE id_member = ?";
 $q = $pdo->prepare($sql);
 $q->execute(array($id_member));
 koneksi::disconnect();
 echo "<script> window.location.href = 'index.php?page=member' </script> ";