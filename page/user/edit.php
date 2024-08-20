<?php


if (empty($_GET['id_user'])) {
    echo "<script>window.location.href = 'index.php?page=user'</script>";
    exit();
}

$id_user = $_GET['id_user'];
$pdo = koneksi::connect();
$user = User::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    $result = $user->edit($id_user, $nama, $username, $email, $role);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=user&edit_success=true'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $user->getID($id_user);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=user'</script>";
    exit();
}

$nama = htmlspecialchars($data['nama']);
$username = htmlspecialchars($data['username']);
$email = htmlspecialchars($data['email']);
$role = htmlspecialchars($data['role']);
?>

<?php
if ($_SESSION['user']['role'] == "Kasir" || $_SESSION['user']['role'] == "Admin") {
    echo "<script>window.location.href = 'index.php'</script>";
}
// Tampilkan alert jika edit berhasil
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
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-4">
                <h3>Edit user</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama); ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" class="form-control" placeholder="Masukkan username" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" class="form-control" placeholder="Masukkan email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" class="form-control" required>
                        <option value="">Pilih Role Anda</option>
                        <option value="SuperAdmin" <?php if (isset($role) && $role == 'SuperAdmin') echo 'selected'; ?>>SuperAdmin</option>
                        <option value="Admin" <?php if (isset($role) && $role == 'Admin') echo 'selected'; ?>>Admin</option>
                        <option value="Kasir" <?php if (isset($role) && $role == 'Kasir') echo 'selected'; ?>>Kasir</option>
                    </select>
                    </select>
                </div>
                <div class="form-group">
                    <a href="index.php?page=user&act=confirm-password&id_user=<?= $id_user ?>">Change Password</a>
                    <br>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=user" class="btn btn-secondary">Kembali</a>

                </div>
            </form>
        </div>
    </div>
</div>