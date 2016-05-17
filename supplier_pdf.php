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
$x = 30;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #16, =null, =null, =0, =0, varchar(1)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+40;
$pdf->SetY($yx);
$pdf->text($x,$yx,'Daftar supplier');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idsupp,1,'C',0); 
$pdf->cell(30,$rh,suppname,1,'C',0); 
$pdf->cell(30,$rh,supptype,1,'C',0); 
$pdf->cell(30,$rh,address,1,'C',0); 
$pdf->cell(30,$rh,phone,1,'C',0); 
$pdf->cell(30,$rh,fax,1,'C',0); 
$pdf->cell(30,$rh,email,1,'C',0); 
$pdf->cell(30,$rh,website,1,'C',0); 
$pdf->cell(30,$rh,creditlimit,1,'C',0); 
$pdf->cell(30,$rh,npwp,1,'C',0); 
$pdf->cell(30,$rh,contact,1,'C',0); 
$pdf->cell(30,$rh,pooverdue,1,'C',0); 
$pdf->cell(30,$rh,aroverdue,1,'C',0); 
$pdf->cell(30,$rh,active,1,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select idsupp,suppname,supptype,address,phone,fax,email,website,creditlimit,npwp,contact,pooverdue,aroverdue,active from supplier"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idsupp'],1,'L',0); 
$pdf->cell(30,$rh,$row['suppname'],1,'L',0); 
$pdf->cell(30,$rh,$row['supptype'],1,'L',0); 
$pdf->cell(30,$rh,$row['address'],1,'L',0); 
$pdf->cell(30,$rh,$row['phone'],1,'L',0); 
$pdf->cell(30,$rh,$row['fax'],1,'L',0); 
$pdf->cell(30,$rh,$row['email'],1,'L',0); 
$pdf->cell(30,$rh,$row['website'],1,'L',0); 
$pdf->cell(30,$rh,$row['creditlimit'],1,'L',0); 
$pdf->cell(30,$rh,$row['npwp'],1,'L',0); 
$pdf->cell(30,$rh,$row['contact'],1,'L',0); 
$pdf->cell(30,$rh,$row['pooverdue'],1,'L',0); 
$pdf->cell(30,$rh,$row['aroverdue'],1,'L',0); 
$pdf->cell(30,$rh,$row['active'],1,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
