<?php 
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$datas = findAll('suppliers');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
</head>
<body>
    <h2>Data Supplier</h2>
    <a href="create.php">Tambah Supplier</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Kode Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat Supplier</th>
            <th>Nomor Telepon</th>
            <th colspan="2">Action</th>
        </tr>
        <?php foreach ($datas as $data): ?>
            <tr>
                <td><?=$data['id']?></td>
                <td><?=$data['code']?></td>
                <td><?=$data['name']?></td>
                <td><?=$data['address']?></td>
                <td><?=$data['phone_number']?></td>
                <td>
                    <a href="edit.php?id=<?=$data['id']?>">Edit</a>
                </td>
                <td>
                    <a href="delete.php?id=<?=$data['id']?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>