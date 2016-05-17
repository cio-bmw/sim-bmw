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
$y = 20;
$x = 25;
$rh = 6;
$pdf -> SetMargins(25,25);
//    Image(Resource id #19, =null, =null, =0, =0, varchar(5)='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,10);
$pdf->SetFont('helvetica','B',14);
$yr= $pdf->getY()+$rh+20; $pdf->setY($yr);$pdf->SetX($x); 
$pdf->cell(60,$rh,'Daftar Kas Keluar',0,0,'L',0);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
$yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('Arial','',10);
$pdf->SetY($yx);
//buat header tabel//
$pdf->cell(20,$rh,'No Dok',1,0,'C',0); 
$pdf->cell(30,$rh,'Sektor',1,0,'C',0); 
$pdf->cell(30,$rh,Tanggal,1,0,'C',0); 
$pdf->cell(50,$rh,Keterangan,1,0,'C',0); 
$pdf->cell(20,$rh,Jumlah,1,0,'C',0); 
 
$yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$sql = " select * from whcashout"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
$pdf->cell(20,$rh,$row['idcashout'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['sektor_idsektor'],1,0,'L',0); 
$pdf->cell(30,$rh,gettanggal($row['txndate']),1,0,'L',0); 
$pdf->cell(50,$rh,$row['txndesc'],1,0,'L',0); 
$pdf->cell(20,$rh,$row['txnvalue'],1,0,'L',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
