<?php
require_once "vendor/autoload.php";
require_once "database/class/transaksi.php";
require_once "database/config.php";

$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);

// Ambil data transaksi
$data_transaksi = $transaksi->getAll();

// Inisialisasi mPDF
$mpdf = new \Mpdf\Mpdf();

// Konten HTML untuk struk transaksi
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: "Roboto", sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .struk {
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        .struk h1, .struk h2 {
            text-align: center;
            margin: 0;
        }
        .struk p {
            margin: 5px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>';

// Looping untuk setiap transaksi
foreach ($data_transaksi as $transaksi) {
    $html .= '
    <div class="struk">
        <h1>Kasir Ama</h1>
        <h2>Struk Transaksi</h2>

        <p><strong>ID Transaksi:</strong> ' . htmlspecialchars($transaksi['id_transaksi']) . '</p>
        <p><strong>Tanggal:</strong> ' . htmlspecialchars($transaksi['tanggal']) . '</p>
        <p><strong>Member:</strong> ' . htmlspecialchars($transaksi['nama']) . '</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>';

    // Looping untuk setiap detail transaksi
    $total = 0;
    foreach ($data_transaksi as $item) {
        if ($item['id_transaksi'] == $transaksi['id_transaksi']) {
            $subtotal = $item['qty'] * $item['harga'];
            $total += $subtotal;

            $html .= '<tr>
                <td>' . htmlspecialchars($item['id_barang']) . '</td>
                <td>' . htmlspecialchars($item['qty']) . '</td>
                <td>Rp ' . number_format($item['harga'], 0, ',', '.') . '</td>
                <td>Rp ' . number_format($subtotal, 0, ',', '.') . '</td>
            </tr>';
        }
    }

    $html .= '
            </tbody>
        </table>

        <p class="total"><strong>Total:</strong> Rp ' . number_format($total, 0, ',', '.') . '</p>
        <p style="text-align: center;">Terima Kasih atas Kunjungan Anda!</p>
    </div>';
}

$html .= '
</body>
</html>';

// Menulis konten HTML ke dalam PDF
$mpdf->WriteHTML($html);

// Menampilkan PDF ke browser atau menyimpannya sebagai file
$mpdf->Output('Struk_Transaksi_' . htmlspecialchars($transaksi['id_transaksi']) . '.pdf', \Mpdf\Output\Destination::INLINE);
?>
