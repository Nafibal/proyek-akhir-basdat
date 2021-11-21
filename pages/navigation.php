<nav class="alternate">
      <div class="container">
        <img src="../assets/img/logo-alt.png" alt="log0" />
        <div class="btn-container">
          <button class="btn btn-cart">
            <a href=""><i class="fas fa-shopping-cart"></i>
                <?php
                    if (isset($_SESSION['cart'])) {
                        $count = count($_SESSION["cart"]);
                        echo "<span id=\"cart_count\">$count</span>";
                    } else {
                        echo "<span id=\"cart_count\">0</span>";
                    }
                ?>
            </a>
          </button>
          <button class="btn btn-alt-2">
            <a href="../logout.php">logout</a>
          </button>
        </div>
      </div>
    </nav>

