<?php
require('../reports/fpdf.php');
require_once("../models/productos.model.php");

$pdf = new FPDF();
$pdf->AddPage();
$productos = new Productos();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Text(30, 10, 'Reporte total de Productos');
$pdf->SetFont('Arial', '', 12);
$texto = "Check";
//$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', $texto));
$pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $texto), 0, 'J');

//uso de POO para reporte
$listaproductos = $productos->todos();
$x = 10;
$y = 35;

// Encabezados de columnas
$pdf->Cell(10, 10, "#", 1);
$pdf->Cell(30, 10, "Nombre", 1);
$pdf->Cell(50, 10, "Descripcion", 1);
$pdf->Cell(30, 10, "Precio", 1);
$pdf->Cell(20, 10, "Stock", 1);

$pdf->Ln(); // Salto de línea para los datos

$index = 1;
while ($producto = mysqli_fetch_assoc($listaproductos)) {
    //      Ancho   alto de la celda
    $pdf->Cell(10, 10, $index, 1);
    $pdf->Cell(30, 10, $producto["nombre"], 1);
    $pdf->Cell(50, 10, $producto["descripcion"], 1);
    $pdf->Cell(30, 10, number_format($producto["precio"], 2), 1); // Formato de precio con dos decimales
    $pdf->Cell(20, 10, $producto["stock"], 1);
    $pdf->Ln();
    $index++;
}

// Salida del PDF
$pdf->Output();
?>
