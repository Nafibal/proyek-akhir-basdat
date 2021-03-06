<?php
  session_start();
  require '../functions/functions.php';

  // Cek Login
  if (!isset($_SESSION['login'])) {
      header('Location: ../index.php');
      exit;
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
    <link rel="stylesheet" href="../assets/css/cartv2.css" />
  </head>
  <body>
    <?php require_once('./navigation.php') ?>
    <section class="section-cart">
      <div class="container">
        <div class="cart-container">
          <?php $hargaTotal=0 ?>
          <!-- SINGLE ITEM -->
          <?php if(!empty($_SESSION['cart'])) { ?>
          <?php  foreach ($_SESSION['cart'] as $cart => $val) : ?>
            <?php $subtotal = $val["harga"] * $val['jumlah']; ?>
            <form action="../functions/proses_cart.php" method="post">
              <input type="hidden" name="id" value=<?= $val['id'] ?>>
              <div class="cart-item">
                <img src="../assets/img/foto-produk/<?= $val['gambar'] ?>" alt="" />
                <div class="cart-info">
                  <p class="product-name"><?= $val["nama"]; ?></p>
                  <p class="product-stock">Stock : <?= $val["stok"]; ?></p>
                  <p class="product-price">Rp. <?= $val["harga"]; ?></p>
                  <button class="btn" type="submit" name="remove">Remove</button>
                </div>
                <div>
                  <p class="subtotal">Rp. <?= $subtotal ?></p>
                  <div class="cart-count">
                    <button type="submit" name="cart-min" class="cart-min">
                      <i class="fas fa-minus-circle"></i>
                    </button>
                    <input type="text" value=<?= $val['jumlah']; ?> />
                    <button type="submit" name="cart-plus" class="cart-plus">
                      <i class="fas fa-plus-circle"></i>
                    </button>
                  </div>
                </div>
              </div>
            </form>
            <?php $hargaTotal += $subtotal; ?>
          <?php endforeach; ?>   
          <!-- END OF SINGLE ITEM -->
          <?php } else {
            echo "Belum ada produk ditambahkan";
          }
          ?>
        </div>

        <div class="cart-checkout">
          <h4>PRICE DETAIL</h4>
          <span class="line"></span>
          <div class="flex">
            <?php
              if (isset($_SESSION['cart'])) {
                $count = 0;
                foreach ($_SESSION['cart'] as $item) {
                  $count += $item['jumlah'];
                }
                echo "<p class='product-total'>Price($count items)</p>";
              } else {
                echo "<p class='product-total'Price(0)</p>";
              }
            ?>
            <p>Rp. <?= $hargaTotal ?></p>
          </div>
          <div class="flex">
            <p class="delivery-payment">Delivery Charges</p>
            <p>FREE</p>
          </div>
          <span class="line"></span>
          <div class="flex">
            <p class="total-payment">Amount payable</p>
            <p>Rp. <?= $hargaTotal ?></p>
          </div>
          <span class="line"></span>
          <h4>METODE BAYAR</h4>
          <form action="../functions/checkout.php" method="post">
            <div class="radio-container">
              <input type="radio" id="cod" name="metode_bayar" value="COD">
              <label for="html">COD</label><br>
              <input type="radio" id="ewallet" name="metode_bayar" value="E-wallet">
              <label for="css">E-wallet</label><br>
              <input type="radio" id="tfbank" name="metode_bayar" value="Transfer Bank">
              <label for="javascript">Transfer Bank</label>
            </div>
            <button type="submit" class="btn">CHECKOUT</button>
            <input type="hidden" name="total_bayar" value=<?= $hargaTotal ?>>
          </form>
        </div>
      </div>
    </section>
  </body>
</html>
