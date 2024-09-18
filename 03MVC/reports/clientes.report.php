<?php
require('../reports/fpdf.php');
require_once("../models/clientes.model.php");

$pdf = new FPDF();
$pdf->AddPage();
$clientes = new Clientes();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Text(30, 10, 'Reporte total de Clientes');
$pdf->SetFont('Arial', '', 12);

//$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', $texto));
$pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $texto), 0, 'J');

//uso de POO para reporte
$listaclientes = $clientes->todos();
$x = 10;
$y = 35;

// Encabezados de columnas
$pdf->Cell(10, 10, "#", 1);
$pdf->Cell(30, 10, "Nombre", 1);
$pdf->Cell(30, 10, "Apellido", 1);
$pdf->Cell(50, 10, "Email", 1);
$pdf->Cell(30, 10, "Telefono", 1);

$pdf->Ln(); // Salto de línea para los datos

$index = 1;
while ($cliente = mysqli_fetch_assoc($listaclientes)) {
    //      Ancho   alto de la celda
    $pdf->Cell(10, 10, $index, 1);
    $pdf->Cell(30, 10, $cliente["nombre"], 1);
    $pdf->Cell(30, 10, $cliente["apellido"], 1);
    $pdf->Cell(50, 10, $cliente["email"], 1);
    $pdf->Cell(30, 10, $cliente["telefono"], 1);
    $pdf->Ln();
    $index++;
}

//Salida del pdf
$pdf->Output();
?>
