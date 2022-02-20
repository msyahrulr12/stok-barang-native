<?php
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$data = findOneBy('products', ['id' => $_GET['id']]);

if (isset($_POST['submit'])) {
    unset($_POST['submit']);

    $result = update('products', $_POST, ['id' => $_GET['id']]);
    if ($result) {
        redirect('./index.php');
    } else {
        echo 'Data gagal diedit!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
</head>
<body>
    <h2>Form Edit Barang</h2>
    <form action="" method="POST">
        <div>
            <label for="">Kode Barang</label>
            <input type="text" name="code" value="<?=$data['code']?>">
        </div>
        <div>
            <label for="">Nama Barang</label>
            <input type="text" name="name" value="<?=$data['name']?>">
        </div>
        <div>
            <label for="">Unit Barang</label>
            <input type="text" name="unit" value="<?=$data['unit']?>">
        </div>
        <div>
            <label for="">Qty Barang</label>
            <input type="number" name="qty" value="<?=$data['qty']?>">
        </div>
        <div>
            <label for="">Harga Barang</label>
            <input type="number" name="price" value="<?=$data['price']?>">
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>