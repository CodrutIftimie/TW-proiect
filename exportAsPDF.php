<?php 
@session_start();
require("fpdf.php");
include "database.php";

$sql = "SELECT name_product, price, in_stock FROM products WHERE pending=0 ORDER BY created_t DESC";

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',18);
$pdf->Cell(190,20,'CanF - Stock report',0,1,'C');
$pdf->SetFont('Arial','',16);
$pdf->Cell(190,14,'Top newest 10',0,1,'L');
$pdf->SetFont('Arial','',12);

$products = 0;

$result = mysqli_query($connection, $sql);
while($row = mysqli_fetch_row($result)) {
    if($products < 10)
        $pdf->Cell(190,14,"[".($products+1)."] Product: ".$row[0]. " | Price: $".$row[1]." | In Stock: ". $row[2],1,1,'L');
    else $pdf->Cell(190,14,"[".($products+1)."] Product: ".$row[0]. " | Price: $".$row[1]." | In Stock: ". $row[2],0,1,'L');
    $products++;
}
$pdf->Output();

?>