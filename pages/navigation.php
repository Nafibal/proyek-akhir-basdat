<nav class="alternate">
  <div class="container">
  <a href="browse.php"><img src="../assets/img/logo-alt.png" alt="log0" /></a>
    <div class="btn-container">
      <button class="btn btn-cart">
        <a href="pesanan.php"><i class="fas fa-receipt"></i></a>
      </button>
      <button class="btn btn-cart">
        <a href="cart.php"><i class="fas fa-shopping-cart"></i>
          <?php
            if (isset($_SESSION['cart'])) {
              $count = 0;
              foreach ($_SESSION['cart'] as $item) {
                $count += $item['jumlah'];
              }
              echo "<span id=\"cart_count\">$count</span>";
            } else {
              echo "<span id=\"cart_count\">0</span>";
            }
          ?>
        </a>
      </button>
      
      <button class="btn btn-alt-2">
        <a href="../functions/logout.php">logout</a>
      </button>
    </div>
  </div>
</nav>

