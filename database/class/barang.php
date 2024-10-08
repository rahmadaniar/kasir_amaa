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

    // function for menambahkan barang dimulaiiiii 
    public function tambah($nama, $id_jenis_barang, $harga, $stok, $gambar, $id_supplier)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO barang (nama, id_jenis_barang, harga, stok, gambar, id_supplier) VALUES (:nama, :id_jenis_barang, :harga, :stok, :gambar, :id_supplier)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":harga", $harga);
            $stmt->bindParam(":stok", $stok);
            $stmt->bindParam(":gambar", $gambar);
            $stmt->bindParam(":id_supplier", $id_supplier);
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
    // function for tambah barang doneee

    // function for mengedit barang dimulaiiiii
    public function edit($id_barang, $nama, $id_jenis_barang, $harga, $stok, $gambar, $id_supplier)
    {
        try {
            $stmt = $this->db->prepare("UPDATE barang SET nama = :nama, id_jenis_barang = :id_jenis_barang, harga = :harga, stok = :stok, gambar = :gambar, id_supplier = :id_supplier WHERE id_barang = :id_barang");
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":harga", $harga);
            $stmt->bindParam(":stok", $stok);
            $stmt->bindParam(":harga", $harga);
            $sql = "UPDATE barang SET nama = :nama, ";
            if ($gambar != '') {
                $sql .= "gambar = :gambar, ";
            }
            if ($gambar != '') {
                $stmt->bindParam(":gambar", $gambar);
            }
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // function for edit barang doneee

    // function untuk menghapus barang dimulaiiii
    public function hapus($id_barang)
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
    // function for hapus barang doneee

    // function for mendapatkan nilai semuanya dimulaiii
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT barang.*, jenis_barang.nama_jenis_barang, supplier.nama_supplier
                                        FROM barang
                                        JOIN jenis_barang ON jenis_barang.id_jenis_barang = barang.id_jenis_barang
                                        JOIN supplier ON supplier.id_supplier = barang.id_supplier;
                                        ");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //function for mendapatkan niai semuanya doneee

    public function getAllJenisBarang()
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

    public function getAllSupplier()
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
    public function kurangiStok($id_barang, $qty)
    {
        try {
            // Periksa stok sebelum mengurangi
            $stmt = $this->db->prepare("SELECT stok FROM barang WHERE id_barang = :id_barang");
            $stmt->execute([':id_barang' => $id_barang]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stok = $result['stok'];

            if ($stok < $qty) {
                throw new Exception("Stok tidak mencukupi untuk barang dengan ID $id_barang. Stok tersedia hanya: $stok.");
            }

            // Kurangi stok
            $stmt = $this->db->prepare("UPDATE barang SET stok = stok - :qty WHERE id_barang = :id_barang");
            $stmt->execute([
                ':qty' => $qty,
                ':id_barang' => $id_barang
            ]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            return false;
        }
    }
}
