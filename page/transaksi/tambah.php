<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3 class="mb-4">Tambah Transaksi</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama">Total Transaksi</label>
                        <input type="text" class="form-control" id="total_transaksi" name="total_transaksi" placeholder="Total Transaksi" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Total Diskon</label>
                        <input type="text" class="form-control" id="total_diskon" name="total_diskon" placeholder="Total Diskon" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Nominal Tunai</label>
                        <input type="text" class="form-control" id="nominal_tunai" name="nominal_tunai" placeholder="Nominal Tunai" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">PPN</label>
                        <input type="text" class="form-control" id="ppn" name="ppn" placeholder="PPN Transaksi" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Kembalian</label>
                        <input type="text" class="form-control" id="kembalian" name="kembalian" placeholder="Kembalian" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Transaksi" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
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

if(isset($_POST['simpan'])){


    $total_transaksi = $_POST['total_transaksi'];
    $total_diskon = $_POST['total_diskon'];
    $nominal_tunai = $_POST['nominal_tunai'];
    $ppn = $_POST['ppn'];
    $kembalian = $_POST['kembalian'];
    $tanggal = $_POST['tanggal'];

    $pdo = koneksi::connect();
    $sql = "INSERT INTO transaksi (total_transaksi,total_diskon,nominal_tunai,ppn,kembalian,tanggal) VALUES (?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($total_transaksi,$total_diskon,$nominal_tunai,$ppn,$kembalian,$tanggal));

    koneksi::disconnect();
    echo "<script> window.location.href = 'index.php?page=transaksi' </script> ";
}
?>