<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/browse.css">
    <title>Document</title>
</head>
<body>
    <h1>browse</h1>
    <a href="../logout.php">logout</a>

    <div class="product-card">
        <img src="../assets/img/croissant.jpeg" alt="" class="product-image">
        <div class="product-info">
            <p class="product-name">Croissant</p>
            <p class="product-price">Rp.10000</p>
            <!-- <p class="product-stock">10</p> -->
            <button>Add to Cart</button>
        </div>
    </div>


</body>
</html>

