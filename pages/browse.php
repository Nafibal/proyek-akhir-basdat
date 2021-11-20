<?php
session_start();
require '../assets/functions.php';

// Cek Login
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit;
}

// Tambah Produk ke keranjang
if(isset($_POST['product_add'])) {
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], 'product_id');

        if (in_array($_POST['product_id'], $item_array_id)) {
            echo '<script>alert("Produk sudah ditambahkan")</script>';
            echo '<script>window.location="browse.php"</script>';
        } else {
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION["cart"][$count] = $item_array;
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['product_id']
        );

        // Buat variabel session baru
        $_SESSION['cart'][0] = $item_array;
    }
}

// Ambil Produk
$produk = query("SELECT * FROM produk");

// Cari Produk
if (isset($_POST['cari'])) {
    $produk = cari($_POST['keyword']);
}

// COUNT PADA CART
// if (isset($_SESSION['cart'])) {
//     $count = count($_SESSION["cart"]);
//     echo "<span id=\"cart_count\">$count</span>";
// } else {
//     echo "<span id=\"cart_count\">0</span>";
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse</title>

    <link rel="stylesheet" href="../assets/css/navigation.css">
    <link rel="stylesheet" href="../assets/css/browse.css">
</head>
<body>
    <?php require_once('./navigation.php') ?>
    
    <section>
        <div class="container">

            <h1>browse</h1>
            <form action="" method="post">
                <input type="text" name="keyword" autocomplete="off">
                <button type="submit" name="cari">Cari!</button>
            </form>
            <div class="product-container"> 
                <?php  foreach ($produk as $p) : ?>
                    <div class="product-card">
                        <img src="../assets/img/croissant.jpeg" alt="" class="product-image">
                        <div class="product-info">
                            <p class="product-name"><?= $p["nama_produk"]; ?></p>
                            <p class="product-price"><?= $p["harga"]; ?></p>
                            <p class="product-stock"><?= $p["stok"]; ?></p>
                            <button>Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>        
            </div>   
        </div>
    </section>
</body>
</html>

