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
//    Image(Resource id #17, =null, =null, =0, =0, varchar(10)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+40;
$pdf->SetY($yx);
$pdf->text($x,$yx,'Daftar bukutamu');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idbukutamu,1,0,'C',0); 
$pdf->cell(30,$rh,nama,1,0,'C',0); 
$pdf->cell(30,$rh,alamat,1,0,'C',0); 
$pdf->cell(30,$rh,notlp,1,0,'C',0); 
$pdf->cell(30,$rh,tanggal,1,0,'C',0); 
$pdf->cell(30,$rh,catatan,1,0,'C',0); 
$pdf->cell(30,$rh,diterima,1,0,'C',0); 
$pdf->cell(30,$rh,emp_idemp,1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select idbukutamu,nama,alamat,notlp,tanggal,catatan,diterima,emp_idemp from bukutamu"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idbukutamu'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['nama'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['alamat'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['notlp'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['tanggal'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['catatan'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['diterima'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['emp_idemp'],1,0,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
