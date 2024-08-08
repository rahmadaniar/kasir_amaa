<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>User</h3>
        <a href="index.php?page=user&act=tambah" class="btn btn-secondary">Tambah User</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = Koneksi::connect();
                $user = User::getInstance($pdo);
                $dataUser = $user->getAll();
                $no = 1;
                foreach ($dataUser as $row) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td>***</td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td>
                            <a href="index.php?page=user&act=edit&id_user=<?php echo htmlspecialchars($row['id_user']); ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="index.php?page=user&act=hapus&id_user=<?php echo htmlspecialchars($row['id_user']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php
                }

                Koneksi::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>