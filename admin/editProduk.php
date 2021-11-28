<?php
  require '../assets/functions.php';

  $id = $_GET["id"];
  $produk = query("SELECT * FROM produk WHERE id_produk = $id")[0];
  var_dump($produk);
  if (isset($_POST['submit'])) {
    echo "test";
    if (editProduk($_POST) > 0) {
      echo "
        <script>
          alert('data berhasil diubah!');
          document.location.href = 'admin.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('data gagal diubah!');
          document.location.href = 'admin.php';
        </script>
      ";
    }
  }
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
  <h1>Edit Produk</h1>

  <form action="" method="post">
    <input type="hidden" name="id" value=<?= $produk["id_produk"] ?>>
    <ul>
      <li>
        <label for="nama"> Nama</label>
        <input type="text" name="nama" id="nama" value=<?= $produk["nama_produk"] ?>>
      </li>
      <li>
        <label for="stok">Stok</label>
        <input type="number" name="stok" id="stok" step="1" value=<?= $produk["stok"] ?>>
      </li>
      <li>
        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" value=<?= $produk["harga"] ?>>
      </li>
      <li>
        <button type="submit" name="submit">Simpan</button>
      </li>
    </ul>
  </form>
</body>
</html>