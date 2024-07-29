<?php 

if (empty($_GET['id_jenis_barang'])) {
    echo "<script> window.location.href = 'index.php?page=jenis_barang' </script> ";
    exit();
}

$id_jenis_barang = $_GET['id_jenis_barang'];

if (isset($_POST['simpan'])) {

    $nama_jenis_barang = $_POST['nama_jenis_barang'];

    $pdo = koneksi::connect();
    $sql = "UPDATE jenis_barang SET nama_jenis_barang = ? WHERE id_jenis_barang = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_jenis_barang, $id_jenis_barang));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=jenis_barang' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM jenis_barang WHERE id_jenis_barang = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_jenis_barang));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=jenis_barang' </script> ";
        exit();
    }

    $nama_jenis_barang = $data['nama_jenis_barang'];
    koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jenis Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
     <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="mb-4">
            <h3>Edit Jenis Barang</h3>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama Jenis Barang</label>
                <input id="nama_jenis_barang" name="nama_jenis_barang" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama_jenis_barang); ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=jenis_barang" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
      </div>
    </div>
   </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>