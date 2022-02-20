<?php 
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$query = "";
if (isset($_GET['role'])) {
    $query = sprintf("WHERE role = '%s'", $_GET['role']);
}

$datas = findAll('users', "*", " ".$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
</head>
<body>
    <h2>Data User</h2>
    <a href="create.php">Tambah User</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Email User</th>
            <th>Username User</th>
            <th>Nomor Telepon</th>
            <th>Role</th>
            <th colspan="2">Action</th>
        </tr>
        <?php foreach ($datas as $data): ?>
            <tr>
                <td><?=$data['id']?></td>
                <td><?=$data['name']?></td>
                <td><?=$data['email']?></td>
                <td><?=$data['username']?></td>
                <td><?=$data['phone_number']?></td>
                <td><?=$data['role']?></td>
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