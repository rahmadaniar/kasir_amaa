<?php 

if (empty($_GET['id_barang'])) {
    echo "<script> window.location.href = 'index.php?page=barang' </script> ";
    exit();
}

$id_barang = $_GET['id_barang'];

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $pdo = koneksi::connect();

    // jika ada file gambar yang diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "page/barang/img/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        // update query dengan gambar
        $sql = "UPDATE barang SET nama = ?, harga = ?, stok = ?, gambar = ? WHERE id_barang = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nama, $harga, $stok, $target_file, $id_barang));
    } else {
        // update query tanpa gambar
        $sql = "UPDATE barang SET nama = ?, harga = ?, stok = ? WHERE id_barang = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nama, $harga, $stok, $id_barang));
    }

    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=barang' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM barang WHERE id_barang = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_barang));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=barang' </script> ";
        exit();
    }

    $nama = $data['nama'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    $gambar = $data['gambar'];
    koneksi::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
     <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="mb-4">
            <h3>Edit Barang</h3>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama); ?>" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input id="gambar" name="gambar" type="file" class="form-control">
                <?php if (!empty($gambar)): ?>
                    <img src="<?php echo htmlspecialchars($gambar); ?>" alt="Gambar Barang" width="100" class="mt-2">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input id="harga" name="harga" type="text" class="form-control" placeholder="Masukkan harga" value="<?php echo htmlspecialchars($harga); ?>" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input id="stok" name="stok" type="text" class="form-control" placeholder="Masukkan stok" value="<?php echo htmlspecialchars($stok); ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=barang" class="btn btn-secondary">Kembali</a>
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
