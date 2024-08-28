<?php

include_once "../../database/config.php";
include_once "../../database/class/transaksi.php";
include_once "../../database/class/barang.php";
include_once "../../database/class/member.php"; 

$data = json_decode(file_get_contents('php://input'), true);

$transaksiData = $data['transaksi'];
$transaksiDetailsData = $data['transaksiDetails'];

$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$barang = Barang::getInstance($pdo);
$member = Member::getInstance($pdo); 

try {
    // Mulai transaksi
    $pdo->beginTransaction();

    // Simpan transaksi
    $idTransaksi = $transaksi->insertTransaksi(
        $transaksiData['id_user'],
        $transaksiData['total_transaksi'],
        $transaksiData['total_diskon'],
        $transaksiData['nominal_tunai'],
        $transaksiData['ppn'],
        $transaksiData['kembalian'],
        $transaksiData['tanggal'],
        $transaksiData['invoice'],
        $transaksiData['pesan'],
        $transaksiData['id_member'],
        $transaksiData['subtotal']
    );

    // Simpan detail transaksi dan kurangi stok barang
    foreach ($transaksiDetailsData as $detail) {
        // Kurangi stok barang jika stok mencukupi
        $result = $barang->kurangiStok($detail['id_barang'], $detail['qty']);
        if (!$result) {
            throw new Exception("Gagal mengurangi stok untuk barang ID: {$detail['id_barang']}");
        }

        // Insert transaksi detail
        $transaksi->insertTransaksiDetails(
            $idTransaksi,
            $detail['id_barang'],
            $detail['qty'],
            $detail['harga'],
            $detail['subtotal']
        );
    }

    // Tambahkan poin ke member, jika member bukan "Umum"
    $id_member = $transaksiData['id_member'];
    $memberUmum = $member->getUmum(); // Asumsikan ini mendapatkan ID untuk member "Umum"
    if ($id_member != $memberUmum) {
        // Hitung poin berdasarkan total transaksi
        $total_transaksi = $transaksiData['total_transaksi'];
        $total_poin = floor($total_transaksi / 10000); // 1 poin per Rp10.000

        // Ambil data member saat ini
        $memberData = $member->getID($id_member);
        if (!$memberData) {
            throw new Exception("Member tidak ditemukan.");
        }

        // Tambahkan poin ke total poin member yang ada
        $total_poin_baru = $memberData['total_poin'] + $total_poin;

        // Update poin member
        $member->tambahPoin($id_member, $total_poin_baru);
    }

    // Commit transaksi
    $pdo->commit();

    // Jika berhasil
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Rollback transaksi jika ada kesalahan
    $pdo->rollBack();

    
    // Jika gagal
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
