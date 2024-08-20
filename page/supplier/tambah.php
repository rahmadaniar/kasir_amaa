<?php
if ($_SESSION['user']['role'] == "Kasir") {
    echo "<script>window.location.href = 'index.php'</script>";
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="mb-4 text-center">Tambah Supplier</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_supplier">Nama</label>
                    <input type="text" id="nama_supplier" name="nama_supplier" class="form-control" placeholder="Nama Supplier">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat Supplier">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Supplier">
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="No Telp Supplier">
                </div>
                <div class="form-group">
                    <label for="no_rekening">No Rekening</label>
                    <input type="text" id="no_rekening" name="no_rekening" class="form-control" placeholder="No Rekening Supplier">
                </div>
                <div class="form-group">
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

    if (empty($nama_supplier) || empty($alamat) || empty($email) || empty($no_telp) || empty($no_rekening)) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Kolom Kosong',
                text: 'Harap mengisi semua kolom yang diperlukan.',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {

        $pdo = koneksi::connect();
        $supplier = Supplier::getInstance($pdo);
        $success = $supplier->tambah($nama_supplier, $alamat, $email, $no_telp, $no_rekening);
        koneksi::disconnect();

        if ($success) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Supplier berhasil ditambahkan!',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'index.php?page=supplier';
            });
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan saat menyimpan data.',
                confirmButtonText: 'OK'
            });
        </script>";
        }
    }
}
?>