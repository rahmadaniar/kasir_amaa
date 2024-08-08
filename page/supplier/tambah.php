<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="mb-4 text-center">Tambah Supplier</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_supplier">Nama</label>
                    <input type="text" id="nama_supplier" name="nama_supplier" class="form-control" placeholder="Nama Supplier" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat Supplier" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Supplier" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="No Telp Supplier" required>
                </div>
                <div class="form-group">
                    <label for="no_rekening">No Rekening</label>
                    <input type="text" id="no_rekening" name="no_rekening" class="form-control" placeholder="No Rekening Supplier" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>




<?php
if (isset($_POST['simpan'])) {
    $nama_supplier = htmlspecialchars($_POST['nama_supplier']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $email = htmlspecialchars($_POST['email']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $no_rekening = htmlspecialchars($_POST['no_rekening']);

    $pdo = Koneksi::connect();
    $supplier = Supplier::getInstance($pdo);
    if ($supplier->tambah($nama_supplier, $alamat, $email, $no_telp, $no_rekening)) {
        echo "<script>window.location.href = 'index.php?page=supplier'</script>";
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

?>
