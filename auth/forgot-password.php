<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot Password</title>

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
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your username, email address and new password below!</p>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Enter New Password">
                                        </div>
                                        <button type="submit" name="reset" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php?auth=login">Back To Login Menu</a>
                                    </div>
                                </div>
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
    
    <?php
    require_once 'database/config.php';
    require_once 'database/class/auth.php';

    $pdo = koneksi::connect();
    $auth = Auth::getInstance($pdo);

    $alert = ''; // Variable untuk menyimpan kode alert
    
    if (isset($_POST["reset"])) {
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        if (!empty($username) && !empty($email) && !empty($password)) {
            if ($auth->forgotPassword($username, $email, $password)) {
                $alert = "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Berhasil Direset',
                        text: 'Password Anda telah berhasil direset!',
                        showConfirmButton: true
                    });
                </script>";
            } else {
                $alert = "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Reset Password Gagal',
                        text: 'Reset password gagal. Pastikan username dan email sesuai.',
                        showConfirmButton: true
                    });
                </script>";
            }
        } else {
            $alert = "
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Kolom Belum Diisi',
                    text: 'Harap isi semua kolom.',
                    showConfirmButton: true
                });
            </script>";
        }
    }

    // Menampilkan SweetAlert jika variabel $alert tidak kosong
    if ($alert !== '') {
        echo $alert;
    }
    ?>

</body>

</html>
