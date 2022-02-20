<?php
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$data = findOneBy('users', ['id' => $_GET['id']]);

if (isset($_POST['submit'])) {
    unset($_POST['submit']);

    $_POST['password'] = md5($_POST['password']);
    $result = update('users', $_POST, ['id' => $_GET['id']]);
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
    <title>Edit User</title>
</head>
<body>
    <h2>Form Edit User</h2>
    <form action="" method="POST">
        <div>
            <label for="">Nama User</label>
            <input type="text" name="name" value="<?=$data['name']?>">
        </div>
        <div>
            <label for="">Email User</label>
            <input type="email" name="email" value="<?=$data['email']?>">
        </div>
        <div>
            <label for="">Username User</label>
            <input type="text" name="username" value="<?=$data['username']?>">
        </div>
        <div>
            <label for="">Password User</label>
            <input type="password" name="password" value="" autocomplete="off">
        </div>
        <div>
            <label for="">Nomor Telepon</label>
            <input type="number" name="phone_number" value="<?=$data['phone_number']?>">
        </div>
        <div>
            <label for="">Role</label>
            <select name="role">
                <option value="pimpinan" <?=$data['role'] == 'pimpinan' ? 'selected' : ''?>>Pimpinan</option>
                <option value="admin" <?=$data['role'] == 'admin' ? 'selected' : ''?>>Admin</option>
                <option value="operator" <?=$data['role'] == 'operator' ? 'selected' : ''?>>Operator</option>
                <option value="operator" <?=$data['role'] == 'operator' ? 'selected' : ''?>>Gudang</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>