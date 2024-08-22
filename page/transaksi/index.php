<div class="section-header">
    <h2>Transaksi</h2>
</div>

<div class="col-15 col-md-12 mb-md-2 col-lg-12">
    <br>
    <form action="" method="post">
        <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <input type='date' class="form-control" name="keyword" autocomplete="off" placeholder="YYYY-MM-DD">
                </div>
                <div class="col-2">
                    <button class="btn btn-info btn-action mr-1" type="submit" name="cari">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="text-left mb-3">
        <a href="index.php?cetak=transaksi&tanggal=<?= @$key ?>">
            <button class="btn btn-info btn-action">
                Cetak
            </button>
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="d-inline">Transaksi</h5>
                <!-- Button trigger modal -->
                <a href="index.php?page=transaksi&act=tambah" class="btn btn-info">Tambah Transaksi</a>
            </div>
        </div>

        <div class="table-responsive p-3">
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
                        <th>Invoice</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $pdo = koneksi::connect();
                    $transaksi = Transaksi::getInstance($pdo);

                    if (isset($_POST['cari']) && !empty($_POST['keyword'])) {
                        $keyword = $_POST['keyword'];
                        // Debugging: echo untuk memeriksa keyword
                        echo "<p>Mencari transaksi pada tanggal: $keyword</p>";

                        // Ambil data transaksi berdasarkan tanggal yang dicari
                        $dataTransaksi = $transaksi->getByTanggal($keyword);
                    } else {
                        // Jika tidak ada pencarian, tampilkan semua transaksi
                        $dataTransaksi = $transaksi->getAll();
                    }
                    
                    $no = 1;
                    foreach ($dataTransaksi as $row) {
                ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo ($row['total_transaksi']) ?></td>
                            <td><?php echo ($row['total_diskon']) ?></td>
                            <td><?php echo ($row['nominal_tunai']) ?></td>
                            <td><?php echo ($row['ppn']) ?></td>
                            <td><?php echo ($row['kembalian']) ?></td>
                            <td><?php echo ($row['tanggal']) ?></td>
                            <td><?php echo ($row['invoice']) ?></td>
                            <td>
                                <a href="index.php?page=transaksi&act=edit&id_transaksi=<?php echo $row['id_transaksi'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="hapus('<?php echo htmlspecialchars($row['id_transaksi']); ?>'); return false;">
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
