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
$x = 25;
$rh = 6;
$pdf -> SetMargins(25,25);
//    Image(Resource id #19, =null, =null, =0, =0, varchar(45)='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$pdf->cell(30,$rh,'Daftar prospek',0,0,'C',0);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idprospek,1,0,'C',0); 
$pdf->cell(30,$rh,prospek,1,0,'C',0); 
$pdf->cell(30,$rh,phone,1,0,'C',0); 
$pdf->cell(30,$rh,alamat,1,0,'C',0); 
$pdf->cell(30,$rh,catatan,1,0,'C',0); 
$pdf->cell(30,$rh,marketing_idmarketing,1,0,'C',0); 
$pdf->cell(30,$rh,sektor_idsektor,1,0,'C',0); 
$pdf->cell(30,$rh,kavling,1,0,'C',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$sql = " select * from prospek"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idprospek'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['prospek'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['phone'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['alamat'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['catatan'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['marketing_idmarketing'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['sektor_idsektor'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['kavling'],1,0,'L',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
