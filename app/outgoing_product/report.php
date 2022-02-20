<?php 
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$joinTableProduct = joinTable("INNER JOIN", "outgoing_products", "product_code", "products", "code");

$joinTableSupplier = joinTable("INNER JOIN", "outgoing_products", "user_id", "users", "id");

$datas = findAll('outgoing_products', "outgoing_products.date as op_date, outgoing_products.qty as op_qty, outgoing_products.price as op_price, products.name as p_name, users.name as u_name", " ".$joinTableProduct." ".$joinTableSupplier);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Barang Keluar</title>
</head>
<body style="text-align: center;">
    <h2>PT. Pratama Abadi Industri (jx) Kabupaten Sukabumi</h2>
    <h4>Laporan Data Barang Keluar</h4>

    <div style="margin-bottom: 10px;">
        <button id="print" type="button">Print</button>
    </div>

    <div style="width: 100%;">
        <table border="1" style="width: 100%;">
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
                    <td><?=number_format($value['op_price'])?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('print').addEventListener('click', function(e) {
            document.getElementById('link-dashboard').style.display = "none";
            this.style.display = 'none';
            window.print();
        });
    </script>

</body>
</html>