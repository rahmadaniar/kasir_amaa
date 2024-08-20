<?php
$pdo = koneksi::connect();
$user = User::getInstance($pdo);

$id_user = $_GET["id_user"];

if (isset($_POST["confirm"])) {
    $password = htmlspecialchars($_POST['password']);

    // Cek apakah password sudah diisi
    if (empty($password)) {
        echo '<script>
                Swal.fire({
                    icon: "warning",
                    title: "Kolom Kosong",
                    text: "Harap isi kolom password sebelum melanjutkan.",
                    showConfirmButton: true
                });
              </script>';
    } else {
        if ($user->confirmPassword($id_user, $password)) {
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Password lama sesuai. Anda akan diarahkan untuk mengubah password.",
                        showConfirmButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php?page=user&act=change-password&id_user=' . $id_user . '";
                        }
                    });
                  </script>';
        } else {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Password lama tidak sesuai.",
                        showConfirmButton: true
                    });
                  </script>';
        }
    }
}
?>

<div class="d-flex justify-content-center align-items-start" style="height: 80vh; margin-top: 10vh;">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h1>Change Password</h1>
                <hr>
                <p>Masukkan Password Lama Anda, Sebelum Anda Mengubah Password</p>
            </div>
            <form method="POST">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" autocomplete="off" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="confirm" class="btn btn-info btn-lg btn-block">
                        Confirm Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
