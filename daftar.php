<?php
session_start();
require 'functions.php';

if (isset($_SESSION['login'])) {
    header('Location: browse.php');
    exit;
}

if( isset($_POST["daftar"]) ) {
    if( daftar($_POST) > 0 ) {
        $_SESSION["login"] = true;
        header("Location: akun.php");
        exit;
    }
}
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/style.css">
        <title>Welcome Page</title>
    </head>
    <body>

        
        <form action="" method="post" class="form signup">
            <h1>Daftar</h1>
            <div class="input-container">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="input-container">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" name="password2" id="password2">
            </div>
            <div class="input-container">
                <button type="submit" name="daftar" class="submit-btn">Daftar</button>
            </div>
            <a href="masuk.php" class="switch-form-btn">Masuk</a>
        </form>
    
        
        
        <script src="./assets/app.js"></script>
    </body>
</html>