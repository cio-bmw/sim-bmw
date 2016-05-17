<?php 
require("fpdf.php"); 
require_once "config.php"; 
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);

//$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//$pdf = new FPDF('P','mm',array(100,150));
//Disable automatic page break
$pdf->SetAutoPageBreak(true,15);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 0;
$x = 0;
$rh = 6;
$pdf -> SetMargins(30,20);
//    Image(Resource id #16, =null, =null, =0, =0, varchar(5)='', ='') 
$pdf->image('./images/logo.png',30,5,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+10;
$pdf->SetY($yx);
$pdf->SetFont('Arial','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($yx);
$pdf->cell(120,$rh,'Rekap Nilai Penerimaan Barang Per Supplier Per Tanggal '.gettanggal($startdate).' s/d '.gettanggal($enddate),0,0,'L',0); 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
//buat header tabel//
$pdf->SetFont('arial','',10);
 $pdf->cell(10,$rh,'No',1,0,'C',0); 
$pdf->cell(25,$rh,'Kode',1,0,'C',0); 
$pdf->cell(75,$rh,'Nama supplier',1,0,'C',0); 
$pdf->cell(30,$rh,'Jumlah',1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);

$sql = "select distinct sektor_idsektor from receivehdrsektor where rcv_date between '$startdate' and '$enddate' order by supplier_idsupp"; 
$result = mysql_query($sql);


$no=1;  
$max =21;  
$total = 0;
while($row = mysql_fetch_array($result)) { 
$idsektor = $row['sektor_idsektor'];			
$sektor = sektorinfo($row['sektor_idsektor']) ; 
$sektorname = $sektor['sektorname'];

$sql2="SELECT sum(receive_price * qty) vreceive FROM receivedtlsektor a, receivehdrsektor b  
where a.receivehdrsektor_idreceivehdr = b.idreceivehdr and 
b.rcv_date between '$startdate' and '$enddate' and 
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
