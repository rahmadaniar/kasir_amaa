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

    public function insertTransaksi($id_user,  $total_transaksi, $total_diskon, $nominal_tunai, $ppn, $kembalian, $tanggal, $invoice, $pesan, $id_member, $subtotal)
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
    
    
}
