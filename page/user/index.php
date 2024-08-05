<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h3>User</h3>
            <a href="index.php?page=user&act=tambah" class="btn btn-secondary">Tambah User</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
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
                    $dataUser = $user->getData(); // Menggunakan metode getData
                    if ($dataUser && is_array($dataUser)) {
                        foreach ($dataUser as $row) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td>****</td>
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
