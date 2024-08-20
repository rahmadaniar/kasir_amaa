<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="mb-4">Tambah Member</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Member">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat Member">
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="No Telp Member">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="total_poin">Total Poin</label>
                    <input type="number" id="total_poin" name="total_poin" class="form-control" placeholder="Total Poin Member">
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
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $total_poin = htmlspecialchars($_POST['total_poin']);
    
    if (empty($nama) || empty($alamat) || empty($no_telp) || empty($jenis_kelamin) || empty($total_poin)) {
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
        $member = member::getInstance($pdo);
        $success = $member->tambah($nama, $alamat, $no_telp, $jenis_kelamin, $total_poin);
        koneksi::disconnect();

        if ($success) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Member berhasil ditambahkan!',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'index.php?page=member';
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
