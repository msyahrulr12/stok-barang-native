<?php

$host = 'localhost';
$username = 'root';
$password = 'mnka#2718';
$database = 'project_stok_barang_native';

$connection = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
    die('Koneksi ke database gagal!');
}

return $connection;

?>