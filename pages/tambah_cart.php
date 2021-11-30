<?php
  session_start();
  require '../assets/functions.php';

  $id = $_POST['product_id'];

  $stmt = $conn->query("SELECT * FROM produk WHERE id_produk=$id");
  $result = $stmt->fetch( PDO::FETCH_ASSOC );

  $_SESSION['cart'][$id] = [
    "id" => $id,
    "nama" => $result["nama_produk"],
    "stok" => $result["stok"],
    "harga" => $result["harga"],
    "gambar" => $result["gambar"],
    "jumlah" => 1
  ];

  header("location:browse.php")

?>