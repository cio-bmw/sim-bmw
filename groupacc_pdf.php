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
//    Image(Resource id #19, =null, =null, =0, =0, varchar(45)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$pdf->cell(30,$rh,'Daftar groupacc',0,0,'C',0);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idgroupacc,1,0,'C',0); 
$pdf->cell(30,$rh,groupname,1,0,'C',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$sql = " select * from groupacc"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idgroupacc'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['groupname'],1,0,'L',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
