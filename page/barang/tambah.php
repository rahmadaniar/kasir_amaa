<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="text-center">Tambah Barang</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required>
                </div>
                <div class="form-group">
                    <label>Jenis Barang</label>
                    <select name="jenis_barang" id="" class="form-control">
                        <option value="">Pilih Jenis</option>
                        <?php
                        $pdo = Koneksi::connect();
                        $barang = Barang::getInstance($pdo);
                        ?>
                        <?php foreach ($barang->getAllJenisBarang() as $jenis) : ?>
                            <option value="<?= $jenis['id_jenis_barang'] ?>">
                                <?= $jenis['nama_jenis_barang'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formFile">Gambar</label>
                    <input class="form-control" type="file" name="gambar" id="formFile" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="harga" class="form-control" placeholder="Harga Barang" required>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="text" name="stok" class="form-control" placeholder="Stok Barang" required>
                </div>
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="supplier" id="" class="form-control">
                        <option value="">Pilih Supplier</option>
                        <?php
                        $pdo = Koneksi::connect();
                        $barang = Barang::getInstance($pdo);
                        ?>
                        <?php foreach ($barang->getAllSupplier() as $supplier) : ?>
                            <option value="<?= $supplier['id_supplier'] ?>">
                                <?= $supplier['nama_supplier'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary"> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $jenis_barang = htmlspecialchars($_POST['jenis_barang']);

    $image = $_FILES["gambar"]["name"];
    $tmpname = $_FILES["gambar"]["tmp_name"];
    $error = $_FILES["gambar"]["error"];

    $stok = htmlspecialchars($_POST['stok']);
    $harga = htmlspecialchars($_POST['harga']);
    $supplier = htmlspecialchars($_POST['supplier']);

    if ($error === UPLOAD_ERR_OK) {
        $newfilename = uniqid() . "." . pathinfo($image, PATHINFO_EXTENSION);
        if (move_uploaded_file($tmpname, 'assets/image/' . $newfilename)) {

            $pdo = Koneksi::connect();
            $barang = Barang::getInstance($pdo);
            if ($barang->tambah($nama, $jenis_barang, $harga, $stok, $newfilename, $supplier)) {
                echo "<script>window.location.href = 'index.php?page=barang'</script>";
            } else {
                echo "Terjadi kesalahan saat menyimpan data.";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
}
?>