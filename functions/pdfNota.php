<?php
session_start();
require_once('../assets/tcpdf/tcpdf.php');
        
// create new PDF document



$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sweet For You');
$pdf->SetTitle('Nota Pembelian');
$pdf->SetSubject('Nota Pembelian');
$pdf->SetKeywords('Nota Pembelian');


// $pdf->SetFont('dejavusans', '', 14, '', true);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setPrintHeader(false);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->SetFont('times', '', 14, '', true);

$pdf->AddPage();

$html = file_get_contents("http://localhost/SweetForYou/pages/nota.php?id_pesanan=".$_POST['id_pesanan']);

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ob_end_clean();

$pdf->Output('Nota Pembelian.pdf', 'I');
?>