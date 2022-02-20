<?php
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$datas = findAll('suppliers');

if (isset($_POST['submit'])) {
    unset($_POST['submit']);

    $result = create('suppliers', $_POST);

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
    <title>Tambah Supplier</title>
</head>
<body>
    <h2>Form Tambah Supplier</h2>
    <form action="" method="POST">
        <div>
            <label for="">Kode Supplier</label>
            <input type="text" name="code">
        </div>
        <div>
            <label for="">Nama Supplier</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="">Alamat Supplier</label>
            <input type="text" name="address">
        </div>
        <div>
            <label for="">Nomor Telepon</label>
            <input type="number" name="phone_number">
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>