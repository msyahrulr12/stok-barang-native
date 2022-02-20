<?php
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$products = findAll('products');
$users = findAll('users', "*", " WHERE role = 'pegawai'");

if (isset($_POST['submit'])) {
    unset($_POST['submit']);

    $result = create('outgoing_products', $_POST);

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
    <title>Tambah Barang Keluar</title>
</head>
<body>
    <h2>Form Tambah Barang Keluar</h2>
    <form action="" method="POST">
        <div>
            <label for="">Kode</label>
            <input type="text" name="code">
        </div>
        <div>
            <label for="">Pegawai</label>
            <select name="user_id" id="user_id">
                <option value="">--Pilih Pegawai--</option>
                <?php foreach ($users as $key => $value): ?>
                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="date">
        </div>
        <div>
            <label for="">Produk</label>
            <select name="product_code" id="product_code">
                <option value="">--Pilih Produk--</option>
                <?php foreach ($products as $key => $value): ?>
                    <option value="<?=$value['code']?>"><?=$value['name']?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <label for="">Qty</label>
            <input type="number" name="qty">
        </div>
        <div>
            <label for="">Price</label>
            <input type="number" name="price">
        </div>        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>