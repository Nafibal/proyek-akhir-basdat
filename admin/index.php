<?php
    session_start();
    require '../assets/functions.php';

    if( isset($_POST["masuk"]) ) {
        $id_admin = $_POST["id_admin"];
        $pass_adm = $_POST["pass_adm"];

        $stmt = $conn->prepare("SELECT * FROM admin WHERE id_admin=?");
        $stmt->execute([$id_admin]);

        // check username
        if($conn->query("SELECT COUNT(*) FROM admin WHERE id_admin='$id_admin'")->fetchColumn() == '1') {
            // Check password
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($pass_adm == $row['pass_adm']) {
                $_SESSION["login"] = true;
                $_SESSION["admin"] = true;
                $_SESSION["email"] = NULL;
                header("Location: admin.php");
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
    <link rel="stylesheet" href="../assets/css/form.css">
    <title>Admin Login</title>
</head>
<body>
    <?php if( isset($error) ) : ?>
    <p>id / password salah</p>
    <?php endif; ?>
    <form action="" method="post" class="box">
        <h1>Login</h1>
        <input type="text" name="id_admin" id="id_admin" placeholder="Admin ID">
        <input type="password" name="pass_adm" id="pass_adm" placeholder="Password">
        <button type="submit" name="masuk">Masuk</button>
    </form>
</body>
</html>