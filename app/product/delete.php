<?php
require_once dirname(dirname(__DIR__)).'/system.php';

if (!isset($_SESSION['auth'])) {
    redirect('../auth/login.php');
}

$id = $_GET['id'];

$result = delete('products', ['id' => $id]);

if ($result) {
    redirect('./index.php');
} else {
    echo 'Data gagal dihapus!';
}

?>