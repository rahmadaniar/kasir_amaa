<?php

class Supplier
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
            self::$instance = new Supplier($pdo);
        }
        return self::$instance;
    }

    // function for menambahkan supplier dimulaiiiii 
    public function tambah($nama_supplier, $alamat, $email, $no_telp, $no_rekening)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO supplier (nama_supplier, alamat, email, no_telp, no_rekening) VALUES (:nama_supplier, :alamat, :email, :no_telp, :no_rekening)");
            $stmt->bindParam(":nama_supplier", $nama_supplier);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":no_telp", $no_telp);
            $stmt->bindParam(":no_rekening", $no_rekening);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_supplier)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM supplier WHERE id_supplier = :id_supplier");
            $stmt->execute(array(":id_supplier" => $id_supplier));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for tambah supplier doneee

    // function for mengedit supplier dimulaiiiii 
    public function edit($id_supplier, $nama_supplier, $alamat, $email, $no_telp, $no_rekening)
    {
        try {
            $stmt = $this->db->prepare("UPDATE supplier SET nama_supplier = :nama_supplier, alamat = :alamat, email = :email, no_telp = :no_telp,  no_rekening= :no_rekening  WHERE id_supplier = :id_supplier");
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->bindParam(":nama_supplier", $nama_supplier);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":no_telp", $no_telp);
            $stmt->bindParam(":no_rekening", $no_rekening);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for edit supplier doneee

    // function for menghapus supplier dimulaiiiii 
    public function hapus($id_supplier)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM supplier WHERE id_supplier = :id_supplier");
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menghapus supplier doneee

    // function for mendapatkan semua supplier dimulaiiiii 
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM supplier");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menampilkan semua supplier doneee
}
