<?php

if (empty($_GET['id_transaksi'])) {
    echo "<script>window.location.href = 'index.php?page=transaksi'</script>";
    exit();
}

$id_transaksi = $_GET['id_transaksi'];
$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $total_transaksi = htmlspecialchars($_POST['total_transaksi']);
    $total_diskon = htmlspecialchars($_POST['total_diskon']);
    $nominal_tunai = htmlspecialchars($_POST['nominal_tunai']);
    $ppn = htmlspecialchars($_POST['ppn']);
    $kembalian = htmlspecialchars($_POST['kembalian']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $invoice = htmlspecialchars($_POST['invoice']);


    $result = $transaksi->edit($id_transaksi, $total_transaksi, $total_diskon, $nominal_tunai, $ppn, $kembalian, $tanggal, $invoice);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=transaksi&edit_success=true'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $transaksi->getID($id_transaksi);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=transaksi'</script>";
    exit();
}

$total_transaksi = htmlspecialchars($data['total_transaksi']);
$total_diskon = htmlspecialchars($data['total_diskon']);
$nominal_tunai = htmlspecialchars($data['nominal_tunai']);
$ppn = htmlspecialchars($data['ppn']);
$kembalian = htmlspecialchars($data['kembalian']);
$tanggal = htmlspecialchars($data['tanggal']);
$invoice = htmlspecialchars($data['invoice']);

?>

<?php
// Tampilkan alert jika edit berhasil
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Transaksi berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
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
                    <input id="total_transaksi" name="total_transaksi" type="text" class="form-control" placeholder="Masukkan total transaksi" value="<?php echo $total_transaksi; ?>" required>
                </div>
                <div class="form-group">
                    <label for="total_diskon">Total Diskon</label>
                    <input id="total_diskon" name="total_diskon" type="text" class="form-control" placeholder="Masukkan total diskon" value="<?php echo $total_diskon; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nominal_tunai">Nominal Tunai</label>
                    <input id="nominal_tunai" name="nominal_tunai" type="text" class="form-control" placeholder="Masukkan nominal tunai" value="<?php echo $nominal_tunai; ?>" required>
                </div>
                <div class="form-group">
                    <label for="ppn">PPN</label>
                    <input id="ppn" name="ppn" type="text" class="form-control" placeholder="Masukkan PPN" value="<?php echo $ppn; ?>" required>
                </div>
                <div class="form-group">
                    <label for="kembalian">Kembalian</label>
                    <input id="kembalian" name="kembalian" type="text" class="form-control" placeholder="Masukkan kembalian" value="<?php echo $kembalian; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input id="tanggal" name="tanggal" type="date" class="form-control" placeholder="Masukkan tanggal" value="<?php echo $tanggal; ?>" required>
                </div>
                <div class="form-group">
                    <label for="invoice">Invoice</label>
                    <input id="invoice" name="invoice" type="text" class="form-control" placeholder="Masukkan invoice" value="<?php echo $invoice; ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=transaksi" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
