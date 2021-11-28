<?php
    session_start();
    // require '../assets/functions.php';
    // var_dump($_SESSION);

    if (!isset($_SESSION['admin'])) {
        header('Location: index.php');
        exit;
    }

    // $kurir = query("SELECT * FROM kurir");
    // var_dump($produk);

    


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
    <h1>ADMIN</h1>
    <a href="../logout.php">logout</a>

    <form action="" method='post'>
        <button type='submit' name="tampil-produk">PRODUK</button>
        <button type='submit' name="tampil-kurir">KURIR</button>
        <button type='submit' name="tampil-pesanan">RIWAYAT PESANAN</button>
    </form>

    <?php 
        if (isset($_POST['tampil-produk'])) {
            include("tProduk.php");
        }
        if (isset($_POST['tampil-kurir'])) {
            include("tKurir.php");
        }
        if (isset($_POST['pdf-produk'])) {
            // echo"hello";
            // header('location:pdf.php');
        
            require_once('../assets/tcpdf/tcpdf.php');
        
            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Sweet For You');
            $pdf->SetTitle('Data Produk');
            $pdf->SetSubject('Produk');
            $pdf->SetKeywords('Prdouk, Data Produk');
            
            // $pdf->SetFont('dejavusans', '', 14, '', true);

            $pdf->setPrintHeader(false);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetFont('times', '', 14, '', true);
            
            $pdf->AddPage();
            
            $html = file_get_contents("http://localhost/SweetForYou/admin/tProduk.php");
            
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    
            ob_end_clean();

            $pdf->Output('Data Produk.pdf', 'I');
          }
    ?>
    
</body>
</html>