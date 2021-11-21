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
                        <img src="../assets/img/croissant.jpeg" alt="" class="product-image">
                        <div class="product-info">
                            <p class="product-name"><?= $p["nama_produk"]; ?></p>
                            <p class="product-price">Rp. <?= $p["harga"]; ?></p>
                            <p class="product-stock">Stock : <?= $p["stok"]; ?></p>
                            <button type="submit" name="product_add">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                            <input type="hidden" name="product_id" value=<?= $p["id_produk"]; ?>>
                        </div>
                    </div>
                <?php endforeach; ?>        
            </div>   
        </div>
    </section>
</body>
</html>

