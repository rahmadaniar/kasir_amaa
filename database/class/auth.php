<?php

class Auth
{
    private $db;
    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
        @session_start();
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new Auth($pdo);
        }
        return self::$instance;
    }

    public function login($username, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                // Verifikasi kata sandi yang diinput dengan yang ada di database
                if (password_verify($password, $data['password'])) {  
                    $_SESSION['user'] = $data;
                    header('location: index.php?');
                    return true;
                } else {
                    echo "Password salah.";
                    header('location: index.php?auth=login&message=gagal');
                    return false;
                }
            } else {
                echo "Username tidak ditemukan.";
                header('location: index.php?auth=login&message=gagal');
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function register($nama, $username, $password, $email, $role)
    {
        try {
            // Cek apakah ada kolom yang kosong
            if (empty($nama) || empty($username) || empty($password) || empty($email) || empty($role)) {
                header('Location: index.php?auth=register&message=empty');
                exit();
            }
    
            // Cek apakah username atau email sudah ada
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($data) {
                header('Location: index.php?auth=register&message=error');
                exit();
            }
    
            // Hash password sebelum disimpan ke database
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Masukkan pengguna baru
            $stmt = $this->db->prepare("INSERT INTO user (nama, username, password, email, role) VALUES (:nama, :username, :password, :email, :role)");
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashPassword);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
            $stmt->execute();
    
            header('Location: index.php?auth=register&message=register');
            exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    

    public function forgotPassword($username, $email, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username AND email = :email");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $this->NewPassword($username, $email, $password);
                echo "success";
                return true;
            } else {
                echo "error";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function NewPassword($username, $email, $password)
    {
        try {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE user SET password = :password WHERE username = :username AND email = :email");
            $stmt->bindParam(":password", $hashPassword);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUser()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return null;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        return true;
    }
}
