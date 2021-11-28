<?php
  // Ambil Produk
  $produk = query("SELECT * FROM produk");
?>


<!-- STYLE -->
<link rel="stylesheet" href="../assets/css/tablev1.css">

<h1>Peoduk</h1>
<table border="1">
      <thead>
        <tr>
          <th style="width: 20%">id</th>
          <th style="width: 40%">nama</th>
          <th style="width: 10%">stok</th>
          <th style="width: 20%">harga</th>
          <th style="width: 10%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php  foreach ($produk as $p) : ?>
          <tr>
          <td style="width: 15%"><?= $p['id_produk'] ?></td>
          <td style="width: 40%"><?= $p['nama_produk'] ?></td>
          <td style="width: 10%"><?= $p['stok'] ?></td>
          <td style="width: 20%"><?= $p['harga'] ?></td>
          <td style="width: 15%"><a href="">edit</a> | <a href="">hapus</a></td>
          </tr>
        <?php endforeach; ?>   
      </tbody>
    </table>

    <form action="" method="post">
      <button type="submit" name="edit">Download PDF</button>
    </form>