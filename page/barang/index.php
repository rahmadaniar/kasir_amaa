<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h3>Barang</h3>
            <a href="index.php?page=barang&act=tambah" class="btn btn-secondary">Tambah Barang</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>Nama</th>
                        <th>Jenis Barang</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pdo = koneksi::connect();
                    $barang = Barang::getInstance($pdo);
                    $dataBarang = $barang->getAll();
                    if ($dataBarang && is_array($dataBarang)) {
                        foreach ($dataBarang as $row) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_jenis_barang']); ?></td>
                        <td>
                            <?php
                            $gambarPath = 'page/barang/img/' . htmlspecialchars($row['gambar']);
                            if (file_exists($gambarPath)) {
                                echo '<img src="' . $gambarPath . '" width="180">';
                            } else {
                                echo 'Gambar tidak ditemukan';
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['harga']); ?></td>
                        <td><?php echo htmlspecialchars($row['stok']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_supplier']); ?></td>
                        <td>
                            <a href="index.php?page=barang&act=edit&id_barang=<?php echo htmlspecialchars($row['id_barang']); ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="index.php?page=barang&act=hapus&id_barang=<?php echo htmlspecialchars($row['id_barang']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    Koneksi::disconnect();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
