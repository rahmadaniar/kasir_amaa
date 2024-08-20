<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Tambah Jenis Barang</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_jenis_barang">Nama Jenis Barang</label>
                    <input type="text" class="form-control" id="nama_jenis_barang" name="nama_jenis_barang" placeholder="Nama Jenis Barang">
                </div>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                <a href="index.php?page=jenis_barang" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $nama_jenis_barang = $_POST['nama_jenis_barang'];

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
        $sql = "INSERT INTO jenis_barang (nama_jenis_barang) VALUES (?)";
        $q = $pdo->prepare($sql);
        $success = $q->execute(array($nama_jenis_barang));
        koneksi::disconnect();

        if ($success) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Jenis Barang berhasil ditambahkan!',
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
                    text: 'Terjadi kesalahan saat menambahkan jenis barang.',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }
}
?>
