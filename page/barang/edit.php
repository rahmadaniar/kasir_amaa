<?php

if (empty($_GET['id_barang'])) {
    echo "<script>window.location.href = 'index.php?page=barang'</script>";
    exit();
}

$id_barang = $_GET['id_barang'];

$pdo = Koneksi::connect();
$barang = Barang::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $jenis_barang = htmlspecialchars($_POST['jenis_barang']);
    $harga = htmlspecialchars($_POST['harga']);
    $stok = htmlspecialchars($_POST['stok']);
    $supplier = htmlspecialchars($_POST['supplier']);
    $result = false;

    if (!empty($_FILES['gambar']['name'])) {
        $extensi = explode(".", $_FILES['gambar']['name']);
        $gambar = "gambar-" . round(microtime(true)) . "." . end($extensi);
        $sumber = $_FILES['gambar']['tmp_name'];
        $upload = move_uploaded_file($sumber, "page/barang/img/" . $gambar);

        if ($upload) {
            $result = $barang->update($id_barang, $nama, $jenis_barang, $harga, $stok, $gambar, $supplier);
        } else {
            echo "Gagal mengunggah gambar.";
            exit();
        }
    } else {
        $currentData = $barang->getID($id_barang);
        $gambar = $currentData['gambar']; // Use existing image if no new image is uploaded
        $result = $barang->update($id_barang, $nama, $jenis_barang, $harga, $stok, $gambar, $supplier);
    }

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=barang'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $barang->getID($id_barang);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=barang'</script>";
    exit();
}

$nama = htmlspecialchars($data['nama']);
$id_jenis_barang = htmlspecialchars($data['id_jenis_barang']);
$harga = htmlspecialchars($data['harga']);
$stok = htmlspecialchars($data['stok']);
$id_supplier = htmlspecialchars($data['id_supplier']);
$gambar = !empty($data['gambar']) ? "img/" . htmlspecialchars($data['gambar']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="mb-4">
                    <h3>Edit Barang</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Barang</label>
                        <select name="jenis_barang" class="form-control">
                            <option value="">Pilih Jenis</option>
                            <?php foreach ($barang->getAllJenisBarang() as $jenis) : ?>
                                <option value="<?= $jenis['id_jenis_barang'] ?>" <?= ($id_jenis_barang == $jenis['id_jenis_barang']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($jenis['nama_jenis_barang']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input id="gambar" name="gambar" type="file" class="form-control">
                        <?php if (!empty($gambar)): ?>
                            <img src="<?php echo htmlspecialchars($gambar); ?>" alt="Gambar Barang" width="100" class="mt-2">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input id="harga" name="harga" type="text" class="form-control" placeholder="Masukkan harga" value="<?php echo htmlspecialchars($harga); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input id="stok" name="stok" type="text" class="form-control" placeholder="Masukkan stok" value="<?php echo htmlspecialchars($stok); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier" class="form-control">
                            <option value="">Pilih Supplier</option>
                            <?php foreach ($barang->getAllSupplier() as $supplier) : ?>
                                <option value="<?= $supplier['id_supplier'] ?>" <?= ($id_supplier == $supplier['id_supplier']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($supplier['nama_supplier']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="index.php?page=barang" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
