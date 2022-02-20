<?php
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$datas = findAll('products');

if (isset($_POST['submit'])) {
    unset($_POST['submit']);

    $result = create('products', $_POST);

    if ($result) {
        redirect('./index.php');
    } else {
        echo 'Data gagal disimpan!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
</head>
<body>
    <h2>Form Tambah Barang</h2>
    <form action="" method="POST">
        <div>
            <label for="">Kode Barang</label>
            <input type="text" name="code">
        </div>
        <div>
            <label for="">Nama Barang</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="">Unit Barang</label>
            <input type="text" name="unit">
        </div>
        <div>
            <label for="">Qty Barang</label>
            <input type="number" name="qty">
        </div>
        <div>
            <label for="">Harga Barang</label>
            <input type="number" name="price">
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>