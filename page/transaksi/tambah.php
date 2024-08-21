<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="mb-4">Tambah Transaksi</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="total_transaksi">Total Transaksi</label>
                    <input type="text" class="form-control" id="total_transaksi" name="total_transaksi" placeholder="Total Transaksi">
                </div>
                <div class="form-group">
                    <label for="total_diskon">Total Diskon</label>
                    <input type="text" class="form-control" id="total_diskon" name="total_diskon" placeholder="Total Diskon">
                </div>
                <div class="form-group">
                    <label for="nominal_tunai">Nominal Tunai</label>
                    <input type="text" class="form-control" id="nominal_tunai" name="nominal_tunai" placeholder="Nominal Tunai">
                </div>
                <div class="form-group">
                    <label for="ppn">PPN</label>
                    <input type="text" class="form-control" id="ppn" name="ppn" placeholder="PPN Transaksi">
                </div>
                <div class="form-group">
                    <label for="kembalian">Kembalian</label>
                    <input type="text" class="form-control" id="kembalian" name="kembalian" placeholder="Kembalian">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Transaksi">
                </div>
                <div class="form-group">
                    <label for="invoice">Invoice</label>
                    <input type="text" class="form-control" id="invoice" name="invoice" placeholder="Invoice">
                </div>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php

if (isset($_POST['simpan'])) {

    $total_transaksi = $_POST['total_transaksi'];
    $total_diskon = $_POST['total_diskon'];
    $nominal_tunai = $_POST['nominal_tunai'];
    $ppn = $_POST['ppn'];
    $kembalian = $_POST['kembalian'];
    $tanggal = $_POST['tanggal'];
    $invoice = $_POST['invoice'];


    // Validasi: Cek jika ada kolom yang kosong
    if (empty($total_transaksi) || empty($total_diskon) || empty($nominal_tunai) || empty($ppn) || empty($kembalian) || empty($tanggal) | empty($invoice)) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Kolom Belum Terisi',
                text: 'Harap lengkapi semua kolom!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit();
    }

    // Koneksi ke database dan tambahkan data transaksi
    $pdo = koneksi::connect();
    $transaksi = Transaksi::getInstance($pdo);
    $success = $transaksi->tambah($total_transaksi, $total_diskon, $nominal_tunai, $ppn, $kembalian, $tanggal, $invoice);
    koneksi::disconnect();

    // Tampilkan pesan berdasarkan hasil penyimpanan data
    if ($success) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Transaksi berhasil ditambahkan!',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'index.php?page=transaksi';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan saat menyimpan data transaksi.',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    exit();
}
?>
