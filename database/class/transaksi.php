<?php

class Transaksi
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
            self::$instance = new Transaksi($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH BARANG START
    public function tambah($kembalian, $ppn, $tanggal, $total_diskon, $total_transaksi, $nominal_tunai)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO supplier (kembalian, ppn, tanggal, total_diskon, total_transaksi, nominal_tunai) VALUES (:kembalian, :ppn, :tanggal, :total_diskon, :total_transaksi, :nominal_tunai)");
            $stmt->bindParam(":kembalian", $kembalian);
            $stmt->bindParam(":ppn", $ppn);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":total_diskon", $total_diskon);
            $stmt->bindParam(":total_transaksi", $total_transaksi);
            $stmt->bindParam(":nominal_tunai", $nominal_tunai);

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
    // FUNCTION TAMBAH BARANG END

    // FUNCTION EDIT BARANG START
    public function edit($id_supplier, $kembalian, $ppn, $tanggal, $total_diskon, $total_transaksi)
    {
        try {
            $stmt = $this->db->prepare("UPDATE supplier SET kembalian = :kembalian, ppn = :ppn, tanggal = :tanggal, total_diskon = :total_diskon,  total_transaksi= :total_transaksi  WHERE id_supplier = :id_supplier");
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->bindParam(":kembalian", $kembalian);
            $stmt->bindParam(":ppn", $ppn);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":total_diskon", $total_diskon);
            $stmt->bindParam(":total_transaksi", $total_transaksi);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT BARANG END

    // FUNCTION DELETE BARANG START
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
    // FUNCTION DELETE BARANG END

    // FUNCTION GET ALL BARANG START
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
    // FUNCTION GET ALL BARANG END
}
