<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jenis Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3 class="text-center">Tambah Jenis Barang</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama_jenis_barang">Nama Jenis Barang</label>
                        <input type="text" class="form-control" id="nama_jenis_barang" name="nama_jenis_barang" placeholder="Nama Jenis Barang" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <a href="index.php?page=jenis_barang" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['simpan'])){
    $nama_jenis_barang = $_POST['nama_jenis_barang'];

    $pdo = koneksi::connect();
    $sql = "INSERT INTO jenis_barang (nama_jenis_barang) VALUES (?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_jenis_barang));

    koneksi::disconnect();
    echo "<script> window.location.href = 'index.php?page=jenis_barang' </script> ";
}
?>
