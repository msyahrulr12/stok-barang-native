<?php
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$data = findOneBy('suppliers', ['id' => $_GET['id']]);

if (isset($_POST['submit'])) {
    unset($_POST['submit']);

    $result = update('suppliers', $_POST, ['id' => $_GET['id']]);
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
    <title>Edit Supplier</title>
</head>
<body>
    <h2>Form Edit Supplier</h2>
    <form action="" method="POST">
        <div>
            <label for="">Kode Supplier</label>
            <input type="text" name="code" value="<?=$data['code']?>">
        </div>
        <div>
            <label for="">Nama Supplier</label>
            <input type="text" name="name" value="<?=$data['name']?>">
        </div>
        <div>
            <label for="">Alamat Supplier</label>
            <input type="text" name="address" value="<?=$data['address']?>">
        </div>
        <div>
            <label for="">Nomor Telepon</label>
            <input type="number" name="phone_number" value="<?=$data['phone_number']?>">
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>