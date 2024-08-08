<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>Member</h3>
        <a href="index.php?page=member&act=tambah" class="btn btn-secondary ">Tambah Member</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Jenis Kelamin</th>
                    <th>Total Poin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = koneksi::connect();
                $member = member::getInstance($pdo);
                $dataMember = $member->getAll();
                $no = 1;
                foreach ($dataMember as $row) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo ($row['nama']); ?></td>
                        <td><?php echo ($row['alamat']); ?></td>
                        <td><?php echo ($row['no_telp']); ?></td>
                        <td><?php echo ($row['jenis_kelamin']); ?></td>
                        <td><?php echo ($row['total_poin']); ?></td>
                        <td>
                            <a href="index.php?page=member&act=edit&id_member=<?php echo $row['id_member'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="index.php?page=member&act=hapus&id_member=<?php echo $row['id_member'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
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