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
$pdf->text($x,$yx,'Daftar unitspk');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idunitspk,1,0,'C',0); 
$pdf->cell(30,$rh,spkno,1,0,'C',0); 
$pdf->cell(30,$rh,spkdesc1,1,0,'C',0); 
$pdf->cell(30,$rh,spkdesc2,1,0,'C',0); 
$pdf->cell(30,$rh,spkvalue,1,0,'C',0); 
$pdf->cell(30,$rh,spkcat_idspkcat,1,0,'C',0); 
$pdf->cell(30,$rh,unit_idunit,1,0,'C',0); 
$pdf->cell(30,$rh,contractor_idcontractor,1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select idunitspk,spkno,spkdesc1,spkdesc2,spkvalue,spkcat_idspkcat,unit_idunit,contractor_idcontractor from unitspk"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idunitspk'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['spkno'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['spkdesc1'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['spkdesc2'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['spkvalue'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['spkcat_idspkcat'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['unit_idunit'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['contractor_idcontractor'],1,0,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
