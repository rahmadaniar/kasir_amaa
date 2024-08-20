<?php
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Transaksi berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Transaksi</h3>
        <a href="index.php?page=transaksi&act=tambah" class="btn btn-secondary">Tambah Transaksi</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Total Transaksi</th>
                    <th>Total diskon</th>
                    <th>Nominal Tunai</th>
                    <th>PPN</th>
                    <th>Kembalian</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = koneksi::connect();
                $sql = 'SELECT * FROM transaksi';
                $no = 1;
                foreach ($pdo->query($sql) as $row) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo ($row['total_transaksi']) ?></td>
                        <td><?php echo ($row['total_diskon']) ?></td>
                        <td><?php echo ($row['nominal_tunai']) ?></td>
                        <td><?php echo ($row['ppn']) ?></td>
                        <td><?php echo ($row['kembalian']) ?></td>
                        <td><?php echo ($row['tanggal']) ?></td>
                        <td>
                            <a href="index.php?page=transaksi&act=edit&id_transaksi=<?php echo $row['id_transaksi'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="hapus('<?php echo htmlspecialchars($row['id_transaksi']); ?>'); return false;">
                                <i class="fas fa-trash"></i> Hapus
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

<script>
function hapus(id_transaksi) {
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
            window.location.href = `index.php?page=transaksi&act=hapus&id_transaksi=${id_transaksi}`;
        }
    });
}
</script>

