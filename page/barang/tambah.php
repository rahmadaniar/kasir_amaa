<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="text-center">Tambah Barang</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Barang">
                </div>
                <div class="form-group">
                    <label>Jenis Barang</label>
                    <select name="jenis_barang" id="" class="form-control">
                        <option value="">Pilih Jenis</option>
                        <?php
                        $pdo = koneksi::connect();
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
                    <input class="form-control" type="file" name="gambar" id="formFile">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="harga" class="form-control" placeholder="Harga Barang">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="text" name="stok" class="form-control" placeholder="Stok Barang">
                </div>
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="supplier" id="" class="form-control">
                        <option value="">Pilih Supplier</option>
                        <?php
                        $pdo = koneksi::connect();
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
    $id_jenis_barang = htmlspecialchars($_POST['jenis_barang']);
    $harga = htmlspecialchars($_POST['harga']);
    $stok = htmlspecialchars($_POST['stok']);
    $gambar = $_FILES["gambar"]["name"];
    $tmpname = $_FILES["gambar"]["tmp_name"];
    $error = $_FILES["gambar"]["error"];
    $id_supplier = htmlspecialchars($_POST['supplier']);

    if (empty($nama) || empty($id_jenis_barang) || empty($harga) || empty($stok) || empty($gambar) || empty($id_supplier)) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Kolom Kosong',
                text: 'Harap mengisi semua kolom yang diperlukan.',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {

        if ($error === UPLOAD_ERR_OK) {
            $newfilename = uniqid() . "." . pathinfo($gambar, PATHINFO_EXTENSION);
            if (move_uploaded_file($tmpname, 'assets/image/' . $newfilename)) {
                $pdo = koneksi::connect();
                $barang = Barang::getInstance($pdo);
                if ($barang->tambah($nama, $id_jenis_barang, $harga, $stok, $newfilename, $id_supplier)) {
                    echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Barang berhasil ditambahkan!',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'index.php?page=barang';
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
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat mengunggah gambar.',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
        }
    }
}
?>