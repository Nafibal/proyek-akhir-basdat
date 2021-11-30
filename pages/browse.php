<?php
  session_start();
  require '../assets/functions.php';

  // Cek Login
  if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit;
  }

  // Ambil Produk
  $produk = query("SELECT * FROM produk");

  // Cari Produk
  if (isset($_POST['cari'])) {
    $produk = cari($_POST['keyword']);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse</title>

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../assets/css/navigation.css">
    <link rel="stylesheet" href="../assets/css/browsev1.css">
  </head>
  <body>
    <?php require_once('./navigation.php') ?>

    <section class="section-browse">
      <div class="container">
        <div class="search-container">
          <p class="search-text">SEARCH</p>
          <form action="" method="post">
            <input type="text" name="keyword" autocomplete="off" />
            <button type="submit" name="cari">
                <i class="fas fa-search"></i>
            </button>
          </form>
          </div>
        <div class="product-container"> 
          <?php  foreach ($produk as $p) : ?>
            <div class="product-card">
              <img src="../assets/img/foto-produk/<?= $p['gambar'] ?>" alt="" class="product-image">
              <div class="product-info">
                <p class="product-name"><?= $p["nama_produk"]; ?></p>
                <p class="product-price">Rp. <?= $p["harga"]; ?></p>
                <p class="product-stock">Stock : <?= $p["stok"]; ?></p>
                <form action="tambah_cart.php" method='post'>
                  <button type="submit" name="product_add">
                    <i class="fas fa-plus-circle"></i>
                  </button>
                  <input type="hidden" name="product_id" value=<?= $p["id_produk"]; ?>>
                </form>
              </div>
            </div>
          <?php endforeach; ?>        
        </div>   
      </div>
    </section>
  </body>
</html>

