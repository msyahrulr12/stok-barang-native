<?php 
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$joinTableProduct = joinTable("INNER JOIN", "incoming_products", "product_code", "products", "code");

$joinTableSupplier = joinTable("INNER JOIN", "incoming_products", "supplier_code", "suppliers", "code");

$datas = findAll('incoming_products', "incoming_products.date as ip_date, incoming_products.qty as ip_qty, products.name as p_name, incoming_products.price as ip_price, suppliers.name as s_name", " ".$joinTableProduct." ".$joinTableSupplier);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Barang Masuk</title>
</head>
<body style="text-align: center;">
    <h2>PT. Pratama Abadi Industri (jx) Kabupaten Sukabumi</h2>
    <h4>Laporan Data Barang Masuk</h4>

    <div style="margin-bottom: 10px;">
        <button id="print" type="button">Print</button>
    </div>

    <div>
        <table border="1" style="width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Supplier</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
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
                    <td><?=number_format($value['ip_price'])?></td>
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