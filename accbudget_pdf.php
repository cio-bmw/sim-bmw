<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 0;
$x = 0;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #19, =null, =null, =0, =0, int(11)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$pdf->cell(30,$rh,'Daftar accbudget',0,0,'C',0);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idaccbudget,1,0,'C',0); 
$pdf->cell(30,$rh,tahun,1,0,'C',0); 
$pdf->cell(30,$rh,bulan,1,0,'C',0); 
$pdf->cell(30,$rh,budget,1,0,'C',0); 
$pdf->cell(30,$rh,acc_idacc,1,0,'C',0); 
$pdf->cell(30,$rh,saldoawal,1,0,'C',0); 
$pdf->cell(30,$rh,saldo,1,0,'C',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$sql = " select * from accbudget"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idaccbudget'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['tahun'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['bulan'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['budget'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['acc_idacc'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['saldoawal'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['saldo'],1,0,'L',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
