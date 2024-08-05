<?php


if (empty($_GET['id_supplier'])) {
    echo "<script>window.location.href = 'index.php?page=supplier'</script>";
    exit();
}

$id_supplier = $_GET['id_supplier'];
$pdo = Koneksi::connect();
$supplier = supplier::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_supplier = htmlspecialchars($_POST['nama_supplier']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $email = htmlspecialchars($_POST['email']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $no_rekening = htmlspecialchars($_POST['no_rekening']);

    $result = $supplier->edit($id_supplier, $nama_supplier, $alamat, $email, $no_telp, $no_rekening);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=supplier'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $supplier->getID($id_supplier);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=supplier'</script>";
    exit();
}

$nama_supplier = htmlspecialchars($data['nama_supplier']);
$alamat = htmlspecialchars($data['alamat']);
$email = htmlspecialchars($data['email']);
$no_telp = htmlspecialchars($data['no_telp']);
$no_rekening = htmlspecialchars($data['no_rekening']);
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
                <label for="nama_supplier">Nama</label>
                <input id="nama_supplier" name="nama_supplier" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama_supplier); ?>" required>
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