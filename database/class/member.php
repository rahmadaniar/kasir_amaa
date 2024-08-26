<?php

class Member
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
            self::$instance = new Member($pdo);
        }
        return self::$instance;
    }

    // function for menambahkan member dimulaiiiii 
    public function tambah($nama, $alamat, $no_telp, $jenis_kelamin, $total_poin)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO member (nama, alamat, no_telp, jenis_kelamin, total_poin) VALUES (:nama, :alamat, :no_telp, :jenis_kelamin, :total_poin)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":no_telp", $no_telp);
            $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindParam(":total_poin", $total_poin);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_member)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM member WHERE id_member = :id_member");
            $stmt->execute(array(":id_member" => $id_member));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for tambah member doneee

    // function for mengedit member dimulaiiiii 
    public function edit($id_member, $nama, $alamat, $no_telp, $jenis_kelamin, $total_poin)
    {
        try {
            $stmt = $this->db->prepare("UPDATE member SET nama = :nama, alamat = :alamat, no_telp = :no_telp, jenis_kelamin = :jenis_kelamin,  total_poin= :total_poin  WHERE id_member = :id_member");
            $stmt->bindParam(":id_member", $id_member);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":no_telp", $no_telp);
            $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindParam(":total_poin", $total_poin);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for mengedit member doneee

    // function for menghapus member dimulaiiiii 
    public function hapus($id_member)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM member WHERE id_member = :id_member");
            $stmt->bindParam(":id_member", $id_member);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menghapus member doneee

    // function for mendapatkan semua member dimulaiiiii 
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM member");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menampilkan semua member doneee
    public function getUmum()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM member WHERE nama = 'Umum'");
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data['id_member'];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
