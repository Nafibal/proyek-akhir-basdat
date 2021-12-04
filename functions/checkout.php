<?php 
  session_start();
  require './functions.php';
  
  try {
    $conn->beginTransaction();
    // PESANAN
    // Buat ID Pesanan
    $id_pesanan = uniqid("Ps.", false);
    
    // Fetch ID Pembeli
    $stmtPembeli = $conn->prepare("SELECT * FROM pembeli WHERE email=?");
    $stmtPembeli->execute([$_SESSION['email']]); 
    $pembeli = $stmtPembeli->fetch();
    $id_pembeli = $pembeli['id_pembeli'];

    // Fetch ID kurir
    $kurir = query("SELECT * FROM kurir");
    $id_kurir = $kurir[rand(0,count($kurir)-1)]['id_kurir'];

    // Buat variable tanggal pesanan
    date_default_timezone_set('Asia/Jakarta');
    $tanggal_pesanan = date("Y-m-d H:i:s");

    // Buat variable total_bayar
    $total_bayar = $_POST['total_bayar'];

    // Buat Variable metode bayar
    $metode_bayar = $_POST['metode_bayar'];

    // Buat Variable status pesanan
    $status_pesanan = "dikirim";

    // Tambahkan Data ke tabel pesanan
    $pesanan = "INSERT INTO pesanan (id_pesanan, id_pembeli, id_kurir, tanggal_pesanan, total_bayar, metode_bayar, status_pesanan) VALUES (?,?,?,?,?,?,?)";
    $conn->prepare($pesanan)->execute([$id_pesanan, $id_pembeli, $id_kurir, $tanggal_pesanan, $total_bayar, $metode_bayar, $status_pesanan]);


    // INVOICE_DETAIL
    foreach ($_SESSION['cart'] as $cart => $item) {
      // Ambil Variable
      $id_produk = $item['id'];
      $nama = $item['nama'];
      $harga = $item['harga'];
      $jumlah = $item['jumlah'];
      
      // Hitung jumlah stok baru
      $stok = $item['stok'] - $jumlah;

      // Hitung Subtotal
      $subtotal = $harga * $jumlah;
      
      // Buat ID Invoice
      $id_invoice = uniqid("I.", false);

      // Tambahkan data ke tabel invoice_detail
      $sql = "INSERT INTO invoice_detail VALUES (?,?,?,?,?,?)";
      $conn->prepare($sql)->execute([$id_invoice, $id_pesanan, $id_produk, $harga, $jumlah, $subtotal]);
      
      // kurangi stok dengan jumlah pada tabel produk
      $sql = "UPDATE produk SET stok=? WHERE id_produk=?";
      $conn->prepare($sql)->execute([$stok, $id_produk]);
    }


    // commit the transaction
    $conn->commit();

    echo "sukses";

  } catch (\PDOException $e) {
    // Rollback the transaction
    $conn->rollback();

    // show the error message
	  die($e->getMessage());
  }

?>