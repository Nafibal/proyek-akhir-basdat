<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: ./pages/browse.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet For You</title>

    <link rel="stylesheet" href="./assets/css/navigation.css" />
    <link rel="stylesheet" href="./assets/css/index.css" />
</head>
<body>
    <nav>
      <div class="container">
        <img src="./assets/img/logo.png" alt="log0" />
        <div class="btn-container">
          <button class="btn btn-alt">
            <a href="./pages/masuk.php">Masuk</a>
          </button>
          <button class="btn">
            <a href="./pages/daftar.php">Daftar</a>
          </button>
        </div>
      </div>
    </nav>
    <section class="hero">
      <div class="container">
        <div class="hero-info">
          <h1 class="hero-title">Welcome my Sweetie!</h1>
          <p class="hero-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam,
            purus sit amet luctus venenatis, lectus
          </p>
          <div class="btn-container">
            <button class="btn btn-alt big">
              <a href="./pages/masuk.php">Masuk</a>
            </button>
            <button class="btn big">
              <a href="./pages/daftar.php">Daftar</a>
            </button>
          </div>
        </div>
        <img src="./assets/img/hero-img.png" alt="" class="hero-img" />
      </div>
    </section>
  </body>
</html>