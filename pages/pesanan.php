<?php
  session_start();
  require '../functions/functions.php';

  // Mengambil Id Pembeli
  $id_pembeli = getId($_SESSION['email']);

  // Mengambil pesanan yang belum selesai
  $stmt1 = $conn->prepare("SELECT * FROM pesanan where id_pembeli=? AND status_pesanan = 'dikirim'");
  $stmt1->execute([$id_pembeli]); 

  $pesanan_dikirim=[];
  while ($row = $stmt1->fetch()) {
    $pesanan_dikirim[] = $row;
  }

  // Mengambil pesanan yang sudah selesai
  $stmt2 = $conn->prepare("SELECT * FROM pesanan where id_pembeli=? AND status_pesanan = 'selesai'");
  $stmt2->execute([$id_pembeli]); 

  $pesanan_selesai=[];
  while ($row = $stmt2->fetch()) {
    $pesanan_selesai[] = $row;
  }


  // Menyelesaikan Pesanan
  if(isset($_POST['selesai'])) {
    $tanggal_selesai = date("Y-m-d H:i:s");

    $sql = "UPDATE pesanan SET status_pesanan=?, tanggal_selesai=? WHERE id_pesanan=?";
    $conn->prepare($sql)->execute(['selesai', $tanggal_selesai, $_POST['id_pesanan']]);

    header('Location: pesanan.php');
  }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../assets/css/navigation.css" />
    <link rel="stylesheet" href="../assets/css/pesanan.css" />
  </head>
  <body>
  <?php require_once('./navigation.php') ?>
    <section class="pesanan-section">
      <div class="container">
        <h2>Dikirm</h2>
        <div class="card-container">
          <?php if(!empty($pesanan_dikirim)) { ?>
            <?php  foreach ($pesanan_dikirim as $index => $pesanan): ?>
              <div class="card">
                <form action="" method='post'>
                  <div class="card-info-1">
                    <p>id : <?= $pesanan['id_pesanan'] ?></p>
                    <p>Email : <?= $_SESSION['email'] ?></p>
                    <p>Metode Bayar : <?= $pesanan['metode_bayar'] ?></p>
                    <p>Rp. <?= $pesanan['total_bayar'] ?> </p>
                    <button type="submit" name='selesai' class="btn">selesai</button>
                  </div>
                  <div class="card-info-2">
                    <p class="tanggal"><?= $pesanan['tanggal_pesanan'] ?></p>
                    <p class="status">Dikirim</p>
                  </div>
                  <input type="hidden" name="id_pesanan" value=<?= $pesanan['id_pesanan'] ?> >
                </form>
              </div>
            <?php endforeach; ?>  
          <?php } else {
            echo "Pesanan masih kososng";
          }
          ?> 
        </div>
        <h2>Selesai</h2>
        <div class="card-container">
        <?php if(!empty($pesanan_selesai)) { ?>
            <?php  foreach ($pesanan_selesai as $index => $pesanan): ?>
              <div class="card">
                <form action="" method='post'>
                  <div class="card-info-1">
                    <p>id : <?= $pesanan['id_pesanan'] ?></p>
                    <p>Email : <?= $_SESSION['email'] ?></p>
                    <p>Metode Bayar : <?= $pesanan['metode_bayar'] ?></p>
                    <p>Rp. <?= $pesanan['total_bayar'] ?> </p>
                    <button type="submit" name='nota' class="btn">Lihat Nota</button>
                  </div>
                  <div class="card-info-2">
                    <p class="tanggal"><?= $pesanan['tanggal_pesanan'] ?></p>
                    <p class="status">Selesai</p>
                  </div>
                </form>
              </div>
            <?php endforeach; ?>  
          <?php } else {
            echo "Pesanan masih kosong";
          }
          ?> 
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
