<?php
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

$pdf->AddPage();

$html = file_get_contents("http://localhost/SweetForYou/admin/tProduk.php");

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output('Data Produk.pdf', 'I');


?>