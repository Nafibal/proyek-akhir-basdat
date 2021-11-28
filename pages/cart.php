<?php
  session_start();
  require '../assets/functions.php';

  // Cek Login
  if (!isset($_SESSION['login'])) {
      header('Location: ../index.php');
      exit;
  }

  // Ambil Produk dari database dan hitung total harga
  $total = 0;
  if (isset($_SESSION['cart'])) {
    $cart_item = array();
    foreach ($_SESSION['cart'] as $item) {
      // Ambil produk dengan ID yg sama pada session cart
      $stmt = $conn->prepare("SELECT * FROM produk WHERE id_produk=?");
      $stmt->execute([$item['product_id']]); 
      $produk = $stmt->fetch(PDO::FETCH_ASSOC);
  
      array_push($cart_item, $produk);
      // Hitung Total Harga
      $total = $total + (int)$produk['harga'];
    }
  }

  // Hapus Produk
  if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
      foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] == $_GET['id']) {
          unset($_SESSION['cart'][$key]);
          echo '<script>alert("Produk berhasil dihapus")</script>';
          echo '<script>window.location="cart.php"</script>';
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
      integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
      integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../assets/css/navigation.css" />
    <link rel="stylesheet" href="../assets/css/cartv1.css" />
  </head>
  <body>
    <?php require_once('./navigation.php') ?>
    <section class="section-cart">
      <div class="container">
        <div class="cart-container">
          <!-- SINGLE ITEM -->
          <?php  foreach ($cart_item as $item) : ?>
          <form action="cart.php?action=remove&id=<?= $item["id_produk"] ?>" method="post">
            <div class="cart-item">
              <img src="../assets/img/foto-produk/<?= $item['gambar'] ?>" alt="" />
              <div class="cart-info">
                <p class="product-name"><?= $item["nama_produk"]; ?></p>
                <p class="product-stock">Stock : <?= $item["stok"]; ?></p>
                <p class="product-price">Rp. <?= $item["harga"]; ?></p>
                <button class="btn" type="submit" name="remove">Remove</button>
              </div>
              <div class="cart-count">
                <button class="cart-min">
                  <i class="fas fa-minus-circle"></i>
                </button>
                <input type="text" value="1" />
                <button class="cart-plus">
                  <i class="fas fa-plus-circle"></i>
                </button>
              </div>
            </div>
          </form>
          <?php endforeach; ?>   
          <!-- END OF SINGLE ITEM -->
        </div>

        <div class="cart-checkout">
          <h4>PRICE DETAIL</h4>
          <span class="line"></span>
          <div class="flex">
            <?php
              if (isset($_SESSION['cart'])) {
                $count = count($_SESSION['cart']);
                echo "<p class='product-total'>Price($count items)</p>";
              } else {
                echo "<p class='product-total'Price(0)</p>";
              }
            ?>
            <p>Rp. <?= $total ?></p>
          </div>
          <div class="flex">
            <p class="delivery-payment">Delivery Charges</p>
            <p>FREE</p>
          </div>
          <span class="line"></span>
          <div class="flex">
            <p class="total-payment">Amount payable</p>
            <p>Rp. <?= $total ?></p>
          </div>
          <button class="btn">CHECKOUT</button>
        </div>
      </div>
    </section>
  </body>
</html>
