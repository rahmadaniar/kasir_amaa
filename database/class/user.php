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
            if ($this->cekUsernameDanEmail($username, $email)) {
                return false;
            }

            // Enkripsi
            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
            // Masukkan user baru ke database
            $stmt = $this->db->prepare("INSERT INTO user(id_user, nama, username, password, email, role) VALUES(NULL, :nama, :username, :password, :email, :role)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashPasswd);
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
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
        $stmt->execute(array(":id_user" => $id_user));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function update($id_user, $nama, $username, $email, $role)
    {
        try {
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

    public function delete($id_user)
    {
        $stmt = $this->db->prepare("DELETE FROM user WHERE id_user = :id_user");
        $stmt->bindParam(":id_user", $id_user);
        $stmt->execute();
        return true;
    }

    public function confirmPassword($id_user, $oldPassword)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            $data = $stmt->fetch();

            if ($stmt->rowCount() == 1) {
                if (password_verify($oldPassword, $data["password"])) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function resetPassword($id_user, $password)
    {
        try {
            // Fetch user to ensure user exists
            $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return $this->updatePassword($id_user, $password);
            } else {
                echo "User not found";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updatePassword($id_user, $password)
    {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE user SET password = :password WHERE id_user = :id_user");
            $stmt->bindParam(":password", $hash);
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function cekUsernameDanEmail($username, $email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username OR email = :email");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Tambahkan metode getData untuk mengambil data user
    public function getData()
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

    public function getError()
    {
        return true;
    }
}
