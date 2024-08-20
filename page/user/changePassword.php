<?php
if (empty($_GET['id_user'])) {
    header("Location: index.php?page=user");
    exit();
}

$id_user = $_GET['id_user'];
$pdo = koneksi::connect();
$user = User::getInstance($pdo);

if (isset($_POST['ganti_password'])) {
    $new_password = htmlspecialchars($_POST['new_password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    if (empty($new_password) || empty($confirm_password)) {
        echo '<script>
                Swal.fire({
                    icon: "warning",
                    title: "Kolom Kosong",
                    text: "Harap isi semua kolom sebelum melanjutkan.",
                    showConfirmButton: true
                });
              </script>';
    } elseif ($new_password === $confirm_password) {
        if ($user->updatePassword($id_user, $new_password)) {
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Password berhasil diubah.",
                        showConfirmButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php?page=user";
                        }
                    });
                  </script>';
        } else {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Terjadi kesalahan saat mengubah password.",
                        showConfirmButton: true
                    });
                  </script>';
        }
    } else {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Password baru tidak sesuai dengan konfirmasi password.",
                    showConfirmButton: true
                });
              </script>';
    }
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Ganti Password</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label>Password Baru</label>
                    <input name="new_password" type="password" class="form-control" placeholder="Password Baru">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input name="confirm_password" type="password" class="form-control" placeholder="Konfirmasi Password Baru">
                </div>
                <button type="submit" class="btn btn-primary" name="ganti_password">Ganti Password</button>
                <a href="index.php?page=user" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
