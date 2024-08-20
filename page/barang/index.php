<?php
// Tampilkan alert jika edit berhasil
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Barang berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>Barang</h3>
        <a href="index.php?page=barang&act=tambah" class="btn btn-secondary">Tambah Barang</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
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
                $no = 1;
                if ($dataBarang && is_array($dataBarang)) {
                    foreach ($dataBarang as $row) {
                ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_jenis_barang']); ?></td>
                            <td>
                                <?php
                                $gambarPath = 'assets/image/' . htmlspecialchars($row['gambar']);
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
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="hapus('<?php echo htmlspecialchars($row['id_barang']); ?>'); return false;">
                                <i class="fas fa-trash"></i> 
                            </a>
                            </td>
                        </tr>
                <?php
                    }
                }
                koneksi::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function hapus(id_barang) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL hapus setelah konfirmasi
                window.location.href = `index.php?page=barang&act=hapus&id_barang=${id_barang}`;
            }
        });
    }
</script>
