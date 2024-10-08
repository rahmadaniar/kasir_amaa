<?php


if (empty($_GET['id_supplier'])) {
    echo "<script>window.location.href = 'index.php?page=supplier'</script>";
    exit();
}

$id_supplier = $_GET['id_supplier'];
$pdo = koneksi::connect();
$supplier = supplier::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_supplier = htmlspecialchars($_POST['nama_supplier']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $email = htmlspecialchars($_POST['email']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $no_rekening = htmlspecialchars($_POST['no_rekening']);

    $result = $supplier->edit($id_supplier, $nama_supplier, $alamat, $email, $no_telp, $no_rekening);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=supplier&edit_success=true'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $supplier->getID($id_supplier);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=supplier'</script>";
    exit();
}

$nama_supplier = htmlspecialchars($data['nama_supplier']);
$alamat = htmlspecialchars($data['alamat']);
$email = htmlspecialchars($data['email']);
$no_telp = htmlspecialchars($data['no_telp']);
$no_rekening = htmlspecialchars($data['no_rekening']);
?>

<?php
if ($_SESSION['user']['role'] == "Kasir") {
    echo "<script>window.location.href = 'index.php'</script>";
}
// Tampilkan alert jika edit berhasil
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Supplier berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-4">
                <h3>Edit Supplier</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama_supplier">Nama</label>
                    <input id="nama_supplier" name="nama_supplier" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama_supplier); ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Masukkan alamat" value="<?php echo htmlspecialchars($alamat); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" class="form-control" placeholder="Masukkan email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input id="no_telp" name="no_telp" type="text" class="form-control" placeholder="Masukkan nomor telepon" value="<?php echo htmlspecialchars($no_telp); ?>" required>
                </div>
                <div class="form-group">
                    <label for="no_rekening">No Rekening</label>
                    <input id="no_rekening" name="no_rekening" type="text" class="form-control" placeholder="Masukkan nomor rekekning" value="<?php echo htmlspecialchars($no_telp); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=supplier" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

