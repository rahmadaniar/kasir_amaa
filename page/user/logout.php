<?php
  $pdo = koneksi::connect();
  $auth = Auth::getInstance($pdo);
  
  if ($auth->logout()) {
    echo "<script>window.location.href='index.php?auth=login&message=logout'</script>";
}
