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

    if ($new_password === $confirm_password) {
        if ($user->updatePassword($id_user, $new_password)) {
            echo "<script>alert('Password berhasil diubah'); window.location.href = 'index.php?page=user';</script>";
        } else {
            echo "Terjadi kesalahan saat mengubah password.";
        }
    } else {
        echo "Password baru tidak sesuai dengan konfirmasi password.";
    }
}
?>
<div class="row">
    <div class="card">
        <form method="POST">
            <div class="card-body">
                <div class="">
                    <p>Buat password baru</p>
                </div>
                <div class="col-20 col-md-16 col-lg-18">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" autocomplete="off" placeholder="Enter New Password" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="ganti_password" class="btn btn-info btn-lg btn-block">
                        Confirm Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
