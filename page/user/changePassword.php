<?php
$pdo = Koneksi::connect();
$user = User::getInstance($pdo);

$id_user = $_GET["id_user"];

if (isset($_POST["reset"])) {
    $password = $_POST["password"];

    if ($user->resetPassword($id_user, $password)) {
        echo '<script>window.location.href ="index.php?page=user&act=success";</script>';
    } else {
        $error = "Password tidak dapat direset.";
    }
}
?>

<div class="section-header">
    <h1>Change Password</h1>
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
                    <button type="submit" class="btn btn-info btn-lg btn-block" name="reset">
                        Confirm Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
