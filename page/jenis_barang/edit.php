
<?php

if (empty($_GET['id_jenis_barang'])) {
    echo "<script>window.location.href = 'index.php?page=jenis_barang'</script>";
    exit();
}

$id_jenis_barang = $_GET['id_jenis_barang'];
$pdo = koneksi::connect();
$jenis_barang = Jenis_barang::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_jenis_barang = htmlspecialchars($_POST['nama_jenis_barang']);

    $result = $jenis_barang->edit($id_jenis_barang, $nama_jenis_barang);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=jenis_barang&edit_success=true'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $jenis_barang->getID($id_jenis_barang);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=jenis_barang'</script>";
    exit();
}

$nama_jenis_barang = htmlspecialchars($data['nama_jenis_barang']);
?>

<?php
// Tampilkan alert jika edit berhasil
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'jenis_barang berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-4">
                <h3>Edit Jenis Barang</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_jenis_barang">Nama Jenis Barang</label>
                    <input id="nama_jenis_barang" name="nama_jenis_barang" type="text" class="form-control" placeholder="Masukkan Nama Jenis Barang" value="<?php echo htmlspecialchars($nama_jenis_barang); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=jenis_barang" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

