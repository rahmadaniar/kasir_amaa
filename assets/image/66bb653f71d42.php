<?php

class Barang
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
            self::$instance = new Barang($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH BARANG START
    public function add($nama_barang, $gambar, $harga_barang, $stok_barang)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO barang (nama_barang, gambar, harga_barang, stok_barang) VALUES (:nama_barang, :gambar, :harga_barang, :stok_barang)");
            $stmt->bindParam(":nama_barang", $nama_barang);
            $stmt->bindParam(":gambar", $gambar);
            $stmt->bindParam(":harga_barang", $harga_barang);
            $stmt->bindParam(":stok_barang", $stok_barang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_barang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM barang WHERE id_barang = :id_barang");
            $stmt->execute(array(":id_barang" => $id_barang));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH BARANG END

    // FUNCTION EDIT BARANG START
    public function update($id_barang, $gambar, $nama_barang, $harga_barang, $stok_barang)
    {
        try {
            $stmt = $this->db->prepare("UPDATE barang SET nama_barang = :nama_barang, gambar = :gambar, harga_barang = :harga_barang, stok_barang = :stok_barang WHERE id_barang = :id_barang");
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->bindParam(":gambar", $gambar);
            $stmt->bindParam(":nama_barang", $nama_barang);
            $stmt->bindParam(":harga_barang", $harga_barang);
            $stmt->bindParam(":stok_barang", $stok_barang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT BARANG END

    // FUNCTION DELETE BARANG START
    public function delete($id_barang)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM barang WHERE id_barang = :id_barang");
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE BARANG END

    // FUNCTION GET ALL BARANG START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM barang");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL BARANG END
}
?>