<?php 
require('../fpdfReportes/fpdf.php');

class PDF extends FPDF
{
// Cabecera de p�gina
function Header()
{
	// Arial bold 15
	$this->SetFont('Arial','B',8);
	// Movernos a la derecha
	$this->Cell(80);
	// T�tulo
	$this->Cell(40,10,utf8_decode('Medicamentos Más Usados'),1,0,'C');
	// Salto de l�nea
	$this->Ln(20);
	// Color del texto
	$this->SetTextColor(220,50,50);

	$this->Cell(15,10,'ID', 1, 0,'C', 0);
	$this->Cell(30,10, 'Medicamento', 1, 0,'C', 0);
	$this->Cell(30,10, 'Descripcion', 1, 0,'C', 0);
	$this->Cell(30,10, 'fFabricacion', 1, 0,'C', 0);
	$this->Cell(30,10, 'fVencimiento', 1, 0,'C', 0);
	$this->Cell(20,10, 'cantidadCajas', 1, 0, 	'C', 0);
	$this->Cell(20,10, 'valorUnit', 1, 0,'C', 0);
	$this->Cell(20,10, 'NoLote', 1, 1,'C', 0);
}

// Pie de p�gina
function Footer()
{
	// Posici�n: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// N�mero de p�gina
	$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
require 'bd.php';
$consulta= "SELECT * FROM medicamento JOIN pedido ON MEDICAMENTO_idMEDICAMENTO GROUP BY MEDICAMENTO_idMEDICAMENTO ORDER BY cantidadP DESC;";
$resultado= $mysqli->query($consulta);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);

	
while($row= $resultado->fetch_assoc()){
	$pdf->Cell(15,10, $row['idMEDICAMENTO'], 1, 0, 	'C', 0);
	$pdf->Cell(30,10, $row['nombreMedica'], 1, 0,'C', 0);
	$pdf->Cell(30,10, $row['descripcionMedica'], 1, 0,'C', 0);
	$pdf->Cell(30,10,$row['fechaFabricacionMedica'], 1, 0,'C', 0);
	$pdf->Cell(30,10, $row['fechaVencimientoMedica'], 1, 0,'C', 0);
	$pdf->Cell(20,10, $row['cantidadCajas'], 1, 0, 	'C', 0);
	$pdf->Cell(20,10, $row['valorUnitMedica'], 1, 0,'C', 0);
	$pdf->Cell(20,10, $row['noLoteMedica'], 1, 1,'C', 0);
}


$pdf->Output();
?>