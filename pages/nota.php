<?php
  session_start();
  require '../functions/functions.php';
  require_once('../assets/tcpdf/tcpdf.php');

  // Mengambil Data Pesanan
  $stmt = $conn->prepare("SELECT * FROM pesanan where id_pesanan=?");
  $stmt->execute([$_GET['id_pesanan']]);
  $pesanan = $stmt->fetch(PDO::FETCH_ASSOC);

  // Mengambil Data Invoice
  $stmt2 = $conn->prepare("SELECT i.*, p.nama_produk FROM invoice_detail AS i  JOIN produk AS p ON i.id_produk=p.id_produk WHERE i.id_pesanan=?");
  $stmt2->execute([$_GET['id_pesanan']]); 

  $invoice=[];
  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $invoice[] = $row;
  }
        
// ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nota</title>

    <link rel="stylesheet" href="../assets/css/nota.css" />
  </head>
  <body>
    <div class="container">
      <!-- <img class="logo" src="../assets/img/logo-full.png" alt="" /> -->
      <pre>ID Pesanan   : <?= $pesanan['id_pesanan'] ?></pre>
      <pre>Metode Bayar : <?= $pesanan['metode_bayar'] ?></pre>
      <pre>Tanggal      : <?= $pesanan['tanggal_pesanan'] ?></pre>
      <!-- TABLE -->
      <table border="1">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0; foreach ($invoice as $i) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $i['id_produk'] ?></td>
              <td><?= $i['nama_produk'] ?></td>
              <td><?= $i['harga_produk'] ?></td>
              <td><?= $i['quantity'] ?></td>
              <td><?= $i['Subtotal_bayar'] ?></td>
            </tr>
          <?php endforeach; ?>   
          <tr>
            <td colspan="5">Total</td>
            <td><?= $pesanan['total_bayar'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
