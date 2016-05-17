<?php 
require("fpdf.php"); 
require_once "config/config.php"; 
require_once "config/common.php"; 
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
//    Image(Resource id #16, =null, =null, =0, =0, varchar(10)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+40;
$pdf->SetY($yx);
$pdf->text($x,$yx,'Daftar slshdr');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idslshdr,1,'C',0); 
$pdf->cell(30,$rh,sls_date,1,'C',0); 
$pdf->cell(30,$rh,sls_bon,1,'C',0); 
$pdf->cell(30,$rh,sls_titip,1,'C',0); 
$pdf->cell(30,$rh,due_date,1,'C',0); 
$pdf->cell(30,$rh,sls_blj,1,'C',0); 
$pdf->cell(30,$rh,sls_tambahan,1,'C',0); 
$pdf->cell(30,$rh,sls_total,1,'C',0); 
$pdf->cell(30,$rh,sls_bayar,1,'C',0); 
$pdf->cell(30,$rh,sls_kembali,1,'C',0); 
$pdf->cell(30,$rh,sls_desc,1,'C',0); 
$pdf->cell(30,$rh,payment_date,1,'C',0); 
$pdf->cell(30,$rh,sls_status,1,'C',0); 
$pdf->cell(30,$rh,sls_diskon,1,'C',0); 
$pdf->cell(30,$rh,emp_idemp,1,'C',0); 
$pdf->cell(30,$rh,customer_idcustomer,1,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select idslshdr,sls_date,sls_bon,sls_titip,due_date,sls_blj,sls_tambahan,sls_total,sls_bayar,sls_kembali,sls_desc,payment_date,sls_status,sls_diskon,emp_idemp,customer_idcustomer from slshdr"; 
$result = execsql($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idslshdr'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_date'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_bon'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_titip'],1,'L',0); 
$pdf->cell(30,$rh,$row['due_date'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_blj'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_tambahan'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_total'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_bayar'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_kembali'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_desc'],1,'L',0); 
$pdf->cell(30,$rh,$row['payment_date'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_status'],1,'L',0); 
$pdf->cell(30,$rh,$row['sls_diskon'],1,'L',0); 
$pdf->cell(30,$rh,$row['emp_idemp'],1,'L',0); 
$pdf->cell(30,$rh,$row['customer_idcustomer'],1,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
