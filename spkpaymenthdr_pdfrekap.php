<?php 
require("fpdf.php"); 
require_once "config.php"; 
$idcontractor = $_GET['cont'];
$start = $_GET['start'];
$end = $_GET['end'];

$startdate = settanggal($_GET['start']);
$enddate = settanggal($_GET['end']);

$contractor = contractorinfo($idcontractor);
$contractorname = $contractor['contractorname'];

//Create new pdf file
$pdf=new FPDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(true);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 0;
$x = 0;
$rh = 5;
$pdf -> SetMargins(30,30);
//    Image(Resource id #17, =null, =null, =0, =0, int(11)='', ='') 
$pdf->image('./images/logoaja.png',30,7,75,10);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+10;
$pdf->SetY($yx);
$pdf->cell(160,$rh,'Rekap Pembayaran Kontraktor',0,0,'L',0); 
$pdf->SetFont('helvetica','B',10);
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('Arial','',10);

$yx = $pdf->getY()+$rh+3; $pdf->SetY($yx);
$pdf->cell(30,$rh,'Tanggal',0,0,'L',0);
$pdf->cell(5,$rh,':',0,0,'L',0);
$pdf->cell(30,$rh,$start.' s/d '.$end,0,0,'L',0); 
$yx = $pdf->getY()+$rh+3; $pdf->SetY($yx);

//buat header tabel//
$pdf->cell(10,$rh,'No',1,0,'C',0); 
$pdf->cell(50,$rh,'Kontraktor',1,0,'C',0); 
$pdf->cell(30,$rh,Jumlah,1,0,'C',0); 
 
$yx =$pdf->getY()+$rh;$pdf->SetY($yx);

$sql = "select contractor_idcontractor,sum(payvalue) jumlah from spkpaymenthdr a,spkpaymentdtl b where paydate between '$startdate' and '$enddate' 
and a.idspkpaymenthdr = b.spkpaymenthdr_idspkpaymenthdr group by contractor_idcontractor 
order by contractor_idcontractor,paydate desc"; 

//$pdf->multicell(150,$rh,$sql,1,0,'L',0); 
$result = mysql_query($sql); 
$no=1;  
$max =21;  
while($row = mysql_fetch_array($result)) {  
$contractor =contractorinfo($row['contractor_idcontractor']);
$cname=$contractor['contractorname'];
 
$pdf->cell(10,$rh,$no,1,0,'L',0);
$pdf->cell(50,$rh,$cname,1,0,'L',0);
$pdf->cell(30,$rh,nf($row['jumlah']),1,0,'R',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$totjumlah = $totjumlah + $row['jumlah']; 		
$no++;
 } 
 $pdf->cell(60,$rh,'Jumlah',1,0,'L',0); 
$pdf->cell(30,$rh,nf($totjumlah),1,0,'R',0); 

 
#output file PDF 
$pdf->Output(); 


?> 
