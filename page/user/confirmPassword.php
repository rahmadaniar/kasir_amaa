<?php
$pdo = Koneksi::connect();
$user = User::getInstance($pdo);

$id_user = $_GET["id_user"];

if (isset($_POST["confirm"])) {
    $password = htmlspecialchars($_POST['password']);
    
    error_log("Input password from form: " . $password);

    if ($user->confirmPassword($id_user, $password)) {
        echo '<script>
                window.location.href = "index.php?page=user&act=change-password&id_user=' . $id_user . '";
              </script>';
    } else {
        $error = "Password lama tidak sesuai.";
    }
}
?>

<div class="section-header">
    <h1>Ubah Password</h1>
</div>

<?php
if (isset($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}
?>


<div class="row">
    <div class="card">
        <form method="POST">
            <div class="card-body">
                <div class="">
                    <p>
                        Masukkan Password Lama Anda, Sebelum Anda Mengubah Password
                    </p>
                </div>
                <div class="col-20 col-md-16 col-lg-18">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" autocomplete="off" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="confirm" class="btn btn-info btn-lg btn-block">
                        Confirm Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
