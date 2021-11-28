<?php
  // Ambil Produk
  require '../assets/functions.php';

  $kurir = query("SELECT * FROM kurir");

?>


<!-- STYLE -->
<link rel="stylesheet" href="../assets/css/tablev2.css">

<h1>Kurir</h1>
<table border="1">
      <thead>
        <tr>
          <th style="width: 10%">id</th>
          <th style="width: 30%">nama</th>
          <th style="width: 30%">Alamat</th>
          <th style="width: 15%">no. Telepon</th>
          <th style="width: 15%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php  foreach ($kurir as $k) : ?>
          <tr>
          <td style="width: 10%"><?= $k['id_kurir'] ?></td>
          <td style="width: 30%"><?= $k['nama'] ?></td>
          <td style="width: 30%"><?= $k['alamat'] ?></td>
          <td style="width: 15%"><?= $k['notelepon'] ?></td>
          <td style="width: 15%"><a href="editKurir.php?id=<?= $k['id_kurir'] ?>">edit</a> | <a href="">hapus</a></td>
          </tr>
        <?php endforeach; ?>   
      </tbody>
    </table>