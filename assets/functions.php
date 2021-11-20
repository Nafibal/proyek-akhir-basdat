<?php
// Database Connection
try {  
   $conn = new PDO( "sqlsrv:Server=LAPTOP-90KSPNRU;Database=SweetForYou", NULL, NULL);   
   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch( PDOException $e ) {  
   die( "Error connecting to SQL Server" );   
}

// QUERY
function query($query) { 
   global $conn;
   $result = $conn->query($query);
   $rows = [];
   while ( $row = $result->fetch( PDO::FETCH_ASSOC )) {
      $rows[] = $row;
   }
   return $rows;
}

// INSERT
function tambah($data) {
   global $conn;
   //contoh
   // $id_admin = $data['id_admin'];
   // $pass_admin = $data['pass_admin'];
   // upload gambar
   $gambar = upload ();
   if( !$gambar ) {
   return false;
   }

   $query = "INSERT INTO admin VALUES (:id_admin, :pass_admin)";
   $stmt = $conn->prepare($query);
   $stmt->execute($data);
   
}

// DELETE
function hapus($data) {
   global $conn;

   $query = "DELETE FROM admin WHERE id_admin = :id_admin";
   $stmt = $conn->prepare($query);
   $stmt->execute($data);
}

// UPDATE
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

   return $stmt->rowCount();
}

// SEARCH
function cari($keyword) {
   global $conn;

   $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'";

   return query($query);
}

// UPLOAD
function upload() {

   $namaFile = $_FILES['gambar']['name'];
   $ukuranFile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpName = $_FILES['gambar']['temp_name'];

   // Cek apakah tidak ada gambar yang diupload
   if ($error === 4) {
      echo "<script>
               Alert('pilih gambar terlebih dahulu');
            </script>";
      return false;
   }

   // cek apakah yang diupload adalah gambar
   $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
   $ekstensiGambar = explode ('.', $namaFile);
   $ekstensiGambar =  strtolower(end($ekstensiGambar));
   if( !in_array ($ekstensiGambar, $ekstensiGambarValid)) {
      echo "<script>
                alert('yang anda upload bukan gambar!');
             </script>";
      return false;
   }
   // cek jika ukurannya terlalu besar
   if( $ukuranFile > 1000000) {
      echo "<script>
         alert('ukuran gambar terlalu besar!');
         </script>";
      return false;
   }
   // lolos pengecekan, gambar siap diupload
   // generate nama gambar baru
   $namaFileBaru = uniqid();
   $namaFileBaru .= '.';
   $namaFileBaru .= $ekstensiGambar;
   move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
   return $namaFileBaru;
}

// REGISTRASI
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

// LOGIN


?>  