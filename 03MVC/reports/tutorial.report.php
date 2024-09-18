<?php
require('../reports/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times','B',17);
$pdf->Image('../public/image/saludo.png', 10, 20, 10);
$pdf->Cell(40,10,'Buenos dias ing. Luis Llerena');
$pdf->Output();
?>