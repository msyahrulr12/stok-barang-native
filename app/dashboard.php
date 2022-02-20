<?php

require_once dirname(__DIR__).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('auth/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Transaksi Persediaan Barang</title>
</head>
<body>
    <h2 style="text-align: center;">Sistem Informasi Transaksi Persediaan Barang</h2>
    <hr>
    <div style="display: flex; justify-content: space-around;">
        <div>
            <h4>Master Data</h4>
            <ul>
                <li>
                    <a href="./product/index.php">Data Barang</a>
                </li>
                <li>
                    <a href="./supplier/index.php">Data Supplier</a>
                </li>
                <li>
                    <a href="./user/index.php">Data User</a>
                </li>
            </ul>
        </div>
        <div>
            <h4>Proses</h4>
            <ul>
                <li>
                    <a href="./incoming_product/index.php">Barang Masuk</a>
                </li>
                <li>
                    <a href="./outgoing_product/index.php">Barang Keluar</a>
                </li>
            </ul>
        </div>
        <div>
            <h4>Laporan</h4>
            <ul>
                <li>
                    <a href="./incoming_product/report.php">Laporan Barang Masuk</a>
                </li>
                <li>
                    <a href="./outgoing_product/report.php">Laporan Barang Keluar</a>
                </li>
            </ul>
        </div>
        <div>
            <h4>Pengguna</h4>
            <ul>
                <li>
                    <a href="./user/index.php?role=pegawai">Pegawai</a>
                </li>
                <li>
                    <a href="./auth/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>