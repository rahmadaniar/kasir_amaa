<?php
// Tampilkan alert jika edit berhasil
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Jenis barang berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>Jenis Barang</h3>
        <a href="index.php?page=jenis_barang&act=tambah" class="btn btn-secondary ">Tambah Jenis Barang</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Nama Jenis Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = koneksi::connect();
                $sql = 'SELECT * FROM jenis_barang';
                $no = 1;
                foreach ($pdo->query($sql) as $row) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['nama_jenis_barang'] ?></td>
                        <td>
                            <a href="index.php?page=jenis_barang&act=edit&id_jenis_barang=<?php echo $row['id_jenis_barang'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="hapus('<?php echo htmlspecialchars($row['id_jenis_barang']); ?>'); return false;">
                                <i class="fas fa-trash"></i> 
                            </a>
                        </td>
                    </tr>
                <?php
                }
                koneksi::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<script>
    function hapus(id_jenis_barang) {
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
                window.location.href = `index.php?page=jenis_barang&act=hapus&id_jenis_barang=${id_jenis_barang}`;
            }
        });
    }
</script>