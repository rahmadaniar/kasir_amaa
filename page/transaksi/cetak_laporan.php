<?php
require_once "vendor/autoload.php";
require_once "database/class/transaksi.php";

// Mengatur timezone
date_default_timezone_set('Asia/Jakarta'); // Ganti dengan timezone yang sesuai

// Inisialisasi mPDF
$mpdf = new \Mpdf\Mpdf();

// Koneksi ke database
$pdo = koneksi::connect();
$tanggal = $_GET['tanggal'] ?? ''; // Mengambil tanggal dari parameter GET
$transaksi = Transaksi::getInstance($pdo);

// Mengambil data transaksi dari database
$datatransaksi = $transaksi->getLaporanPenjualan($tanggal);

// Memulai pembuatan konten HTML untuk PDF
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: "Roboto", sans-serif; 
            font-size: 14px;
            color: #000;
            background-color: #fff;
            padding: 0;
            margin: 0;
        }
        h1 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 50px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #ffcccb; 
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #ffe6e6; 
        }
        .header, .footer {
            width: 100%;
            position: fixed;
            text-align: right;
            font-size: 10px;
            color: #888;
        }
        .header {
            top: -40px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .footer {
            bottom: -20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .page-number:before {
            content: "Page " counter(page);
        }
    </style>
</head>
<body>
    <div class="header">
        <span>Laporan Penjualan | ' . date("d-m-Y") . '</span>
    </div>
    <h1>Laporan Penjualan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Tanggal</th>
                <th>Total Transaksi</th>
                <th>Diskon</th>
                <th>Kasir</th>
                <th>Member</th>
            </tr>
        </thead>
        <tbody>';

// Menambahkan data transaksi ke dalam tabel
$i = 1;
foreach ($datatransaksi as $row) {
    $html .= '<tr>
        <td>' . $i . '</td>
        <td>' . htmlspecialchars($row["invoice"]) . '</td>
        <td>' . htmlspecialchars($row["tanggal"]) . '</td>
        <td>Rp ' . number_format($row["total_transaksi"], 2, ',', '.') . '</td>
        <td>Rp ' . number_format($row["total_diskon"], 2, ',', '.') . '</td>
        <td>' . htmlspecialchars($row["kasir"]) . '</td>
        <td>' . htmlspecialchars($row["member"]) . '</td>
    </tr>';
    $i++;
}

$html .= '
        </tbody>
    </table>
    <div class="footer">
        <div class="page-number"></div>
        <span>Dicetak pada ' . date("d-m-Y H:i:s") . '</span>
    </div>
</body>
</html>';

// Menulis HTML ke dalam PDF
$mpdf->WriteHTML($html);

// Menampilkan PDF ke browser
$mpdf->Output('Laporan_Penjualan_' . date("Ymd_His") . '.pdf', \Mpdf\Output\Destination::INLINE);
?>
