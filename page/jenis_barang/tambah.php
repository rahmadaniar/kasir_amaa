<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="mb-4">Tambah Jenis Barang</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_jenis_barang">Nama Jenis Barang</label>
                    <input type="text" id="nama_jenis_barang" name="nama_jenis_barang" class="form-control" placeholder="Nama Jenis Barang">
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
    $nama_jenis_barang = htmlspecialchars($_POST['nama_jenis_barang']);
    
    if (empty($nama_jenis_barang)) {
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
        $jenis_barang = Jenis_barang::getInstance($pdo);
        $success = $jenis_barang->tambah($nama_jenis_barang);
        koneksi::disconnect();

        if ($success) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Jenis barang berhasil ditambahkan!',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'index.php?page=jenis_barang';
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
