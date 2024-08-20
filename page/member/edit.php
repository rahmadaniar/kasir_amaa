
<?php

if (empty($_GET['id_member'])) {
    echo "<script>window.location.href = 'index.php?page=member'</script>";
    exit();
}

$id_member = $_GET['id_member'];
$pdo = koneksi::connect();
$member = Member::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $total_poin = htmlspecialchars($_POST['total_poin']);

    $result = $member->edit($id_member, $nama, $alamat, $no_telp, $jenis_kelamin, $total_poin);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=member&edit_success=true'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $member->getID($id_member);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=member'</script>";
    exit();
}

$nama = htmlspecialchars($data['nama']);
$alamat = htmlspecialchars($data['alamat']);
$no_telp = htmlspecialchars($data['no_telp']);
$jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
$total_poin = htmlspecialchars($data['total_poin']);
?>

<?php
// Tampilkan alert jika edit berhasil
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Member berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-4">
                <h3>Edit Member</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama); ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Masukkan alamat" value="<?php echo htmlspecialchars($alamat); ?>" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input id="no_telp" name="no_telp" type="text" class="form-control" placeholder="Masukkan nomor telepon" value="<?php echo htmlspecialchars($no_telp); ?>" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="total_poin">Total Poin</label>
                    <input id="total_poin" name="total_poin" type="text" class="form-control" placeholder="Masukkan total poin" value="<?php echo htmlspecialchars($total_poin); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=member" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

