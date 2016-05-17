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
//    Image(Resource id #18, =null, =null, =0, =0, int(11)='', ='') 
$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$pdf->cell(30,$rh,'Daftar txndaily',0,0,'C',0);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idtxndaily,1,0,'C',0); 
$pdf->cell(30,$rh,txndate,1,0,'C',0); 
$pdf->cell(30,$rh,txndesc,1,0,'C',0); 
$pdf->cell(30,$rh,dvalue,1,0,'C',0); 
$pdf->cell(30,$rh,kvalue,1,0,'C',0); 
$pdf->cell(30,$rh,saldo,1,0,'C',0); 
$pdf->cell(30,$rh,txnflag,1,0,'C',0); 
$pdf->cell(30,$rh,txnpos_idtxnpos,1,0,'C',0); 
$pdf->cell(30,$rh,txnalokasi_idtxnalokasi,1,0,'C',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$sql = " select * from txndaily"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idtxndaily'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['txndate'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['txndesc'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['dvalue'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['kvalue'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['saldo'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['txnflag'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['txnpos_idtxnpos'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['txnalokasi_idtxnalokasi'],1,0,'L',0); 
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x); 
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
