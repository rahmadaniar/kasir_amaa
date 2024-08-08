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
                            <a href="index.php?page=transaksi&act=hapus&id_transaksi=<?php echo $row['id_transaksi'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
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


