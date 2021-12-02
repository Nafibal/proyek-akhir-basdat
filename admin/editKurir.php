<?php
    require '../functions/functions.php';

  $id = $_GET["id"];
  $kurir = query("SELECT * FROM kurir WHERE id_kurir = $id")[0];
  var_dump($kurir);
  if (isset($_POST['submit'])) {
    echo "test";
    if (editKurir($_POST) > 0) {
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
  <h1>Edit Kurir</h1>

  <form action="" method="post">
    <input type="hidden" name="id" value=<?= $kurir["id_kurir"] ?>>
    <ul>
      <li>
        <label for="nama"> Nama</label>
        <input type="text" name="nama" id="nama" value=<?= $kurir["nama"] ?>>
      </li>
      <li>
        <label for="harga">No. Telepon</label>
        <input type="number" name="notelepon" id="notelepon" value=<?= $kurir["notelepon"] ?>>
      </li>
      <li>
        <label for="stok">Alamat</label>
        <input type="text" name="alamat" id="alamat" step="1" value=<?= $kurir["alamat"] ?>>
      </li>
      <li>
        <label for="stok">Kecamatan</label>
        <input type="text" name="kecamatan" id="kecamatan" step="1" value=<?= $kurir["kecamatan"] ?>>
      </li>
      <li>
        <label for="stok">Kota</label>
        <input type="text" name="kota" id="kota" step="1" value=<?= $kurir["kota"] ?>>
      </li>
      <li>
        <label for="stok">Provinsi</label>
        <input type="text" name="provinsi" id="provinsi" step="1" value=<?= $kurir["provinsi"] ?>>
      </li>
      <li>
        <button type="submit" name="submit">Simpan</button>
      </li>
    </ul>
  </form>
</body>
</html>