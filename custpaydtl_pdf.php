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
$pdf->text($x,$yx,'Daftar custpaydtl');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idcustpaydtl,1,0,'C',0); 
$pdf->cell(30,$rh,pay_value,1,0,'C',0); 
$pdf->cell(30,$rh,custpayhdr_idcustpayhdr,1,0,'C',0); 
$pdf->cell(30,$rh,unitmstpayment_idpayment,1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select idcustpaydtl,pay_value,custpayhdr_idcustpayhdr,unitmstpayment_idpayment from custpaydtl"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idcustpaydtl'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['pay_value'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['custpayhdr_idcustpayhdr'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['unitmstpayment_idpayment'],1,0,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
