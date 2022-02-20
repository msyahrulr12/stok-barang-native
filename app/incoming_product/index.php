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
    $search = "WHERE suppliers.name LIKE '%$search%'";
}

$joinTableProduct = joinTable("INNER JOIN", "incoming_products", "product_code", "products", "code");

$joinTableSupplier = joinTable("INNER JOIN", "incoming_products", "supplier_code", "suppliers", "code");

$datas = findAll('incoming_products', "incoming_products.date as ip_date, incoming_products.qty as ip_qty, products.name as p_name, incoming_products.price as ip_price, suppliers.name as s_name", $joinTableProduct." ".$joinTableSupplier." ".$search."  ORDER BY incoming_products.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Masuk</title>
</head>
<body>
    <h2>Data-Data Barang Masuk</h2>

    <div>
        <a href="./create.php">Tambah Barang Masuk</a>
    </div>

    <div>
        <form action="" method="GET">
            <div style="display: inline;">
                <input type="text" name="search" placeholder="Supplier" value="<?=$_GET['search'] ?? ''?>">
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
                    <th>Nama Supplier</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach ($datas as $key => $value):
                ?>
                <tr>
                    <td><?=$no++;?></td>
                    <td><?=$value['ip_date']?></td>
                    <td><?=$value['s_name']?></td>
                    <td><?=$value['p_name']?></td>
                    <td><?=$value['ip_qty']?></td>
                    <td><?=$value['ip_price']?></td>
                    <td><?=number_format($value['ip_qty']*$value['ip_price'])?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>