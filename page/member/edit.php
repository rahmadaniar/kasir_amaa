<?php 

if (empty($_GET['id_member'])) {
    echo "<script> window.location.href = 'index.php?page=member' </script> ";
    exit();
}

$id_member = $_GET['id_member'];

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $total_poin = $_POST['total_poin'];

    $pdo = koneksi::connect();
    $sql = "UPDATE member SET nama = ?, alamat = ?, no_telp = ?, jenis_kelamin = ?, total_poin = ? WHERE id_member = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama, $alamat, $no_telp, $jenis_kelamin, $total_poin, $id_member));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=member' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM member WHERE id_member = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_member));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=member' </script> ";
        exit();
    }

    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $no_telp = $data['no_telp'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $total_poin = $data['total_poin'];
    koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
     <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="mb-4">
            <h3>Edit Member</h3>
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
                <label for="no_telp">No Telp</label>
                <input id="no_telp" name="no_telp" type="text" class="form-control" placeholder="Masukkan nomor telepon" value="<?php echo htmlspecialchars($no_telp); ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="total_poin">Total Poin</label>
                <input id="total_poin" name="total_poin" type="text" class="form-control" placeholder="Masukkan total poin" value="<?php echo htmlspecialchars($total_poin); ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=member" class="btn btn-secondary">Kembali</a>
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