<?php
session_start();
require 'functions.php';

if (isset($_SESSION['login'])) {
    header('Location: browse.php');
    exit;
}

if( isset($_POST["masuk"]) ) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM pembeli WHERE email=?");
    $stmt->execute([$email]);

    // check username
    if($conn->query("SELECT COUNT(*) FROM pembeli WHERE email='$email'")->fetchColumn() == '1'){

        // Check password
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $row['password'])){
            $_SESSION["login"] = true;
            header("Location: browse.php");
            exit;
        }
    }

    $error = true;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Document</title>
</head>
<body>
<?php if( isset($error) ) : ?>
   <p>email / password salah</p>
<?php endif; ?>
    <form action="" method="post" class="form login">
            <h1>Login</h1>
            <div class="input-container">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="input-container">
                <button type="submit" name="masuk" class="submit-btn">Submit</button>
            </div>
            <a href="daftar.php" class="switch-form-btn">signup</a>
        </form>
</body>
</html>