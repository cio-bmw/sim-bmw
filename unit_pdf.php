<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(true,30);
//Add first L landscape P portrait page
$pdf->AddPage('L');
//set initial y axis position per page
$y = 10;
$x = 25;
$rh = 6;
$pdf -> SetMargins(25,25,25,25);
//    Image(Resource id #17, =null, =null, =0, =0, int(11)='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+25;
$pdf->SetY($yx);
$pdf->text($x,$yx,'Daftar unit');
$pdf->SetFont('helvetica','',9);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('Arial','',9);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(10,$rh,'Id Unit',1,0,'C',0); 
 $pdf->cell(15,$rh,Sektor,1,0,'C',0); 
$pdf->cell(15,$rh,Kavling,1,0,'C',0); 
$pdf->cell(50,$rh,Pemilik,1,0,'C',0); 
$pdf->cell(100,$rh,Alamat,1,0,'C',0); 
$pdf->cell(50,$rh,phone,1,0,'C',0); 

 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select * from unit where sektor_idsektor ='$id' order by kavling "; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(10,$rh,$no,1,0,'R',0); 
 $pdf->cell(15,$rh,$row['sektor_idsektor'],1,0,'L',0); 

$pdf->cell(15,$rh,$row['kavling'],1,0,'L',0); 
$pdf->cell(50,$rh,$row['owner'],1,0,'L',0); 
$pdf->cell(100,$rh,$row['address'],1,0,'L',0); 
$pdf->cell(50,$rh,$row['phone'],1,0,'L',0); 

 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
