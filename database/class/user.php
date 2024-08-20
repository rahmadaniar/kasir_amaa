<?php

class User
{
    private $db;
    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new User($pdo);
        }

        return self::$instance;
    }

    public function tambah($nama, $username, $password, $email, $role)
    {
        try {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO user (nama, username, password, email, role) VALUES (:nama, :username, :password, :email, :role)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashPassword);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":role", $role);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_user)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function edit($id_user, $nama, $username, $email, $role)
    {
        try {
            $stmt = $this->db->prepare("SELECT password FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $this->db->prepare("UPDATE user SET nama = :nama, username = :username, email = :email, role = :role WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":role", $role);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function hapus($id_user)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function confirmPassword($id_user, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT password FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data && password_verify($password, $data['password'])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updatePassword($id_user, $new_password)
    {
        try {
            $hashPassword = password_hash($new_password, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("UPDATE user SET password = :password WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":password", $hashPassword);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    
}
