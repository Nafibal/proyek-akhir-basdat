<?php
  require '../functions/functions.php';
  
  // Ambil Pesanan

  $pesanan = query("SELECT * FROM pesanan");
?>


<!-- STYLE -->
<link rel="stylesheet" href="../assets/css/tablev2.css">

<h1>Pesanan</h1>
<table border="1">
      <thead>
        <tr>
          <th>id_pesanan</th>
          <th>id_pembeli</th>
          <th>id_kurir</th>
          <th>tanggal_pesanan</th>
          <th>total_bayar</th>
          <th>metode bayar</th>
          <th>status pesanan</th>
          <th>tanggal selesai</th>
          <th>aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php  foreach ($pesanan as $p) : ?>
          <tr>
          <td><?= $p['id_pesanan'] ?></td>
          <td><?= $p['id_pembeli'] ?></td>
          <td><?= $p['id_kurir'] ?></td>
          <td><?= $p['tanggal_pesanan'] ?></td>
          <td><?= $p['total_bayar'] ?></td>
          <td><?= $p['metode_bayar'] ?></td>
          <td><?= $p['status_pesanan'] ?></td>
          <td><?= $p['tanggal_selesai'] ?></td>
          <td><a href="">Nota</a>
          </tr>
        <?php endforeach; ?>   
      </tbody>
    </table>