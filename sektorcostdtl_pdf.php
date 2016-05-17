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
//    Image(Resource id #17, =null, =null, =0, =0, int(11)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+40;
$pdf->SetY($yx);
$pdf->text($x,$yx,'Daftar sektorcostdtl');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idsektorcostdtl,1,0,'C',0); 
$pdf->cell(30,$rh,costprice,1,0,'C',0); 
$pdf->cell(30,$rh,rabmst_idrabmst,1,0,'C',0); 
$pdf->cell(30,$rh,txndtldesc,1,0,'C',0); 
$pdf->cell(30,$rh,sektorcosthdr_idsektorcosthdr,1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select idsektorcostdtl,costprice,rabmst_idrabmst,txndtldesc,sektorcosthdr_idsektorcosthdr from sektorcostdtl"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idsektorcostdtl'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['costprice'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rabmst_idrabmst'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['txndtldesc'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['sektorcosthdr_idsektorcosthdr'],1,0,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
