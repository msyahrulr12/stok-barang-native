<?php
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$datas = findAll('users');

if (isset($_POST['submit'])) {
    unset($_POST['submit']);

    $_POST['password'] = md5($_POST['password']);
    $result = create('users', $_POST);

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
    <title>Tambah User</title>
</head>
<body>
    <h2>Form Tambah User</h2>
    <form action="" method="POST">
        <div>
            <label for="">Nama User</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="">Email User</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="">Username User</label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="">Password User</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="">Nomor Telepon User</label>
            <input type="text" name="phone_number">
        </div>
        <div>
            <label for="">Role</label>
            <select name="role">
                <option value="pimpinan">Pimpinan</option>
                <option value="admin">Admin</option>
                <option value="operator">Operator</option>
                <option value="gudang">Gudang</option>
                <option value="pegawai">Pegawai</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>