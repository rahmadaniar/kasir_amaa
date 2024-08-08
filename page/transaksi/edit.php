<?php

if (empty($_GET['id_transaksi'])) {
    echo "<script> window.location.href = 'index.php?page=transaksi' </script> ";
    exit();
}

$id_transaksi = $_GET['id_transaksi'];

if (isset($_POST['simpan'])) {

    $total_transaksi = $_POST['total_transaksi'];
    $total_diskon = $_POST['total_diskon'];
    $nominal_tunai = $_POST['nominal_tunai'];
    $ppn = $_POST['ppn'];
    $kembalian = $_POST['kembalian'];
    $tanggal = $_POST['tanggal'];

    $pdo = koneksi::connect();
    $sql = "UPDATE transaksi SET total_transaksi = ?, total_diskon = ?, nominal_tunai = ?, ppn = ?, kembalian = ?, tanggal = ? WHERE id_transaksi = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($total_transaksi, $total_diskon, $nominal_tunai, $ppn, $kembalian, $tanggal, $id_transaksi));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=transaksi' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM transaksi WHERE id_transaksi = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_transaksi));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=transaksi' </script> ";
        exit();
    }

    $total_transaksi = $data['total_transaksi'];
    $total_diskon = $data['total_diskon'];
    $nominal_tunai = $data['nominal_tunai'];
    $ppn = $data['ppn'];
    $kembalian = $data['kembalian'];
    $tanggal = $data['tanggal'];
    koneksi::disconnect();
}
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-4">
                <h3>Edit Transaksi</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="total_transaksi">Total Transaksi</label>
                    <input id="total_transaksi" name="total_transaksi" type="text" class="form-control" placeholder="Masukkan total" value="<?php echo htmlspecialchars($total_transaksi); ?>" required>
                </div>
                <div class="form-group">
                    <label for="total_diskon">Total Diskon</label>
                    <input id="total_diskon" name="total_diskon" type="text" class="form-control" placeholder="Masukkan total diskon" value="<?php echo htmlspecialchars($total_diskon); ?>" required>
                </div>
                <div class="form-group">
                    <label for="nominal_tunai">Nominal Tunai</label>
                    <input id="nominal_tunai" name="nominal_tunai" type="text" class="form-control" placeholder="Masukkan nominal tunai" value="<?php echo htmlspecialchars($nominal_tunai); ?>" required>
                </div>
                <div class="form-group">
                    <label for="ppn">PPN</label>
                    <input id="ppn" name="ppn" type="text" class="form-control" placeholder="Masukkan ppn" value="<?php echo htmlspecialchars($ppn); ?>" required>
                </div>
                <div class="form-group">
                    <label for="kembalian">Kembalian</label>
                    <input id="kembalian" name="kembalian" type="text" class="form-control" placeholder="Masukkan kembalian" value="<?php echo htmlspecialchars($kembalian); ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input id="tanggal" name="tanggal" type="text" class="form-control" placeholder="Masukkan tanggal" value="<?php echo htmlspecialchars($tanggal); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=transaksi" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

