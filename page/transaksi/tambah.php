<?php

include_once "../../database/config.php";
include_once "../../database/class/transaksi.php";

$data = json_decode(file_get_contents('php://input'), true);

$transaksiData = $data['transaksi'];
$transaksiDetailsData = $data['transaksiDetails'];

$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);

try {
    // Mulai transaksi
    $pdo->beginTransaction();

    // Simpan transaksi
    $idTransaksi = $transaksi->insertTransaksi(
        // $transaksiData['id_barang'],
        $transaksiData['id_user'],
        // $transaksiData['id_cabang'],
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

    // Simpan detail transaksi
    foreach ($transaksiDetailsData as $detail) {
        $transaksi->insertTransaksiDetails(
            $idTransaksi,
            $detail['id_barang'],
            $detail['qty'],
            $detail['harga'],
            $detail['subtotal']
        );
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
