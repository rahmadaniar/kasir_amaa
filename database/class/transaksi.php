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
    public function tambah($total_transaksi, $total_diskon, $nominal_tunai, $ppn, $kembalian, $tanggal, $invoice)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO transaksi (total_transaksi, total_diskon, nominal_tunai, ppn, kembalian, tanggal, invoice) VALUES (:total_transaksi, :total_diskon, :nominal_tunai, :ppn, :kembalian, :tanggal, :invoice)");
            $stmt->bindParam(":total_transaksi", $total_transaksi);
            $stmt->bindParam(":total_diskon", $total_diskon);
            $stmt->bindParam(":nominal_tunai", $nominal_tunai);
            $stmt->bindParam(":ppn", $ppn);
            $stmt->bindParam(":kembalian", $kembalian);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":invoice", $invoice);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM transaksi WHERE id_transaksi = :id_transaksi");
            $stmt->execute(array(":id_transaksi" => $id_transaksi));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH BARANG END

    // FUNCTION EDIT BARANG START
    public function edit($id_transaksi, $total_transaksi, $total_diskon, $nominal_tunai, $ppn, $kembalian, $tanggal, $invoice)
    {
        try {
            $stmt = $this->db->prepare("UPDATE transaksi SET total_transaksi = :total_transaksi, total_diskon = :total_diskon, nominal_tunai = :nominal_tunai, ppn = :ppn,  kembalian = :kembalian, tanggal = :tanggal, invoice = :invoice WHERE id_transaksi = :id_transaksi");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->bindParam(":total_transaksi", $total_transaksi);
            $stmt->bindParam(":total_diskon", $total_diskon);
            $stmt->bindParam(":nominal_tunai", $nominal_tunai);
            $stmt->bindParam(":ppn", $ppn);
            $stmt->bindParam(":kembalian", $kembalian);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->bindParam(":invoice", $invoice);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT BARANG END

    // FUNCTION DELETE BARANG START
    public function hapus($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM transaksi WHERE id_transaksi = :id_transaksi");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
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
            $stmt = $this->db->prepare("SELECT * FROM transaksi");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL BARANG END
    public function getByTanggal($tanggal)
{
    try {
        $stmt = $this->db->prepare("SELECT * FROM transaksi WHERE tanggal = :tanggal");
        $stmt->bindParam(":tanggal", $tanggal);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

}
