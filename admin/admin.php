<?php
    session_start();

    if (!isset($_SESSION['admin'])) {
        header('Location: index.php');
        exit;
    }

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
        <button type="submit" name="pdf">Download PDF</button>

    </form>

    <?php 
        if (isset($_POST['tampil-produk'])) {
            $_SESSION['choice'] = "produk";
            include("tProduk.php");
        }
        if (isset($_POST['tampil-kurir'])) {
            $_SESSION['choice'] = "kurir";
            include("tKurir.php");
        }
        if (isset($_POST['tampil-pesanan'])) {
            $_SESSION['choice'] = 'pesanan';
            include('tPesanan.php');
        }
        if (isset($_POST['pdf'])) {
            if ($_SESSION['choice'] == "produk") {
                downloadPDF("Produk", "tProduk");
            } else if ($_SESSION['choice'] == "kurir") {
                downloadPDF("Kurir", "tKurir");
            } else if ($_SESSION['choice'] == "pesanan") {
                downloadPDF("Pesanan", "tPesanan");
            } else {
                // echo "pilihan ". $choice;
                echo "Pilih Data!!";
            }
            unset($_SESSION['choice']);
        }

          function downloadPDF($name, $data) {
            require_once('../assets/tcpdf/tcpdf.php');
        
            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Sweet For You');
            $pdf->SetTitle('Data ' . $name);
            $pdf->SetSubject($name);
            $pdf->SetKeywords($name . ', Data Produk');
            
            // $pdf->SetFont('dejavusans', '', 14, '', true);

            $pdf->setPrintHeader(false);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetFont('times', '', 14, '', true);
            
            $pdf->AddPage();
            
            $html = file_get_contents("http://localhost/SweetForYou/admin/".$data.".php");
            
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    
            ob_end_clean();

            $pdf->Output('Data '.$name.'.pdf', 'I');
          }
    ?>
    
</body>
</html>