<?php 

if (empty($_GET['id_supplier'])) {
    echo "<script> window.location.href = 'index.php?page=supplier' </script> ";
    exit();
}

$id_supplier = $_GET['id_supplier'];

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $no_rekening = $_POST['no_rekening'];

    $pdo = koneksi::connect();
    $sql = "UPDATE supplier SET nama = ?, alamat = ?, email = ?, no_telp = ?, no_rekening = ?  WHERE id_supplier = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama, $alamat, $email, $no_telp, $no_rekening, $id_supplier));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=supplier' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM supplier WHERE id_supplier = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_supplier));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=supplier' </script> ";
        exit();
    }

    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $email = $data['email'];
    $no_telp = $data['no_telp'];
    $no_rekening = $data['no_rekening'];
    koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
     <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="mb-4">
            <h3>Edit Supplier</h3>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Masukkan alamat" value="<?php echo htmlspecialchars($alamat); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" class="form-control" placeholder="Masukkan email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="no_telp">No Telp</label>
                <input id="no_telp" name="no_telp" type="text" class="form-control" placeholder="Masukkan nomor telepon" value="<?php echo htmlspecialchars($no_telp); ?>" required>
            </div>
            <div class="form-group">
                <label for="no_rekening">No Rekening</label>
                <input id="no_rekening" name="no_rekening" type="text" class="form-control" placeholder="Masukkan nomor rekekning" value="<?php echo htmlspecialchars($no_telp); ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=supplier" class="btn btn-secondary">Kembali</a>
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