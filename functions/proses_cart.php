<?php
  session_start();
  require '../assets/functions.php';

  $id = $_POST["id"];

  if (isset($_POST['remove'])) {
    unset($_SESSION['cart'][$id]);
  }

  if (isset($_POST['cart-min'])) {
    if ($_SESSION['cart'][$id]['jumlah'] > 1){
      $_SESSION['cart'][$id]['jumlah']--;
    } else {
      unset($_SESSION['cart'][$id]);
    }
  }

  if (isset($_POST['cart-plus'])) {
    $_SESSION['cart'][$id]['jumlah']++;
  }
  


  header('location:cart.php');

?>