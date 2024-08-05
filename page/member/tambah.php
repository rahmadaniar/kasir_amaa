<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Member</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
     <div class="row">
      <div class="col-md-6 offset-md-3">
        <h3 class="mb-4">Tambah Member</h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Member" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat Member" required>
            </div>
            <div class="form-group">
                <label for="no_telp">No Telp</label>
                <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="No Telp Member" required>
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
                <input type="number" id="total_poin" name="total_poin" class="form-control" placeholder="Total Poin Member" required>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
      </div>
     </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php
if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $total_poin = htmlspecialchars($_POST['total_poin']);

    $pdo = koneksi::connect();
    $member = member::getInstance($pdo);
    if ($member->tambah($nama, $alamat, $no_telp, $jenis_kelamin, $total_poin)) {
    echo "<script>window.location.href = 'index.php?page=member'</script>";
    } else {
    echo "Terjadi kesalahan saat menyimpan data.";
    }
} 
        
?>