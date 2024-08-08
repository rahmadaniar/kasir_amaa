<?php

class Auth
{
    private $db;
    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
        session_start(); // Pastikan session dimulai
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
                // Verifikasi password tanpa hash
                if ($password === $data['password']) {
                    $_SESSION['user'] = $data;
                    header('location: index.php');
                    exit();  // Pastikan menghentikan script setelah redirect
                } else {
                    header('location: index.php?page=login&message=gagal');
                    exit();
                }
            } else {
                header('location: index.php?page=login&message=gagal');
                exit();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function register($nama, $username, $password, $email, $role)
    {
        try {
            // Cek apakah username atau email sudah ada
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                header('location: index.php?page=register&message=user_exists');
                return false;
            }

            // Masukkan pengguna baru tanpa hash password
            $stmt = $this->db->prepare("INSERT INTO user (nama, username, password, email, role) VALUES (:nama, :username, :password, :email, :role)");
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);  // Simpan password secara langsung tanpa hash
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
            $stmt->execute();

            header('location: index.php?page=login&message=success');
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
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

}
