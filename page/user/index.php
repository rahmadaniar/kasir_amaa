<?php
// Redirection untuk user dengan role "Kasir"
if ($_SESSION['user']['role'] == "Kasir" ||$_SESSION['user']['role'] == "Admin") {
    echo "<script>window.location.href = 'index.php'</script>";
    exit(); 
}

// Tampilkan alert sukses jika supplier berhasil diedit
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'User berhasil diedit!',
            confirmButtonText: 'OK'
        });
    </script>";
}
?>
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
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = koneksi::connect();
                $user = User::getInstance($pdo);
                $dataUser = $user->getAll();
                $no = 1;
                foreach ($dataUser as $row) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td>
                            <a href="index.php?page=user&act=edit&id_user=<?php echo htmlspecialchars($row['id_user']); ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="hapus('<?php echo htmlspecialchars($row['id_user']); ?>'); return false;">
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

<script>
    function hapus(id_user) {
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
                window.location.href = `index.php?page=user&act=hapus&id_user=${id_user}`;
            }
        });
    }
</script>