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
$pdf->cell(30,$rh,'Daftar tasklist',0,0,'C',0);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idtasklist,1,0,'C',0); 
$pdf->cell(30,$rh,project_idproject,1,0,'C',0); 
$pdf->cell(30,$rh,emp_idemp,1,0,'C',0); 
$pdf->cell(30,$rh,taskname,1,0,'C',0); 
$pdf->cell(30,$rh,keterangan,1,0,'C',0); 
$pdf->cell(30,$rh,startdate,1,0,'C',0); 
$pdf->cell(30,$rh,enddate,1,0,'C',0); 
$pdf->cell(30,$rh,finishdate,1,0,'C',0); 
$pdf->cell(30,$rh,files,1,0,'C',0); 
$pdf->cell(30,$rh,taskstatus,1,0,'C',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$sql = " select * from tasklist"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idtasklist'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['project_idproject'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['emp_idemp'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['taskname'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['keterangan'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['startdate'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['enddate'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['finishdate'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['files'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['taskstatus'],1,0,'L',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
