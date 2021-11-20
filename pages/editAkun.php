<?php
session_start();
require '../assets/functions.php';

if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit;
}

// var_dump($_SESSION);

if(isset($_POST['submit'])) {
    if(updateAkun($_POST, $_SESSION['email']) == '1') {
        header('Location: browse.php');
        exit;
    };
    echo "Gagal mengupdate Akun";
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/editAkun.css">
        <title>Document</title>
    </head>
    <body>
        <form action="" method="post" class="box" >
            <h2 class="form-title">
                Lengkapi Informasi Akun
            </h2>
            <div class="input-container">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div class="input-container">
                <label for="notelepon">No. Telepon</label>
                <input type="text" name="notelepon" id="notelepon" required>
            </div>
            <div class="input-container">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" required>
            </div>
            <div class="input-container">
                <label for="kecamatan">Kecamatan</label>
                <input type="text" name="kecamatan" id="kecamatan" required>
            </div>
            <div class="input-container">
                <label for="kota">Kota</label>
                <input type="text" name="kota" id="kota" required>
            </div>
            <div class="input-container">
                <label for="provinsi">Provinsi</label>
                <input type="text" name="provinsi" id="provinsi" required>
            </div>
            <div class="input-container">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </body>
</html>