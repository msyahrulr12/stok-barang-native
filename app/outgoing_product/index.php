<?php 
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

if ($search != '') {
    $search = "WHERE users.name LIKE '%$search%'";
}

$joinTableProduct = joinTable("INNER JOIN", "outgoing_products", "product_code", "products", "code");

$joinTableSupplier = joinTable("INNER JOIN", "outgoing_products", "user_id", "users", "id");

$datas = findAll('outgoing_products', "outgoing_products.date as op_date, outgoing_products.qty as op_qty, outgoing_products.price as op_price, products.name as p_name, users.name as u_name", $joinTableProduct." ".$joinTableSupplier." ".$search."  ORDER BY outgoing_products.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Keluar</title>
</head>
<body>
    <h2>Data-Data Barang Keluar</h2>

    <div>
        <a href="./create.php">Tambah Barang Keluar</a>
    </div>

    <div>
        <form action="" method="GET">
            <div style="display: inline;">
                <input type="text" name="search" placeholder="Pegawai" value="<?=$_GET['search'] ?? ''?>">
            </div>
            <button type="submit">Search</button>
        </form>
    </div>

    <div>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pegawai</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach ($datas as $key => $value):
                ?>
                <tr>
                    <td><?=$no++;?></td>
                    <td><?=$value['op_date']?></td>
                    <td><?=$value['u_name']?></td>
                    <td><?=$value['p_name']?></td>
                    <td><?=$value['op_qty']?></td>
                    <td><?=$value['op_price']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>