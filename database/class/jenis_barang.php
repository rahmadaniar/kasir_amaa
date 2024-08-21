<?php

class Jenis_barang
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
            self::$instance = new Jenis_barang($pdo);
        }
        return self::$instance;
    }

    // function for menambahkan jenis_barang dimulaiiiii 
    public function tambah($nama_jenis_barang)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO jenis_barang (nama_jenis_barang) VALUES (:nama_jenis_barang)");
            $stmt->bindParam(":nama_jenis_barang", $nama_jenis_barang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_jenis_barang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM jenis_barang WHERE id_jenis_barang = :id_jenis_barang");
            $stmt->execute(array(":id_jenis_barang" => $id_jenis_barang));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for tambah jenis_barang doneee

    // function for mengedit jenis_barang dimulaiiiii 
    public function edit($id_jenis_barang, $nama_jenis_barang)
    {
        try {
            $stmt = $this->db->prepare("UPDATE jenis_barang SET nama_jenis_barang = :nama_jenis_barang WHERE id_jenis_barang = :id_jenis_barang");
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":nama_jenis_barang", $nama_jenis_barang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for mengedit jenis_barang doneee

    // function for menghapus jenis_barang dimulaiiiii 
    public function hapus($id_jenis_barang)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM jenis_barang WHERE id_jenis_barang = :id_jenis_barang");
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menghapus jenis_barang doneee

    // function for mendapatkan semua jenis_barang dimulaiiiii 
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM jenis_barang");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menampilkan semua jenis_barang doneee
}
