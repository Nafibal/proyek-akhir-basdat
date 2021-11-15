<?php
session_start();
require '../assets/functions.php';

if (isset($_SESSION['login'])) {
    header('Location: ../browse.php');
    exit;
}

if( isset($_POST["daftar"]) ) {
    if( daftar($_POST) > 0 ) {
        $_SESSION["login"] = true;
        $_SESSION["admin"] = false;
        $_SESSION["email"] = $_POST["email"];
        header("Location: editAkun.php");
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
        <link rel="stylesheet" href="../assets/css/form.css">
        <title>Welcome Page</title>
    </head>
    <body>

        
        <form action="" method="post" class="box">
            <h1>Daftar</h1>
                <input type="email" name="email" id="email" placeholder="E-mail" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="password" name="password2" id="password2" placeholder="Konfirmasi Password" required>
                <button type="submit" name="daftar" class="submit-btn">Daftar</button>
            </form>
            
            <a href="masuk.php" class="switch-form-btn">Masuk</a>
        
        
        <script src="./assets/app.js"></script>
    </body>
</html>