<?php 
require("fpdf.php"); 
require_once "config.php"; 
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
//$idsektor = $_GET['idsektor'];

//$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//$pdf = new FPDF('P','mm',array(100,150));
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 0;
$x = 0;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #16, =null, =null, =0, =0, varchar(5)='', ='') 
$pdf->image('./images/logoaja.png',25,15,100,15);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+20;
$pdf->SetY($yx);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',10);
$pdf->SetY($yx);
$pdf->cell(120,$rh,'Rekap Pengiriman Barang ke Sektor '.$idsektor.' '.gettanggal($startdate).' s/d '.gettanggal($enddate),0,0,'L',0); 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(10,$rh,'No',1,0,'C',0); 
$pdf->cell(25,$rh,'Kode',1,0,'C',0); 
$pdf->cell(75,$rh,'Nama supplier',1,0,'C',0); 
$pdf->cell(30,$rh,'Jumlah',1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = "select distinct sektor_idsektor from slshdrsektor where sls_date between '$startdate' and '$enddate'
order by sektor_idsektor"; 

$result = mysql_query($sql); 
$no=1;  
$max =21;  
$total = 0;
while($row = mysql_fetch_array($result)) { 
$idsektor = $row['sektor_idsektor'];			
$sektor = sektorinfo($row['sektor_idsektor']) ; 
$sektorname = $sektor['sektorname'];

$sql2="SELECT sum(sales_price * qty) vsales FROM slsdtlsektor a, slshdrsektor b  
where a.slshdrsektor_idslshdr = b.idslshdr and 
b.sls_date between '$startdate' and '$enddate' and 
sektor_idsektor = '$idsektor' group by sektor_idsektor";

$data2  = mysql_fetch_array(mysql_query($sql2));  
$mrcv = $data2[0];	
 
$pdf->cell(10,$rh,$no,1,0,'R',0); 
$pdf->cell(25,$rh,$idsektor,1,0,'L',0); 
$pdf->cell(75,$rh,$sektorname,1,0,'L',0); 
$pdf->cell(30,$rh,nf($mrcv),1,0,'R',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$no++; 
$total = $total + $mrcv;
 } 
$pdf->cell(110,$rh,'Total',1,0,'R',0); 
$pdf->cell(30,$rh,nf($total),1,0,'R',0); 
 
#output file PDF 
$pdf->Output(); 
?> 
