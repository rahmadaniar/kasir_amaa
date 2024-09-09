<?php

class Transaksi
{
    private static $instance = null;
    private $pdo;

    private function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance === null) {
            self::$instance = new self($pdo);
        }
        return self::$instance;
    }

    public function generateKodeNota()
    {
        // Query untuk mendapatkan nomor nota terbesar
        $query = "SELECT MAX(invoice) as kodeTerbesar11 FROM transaksi";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $datanya = $stmt->fetch(PDO::FETCH_ASSOC);
        $kodenota = $datanya['kodeTerbesar11'];

        // Ambil urutan dari nomor nota
        $urutan = (int) substr($kodenota, 9, 3);
        $urutan++;

        // Format tanggal
        $tgl = date("jnyGi");

        // Inisial huruf untuk nomor nota
        $huruf = "RD";

        // Hasil akhir nomor nota
        $kodeCart = $huruf . $tgl . sprintf("%03s", $urutan);

        return $kodeCart;
    }

    public function insertTransaksi($id_user, $total_transaksi, $total_diskon, $nominal_tunai, $ppn, $kembalian, $tanggal, $invoice, $pesan, $id_member, $subtotal)
    {
        $query = "INSERT INTO transaksi (id_user, total_transaksi, total_diskon, nominal_tunai, ppn, kembalian, tanggal, invoice, pesan, id_member, subtotal)
              VALUES ( :id_user,  :total_transaksi, :total_diskon, :nominal_tunai, :ppn, :kembalian, :tanggal, :invoice, :pesan, :id_member, :subtotal)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':id_user' => $id_user,
            ':total_transaksi' => $total_transaksi,
            ':total_diskon' => $total_diskon,
            ':nominal_tunai' => $nominal_tunai,
            ':ppn' => $ppn,
            ':kembalian' => $kembalian,
            ':tanggal' => $tanggal,
            ':invoice' => $invoice,
            ':pesan' => $pesan,
            ':id_member' => $id_member,
            ':subtotal' => $subtotal

        ]);

        return $this->pdo->lastInsertId();
    }

    public function insertTransaksiDetails($id_transaksi, $id_barang, $qty, $harga, $subtotal)
    {
        $query = "INSERT INTO transaksi_detail (id_transaksi, id_barang, qty, harga, subtotal)
              VALUES (:id_transaksi, :id_barang, :qty, :harga, :subtotal)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':id_transaksi' => $id_transaksi,
            ':id_barang' => $id_barang,
            ':qty' => $qty,
            ':harga' => $harga,
            ':subtotal' => $subtotal
        ]);
    }



    public function getLaporanPenjualan($tanggal = null)
    {
        if ($tanggal) {
            // Jika tanggal diberikan, tambahkan filter tanggal pada query
            $stmt = $this->pdo->prepare("SELECT t.*, m.nama as member, u.nama as kasir 
                                         FROM transaksi t 
                                         JOIN member m ON t.id_member = m.id_member 
                                         JOIN user u ON t.id_user = u.id_user
                                         WHERE DATE(t.tanggal) = :tanggal
                                         ORDER BY t.tanggal DESC");
            $stmt->bindParam(':tanggal', $tanggal);
        } else {
            // Jika tanggal tidak diberikan, ambil semua data
            $stmt = $this->pdo->prepare("SELECT t.*, m.nama as member, u.nama as kasir 
                                         FROM transaksi t 
                                         JOIN member m ON t.id_member = m.id_member 
                                         JOIN user u ON t.id_user = u.id_user
                                         ORDER BY t.tanggal DESC");
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function hapusTransaksi($id_transaksi)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM transaksi WHERE id_transaksi = :id_transaksi");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
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
            $stmt = $this->pdo->prepare("SELECT transaksi.*, member.nama, transaksi_detail.id_barang, transaksi_detail.qty, transaksi_detail.harga
                                         FROM transaksi
                                         LEFT JOIN member ON member.id_member = transaksi.id_member
                                         LEFT JOIN transaksi_detail ON transaksi_detail.id_transaksi = transaksi.id_transaksi;");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Iterasi untuk mengubah id_barang menjadi nama_barang
            foreach ($data as &$row) {                
                // Menambahkan qty dan harga ke dalam hasil
                $row['qty'] = $row['qty'];
                $row['harga'] = $row['harga'];
            }
    
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
}