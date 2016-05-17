<?php 
require("fpdf.php"); 
require_once "config/config.php"; 
require_once "config/common.php"; 
$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 20;
$x = 30;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #16, =null, =null, =0, =0, varchar(50)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+40;
$pdf->SetY($yx);
$pdf->text($x,$yx,'Daftar product_uom');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,qty_uom,1,'C',0); 
$pdf->cell(30,$rh,harga_uom,1,'C',0); 
$pdf->cell(30,$rh,uom_iduom,1,'C',0); 
$pdf->cell(30,$rh,product_idproduct,1,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select qty_uom,harga_uom,uom_iduom,product_idproduct from product_uom"; 
$result = execsql($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['qty_uom'],1,'L',0); 
$pdf->cell(30,$rh,$row['harga_uom'],1,'L',0); 
$pdf->cell(30,$rh,$row['uom_iduom'],1,'L',0); 
$pdf->cell(30,$rh,$row['product_idproduct'],1,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
