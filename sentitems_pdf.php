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
//    Image(Resource id #19, =null, =null, =0, =0, text='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$pdf->cell(30,$rh,'Daftar sentitems',0,0,'C',0);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,UpdatedInDB,1,0,'C',0); 
$pdf->cell(30,$rh,InsertIntoDB,1,0,'C',0); 
$pdf->cell(30,$rh,SendingDateTime,1,0,'C',0); 
$pdf->cell(30,$rh,DeliveryDateTime,1,0,'C',0); 
$pdf->cell(30,$rh,Text,1,0,'C',0); 
$pdf->cell(30,$rh,DestinationNumber,1,0,'C',0); 
$pdf->cell(30,$rh,Coding,1,0,'C',0); 
$pdf->cell(30,$rh,UDH,1,0,'C',0); 
$pdf->cell(30,$rh,SMSCNumber,1,0,'C',0); 
$pdf->cell(30,$rh,Class,1,0,'C',0); 
$pdf->cell(30,$rh,TextDecoded,1,0,'C',0); 
$pdf->cell(30,$rh,ID,1,0,'C',0); 
$pdf->cell(30,$rh,SenderID,1,0,'C',0); 
$pdf->cell(30,$rh,SequencePosition,1,0,'C',0); 
$pdf->cell(30,$rh,Status,1,0,'C',0); 
$pdf->cell(30,$rh,StatusError,1,0,'C',0); 
$pdf->cell(30,$rh,TPMR,1,0,'C',0); 
$pdf->cell(30,$rh,RelativeValidity,1,0,'C',0); 
$pdf->cell(30,$rh,CreatorID,1,0,'C',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$sql = " select * from sentitems"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['UpdatedInDB'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['InsertIntoDB'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['SendingDateTime'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['DeliveryDateTime'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['Text'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['DestinationNumber'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['Coding'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['UDH'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['SMSCNumber'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['Class'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['TextDecoded'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['ID'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['SenderID'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['SequencePosition'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['Status'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['StatusError'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['TPMR'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['RelativeValidity'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['CreatorID'],1,0,'L',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
