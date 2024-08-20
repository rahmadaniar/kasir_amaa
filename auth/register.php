<?php

// Mulai PHP tanpa output sebelumnya
if (isset($_POST['register'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    require_once 'database/config.php';
    require_once 'database/class/auth.php';

    $pdo = koneksi::connect();
    $auth = Auth::getInstance($pdo);

    if (!empty($nama) && !empty($username) && !empty($password) && !empty($email) && !empty($role)) {
        if ($auth->register($nama, $username, $password, $email, $role)) {
            // Redirect dengan pesan sukses
            header("Location: index.php?auth=register&message=register");
            exit();
        } else {
            // Redirect dengan pesan error
            header("Location: index.php?auth=register&message=error");
            exit();
        }
    } else {
        // Redirect jika ada kolom yang belum diisi
        header("Location: index.php?auth=register&message=empty");
        exit();
    }
}

// Kode HTML dimulai setelah PHP
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="bg-gradient-info">

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-3 bg-register-image"></div>
                    <div class="col-lg-5">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama" id="exampleName" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username" id="exampleUsername" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <select name="role" class="form-control form-control-user">
                                        <option value="">Pilih Role</option>
                                        <option value="SuperAdmin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Kasir">Kasir</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">I agree with the terms and conditions</label>
                                    </div>
                                </div>
                                <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="index.php?auth=login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        <?php
        // Cek apakah parameter `message` ada di URL
        if (isset($_GET['message'])) {
            $message = htmlspecialchars($_GET['message']); // Sanitasi input
            if ($message === 'register') {
                echo "Swal.fire({
                    icon: 'success',
                    title: 'Register Berhasil',
                    text: 'Anda telah membuat akun!',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php?auth=login';
                    }
                });";
            } elseif ($message === 'error') {
                echo "Swal.fire({
                    icon: 'error',
                    title: 'Register Gagal',
                    text: 'Gagal membuat akun!',
                    showConfirmButton: true
                });";
            } elseif ($message === 'empty') {
                echo "Swal.fire({
                    icon: 'warning',
                    title: 'Form Tidak Lengkap',
                    text: 'Harap isi semua kolom sebelum melanjutkan!',
                    showConfirmButton: true
                });";
            }
        }
        ?>
    </script>

</body>

</html>
