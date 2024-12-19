<?php
require_once "vendor/autoload.php";
require_once "database/class/transaksi.php";
require_once "database/config.php";

// Koneksi ke database
$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$id_transaksi = isset($_GET['id_transaksi']) ? $_GET['id_transaksi'] : null;

$data_transaksi = $transaksi->getTransactionById($id_transaksi); 

$invoice = $transaksi->generateKodeNota();
if ($data_transaksi) {
    $mpdf = new \Mpdf\Mpdf();

    
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: "Courier New", monospace;
            font-size: 10px;
            margin: 0;
            padding: 10px;
        }
        .struk {
            width: 240px; 
            margin: auto;
            border: 1px dashed #000;
            padding: 10px;
            background-color: #f5f5f5; 
            color: #000; 
            text-align: center;
        }
        .header {
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 14px;
            margin: 0;
        }
        .header p {
            margin: 3px 0;
        }
        .details, .footer {
            text-align: left;
        }
        .details table {
            width: 100%;
            margin: 10px 0;
            border-collapse: collapse;
        }
        .details td {
            padding: 3px 0; 
        }
        .total {
            border-top: 1px dashed #000;
            padding-top: 5px;
            text-align: right;
            font-size: 12px; 
            font-weight: bold;
        }
        .footer {
            border-top: 1px dashed #000;
            padding-top: 5px;
            margin-top: 10px;
            text-align: center;
        }
        .footer p {
            margin: 3px 0;
        }
    </style>
</head>
<body>
    <div class="struk">
        <div class="header">
            <h1>KASIRKU</h1>
            <p>Jl. KH. Ahmad Dahlan No.15</p>
            <p>Telp: (021) 123-4567</p>
        </div>
        <div class="details">
            <p>ID Transaksi: ' . htmlspecialchars($data_transaksi[0]['id_transaksi']) . '</p>
            <p>Tanggal: ' . htmlspecialchars($data_transaksi[0]['tanggal']) . '</p>
            <p>Member: ' . htmlspecialchars($data_transaksi[0]['member_name']) . '</p>
            <table>
                <thead>
                    <tr>
                        <td>Item</td>
                        <td style="text-align: center;">Qty</td>
                        <td style="text-align: right;">Subtotal</td>
                    </tr>
                </thead>
                <tbody>';

// Looping untuk setiap detail transaksi
$total = 0;
foreach ($data_transaksi as $item) {
    $subtotal = $item['qty'] * $item['harga'];
    $total += $subtotal;

    $html .= '<tr>
                <td>' . htmlspecialchars($item['nama']) . '</td>
                <td style="text-align: center;">' . htmlspecialchars($item['qty']) . '</td>
                <td style="text-align: right;">Rp ' . number_format($subtotal, 0, ',', '.') . '</td>
            </tr>';
}

$html .= '
                </tbody>
            </table>
            <p class="total">Total: Rp ' . number_format($total, 0, ',', '.') . '</p>
        </div>
        <div class="footer">
            <p>*** Terima Kasih ***</p>
            <p>Barang yang sudah dibeli</p>
            <p>tidak dapat dikembalikan.</p>
        </div>
    </div>
</body>
</html>';

// Menulis konten HTML ke dalam PDF
$mpdf->WriteHTML($html);

// Menampilkan PDF ke browser atau menyimpannya sebagai file
$mpdf->Output('Struk_Transaksi_' . htmlspecialchars($data_transaksi[0]['id_transaksi']) . '.pdf', \Mpdf\Output\Destination::INLINE);
}
