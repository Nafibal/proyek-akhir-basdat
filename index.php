<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: browse.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="daftar.php">daftar</a>
    <a href="masuk.php">masuk</a>
</body>
</html>