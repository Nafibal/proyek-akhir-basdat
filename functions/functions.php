<?php
// Database Connection
try {  
   $conn = new PDO( "sqlsrv:Server=LAPTOP-90KSPNRU;Database=SweetForYou", NULL, NULL);   
   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch( PDOException $e ) {  
   die( "Error connecting to SQL Server" );   
}

// Queri
function query($query) { 
   global $conn;
   $result = $conn->query($query);
   $rows = [];
   while ( $row = $result->fetch( PDO::FETCH_ASSOC )) {
      $rows[] = $row;
   }
   return $rows;
}

// login
function login($id) {
   global $conn;
   
   date_default_timezone_set('Asia/Jakarta');
   $date = date("Y-m-d H:i:s");

   $sql = "INSERT INTO log_activity VALUES (?,?)";
   $stmt= $conn->prepare($sql);
   $stmt->execute([$id, $date]);
}

// Update data akun
function updateAkun($data, $email) {
   global $conn;

   $nama=$data['nama'];
   $notelepon=$data['notelepon'];
   $alamat=$data['alamat'];
   $kecamatan = $data['kecamatan'];
   $kota = $data['kota'];
   $provinsi = $data['provinsi'];

   $sql = "UPDATE pembeli SET nama=?, notelepon=?, alamat=?, kecamatan=?, kota=?, provinsi=? WHERE email=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$nama, $notelepon, $alamat, $kecamatan, $kota, $provinsi, $email]);

   // LOGIN
   $stmt2 = $conn->prepare("SELECT * FROM pembeli WHERE email=?");
   $stmt2->execute([$email]); 
   $row = $stmt2->fetch(PDO::FETCH_ASSOC);
   login($row['id_pembeli']);

   return $stmt->rowCount();
}
// Edit data produk
function editProduk($data) {
   global $conn;

   $id=$data['id'];
   $nama=$data['nama'];
   $stok=$data['stok'];
   $harga=$data['harga'];

   $sql = "UPDATE produk SET nama_produk=?, stok=?, harga=? WHERE id_produk=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$nama, $stok, $harga, $id]);

   return $stmt->rowCount();
}
// edit data kurir
function editKurir($data) {
   global $conn;

   $id=$data['id'];
   $nama=$data['nama'];
   $notelepon=$data['notelepon'];
   $alamat=$data['alamat'];
   $kecamatan=$data['kecamatan'];
   $kota=$data['kota'];
   $provinsi=$data['provinsi'];

   $sql = "UPDATE kurir SET nama=?, alamat=?, kecamatan=?, kota=?, provinsi=?, notelepon=? WHERE id_kurir=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$nama, $alamat, $kecamatan, $kota, $provinsi, $notelepon, $id]);

   return $stmt->rowCount();
}
   
// Cari produk
function cari($keyword) {
   global $conn;

   $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'";

   return query($query);
}

// registrasi
function daftar($data) {
   global $conn;

   $id = uniqid("P.", false);
   $email = $data['email'];
   $password = $data['password'];
   $password2 = $data['password2'];
   
   // cek apakah email sudah terdaftar
   $stmt = $conn->prepare("SELECT * FROM pembeli WHERE email=?");
   $stmt->execute([$email]); 
   $user = $stmt->fetch();
   if ($user) {
      echo "<script>
            alert('Email sudah terdaftar!');
         </script>";
      return false;
   }

   // cek konfirmasi password
   if( $password !== $password2 ) {
      echo "<script>
            alert('konfirmasi password tidak sesuai!');
         </script>";
      return false;
   }

   // enkripsi password
   $password = password_hash($password, PASSWORD_DEFAULT);

   // Tambahkan akun ke database
   $stmt = $conn->prepare("INSERT INTO pembeli (id_pembeli, email, password) VALUES (?, ?, ?)");
   $stmt->execute([$id, $email, $password]);
   return 1;
}

// Ambil Id Pembeli
   function getId($email){
      global $conn;

      $stmt = $conn->prepare("SELECT * FROM pembeli WHERE email=?");
      $stmt->execute([$email]); 
      $result = $stmt->fetch();

      return $result['id_pembeli'];
   }
?>  