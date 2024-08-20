<?php
if ($_SESSION['user']['role'] == "Kasir" || $_SESSION['user']['role'] == "Admin") {
    echo "<script>window.location.href = 'index.php'</script>";
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="mb-4">Tambah User</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email User">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="SuperAdmin">Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="Kasir">Kasir</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>




<?php
if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    if (empty($nama) || empty($username) || empty($password) || empty($email) || empty($role)) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Kolom Kosong',
                text: 'Harap mengisi semua kolom yang diperlukan.',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {

        $pdo = koneksi::connect();
        $user = User::getInstance($pdo);
        $success = $user->tambah($nama, $username, $password, $email, $role);

        if ($success) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'User berhasil ditambahkan!',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'index.php?page=user';
            });
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan saat menyimpan data.',
                confirmButtonText: 'OK'
            });
        </script>";
        }
    }
}

?>