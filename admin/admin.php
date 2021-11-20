<?php
    session_start();
    require '../assets/functions.php';
    var_dump($_SESSION);

    if (!isset($_SESSION['admin'])) {
        header('Location: index.php');
        exit;
    }

    $produk = query("SELECT * FROM produk");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ADMIN</h1>
    <a href="../logout.php">logout</a>

    <h3>Produk</h3>
    <table border="1" cellspacing="0" cellpadding="10">
        
        <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php  foreach ($produk as $p) : ?>
        <tr>
            <td><?= $p['id_produk'] ?></td>
            <td><?= $p['nama_produk'] ?></td>
            <td><?= $p['harga'] ?></td>
            <td><?= $p['stok'] ?></td>
            <td>
                
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>