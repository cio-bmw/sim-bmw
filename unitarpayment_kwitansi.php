<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];
//Create new pdf file
//$pdf=new FPDF();
$pdf = new FPDF('L','mm','A5');
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('L');
//set initial y axis position per page
$y = 0;
$x = 0;
$rh = 6;
$pdf -> SetMargins(25,5);
//    Image(Resource id #17, =null, =null, =0, =0, int(11)='', ='') 
$pdf->image('./images/logo.png',25,7,60,15);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+15;
$pdf->SetY($yx);

$pdf->cell(140,$rh,'KWITANSI PEMBAYARAN',0,0,'C',0); 
$pdf->SetFont('Arial','',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('Arial','',12);
$pdf->SetY($yx);

$sql = " select * from unitarpayment where idunitarpayment='$id'"; 
$result = mysql_query($sql); 
while($row = mysql_fetch_array($result)) { 

$payment=unitmstpaymentinfo($row['unitmstpayment_idpayment']);
  $paymentdesc = $payment['paymentdesc'];  
   $unit = unitinfo($row['unit_idunit']);
   $kavling = $unit['kavling'];   
   $idsektor = $unit['sektor_idsektor'];
   
   $sektor =sektorinfo($idsektor);
  	$sektorname = $sektor['sektorname'];
  
$pdf->cell(45,$rh,'Kwitansi No',0,0,'L',0); 
$pdf->cell(30,$rh,': '.$idsektor.'/'.$kavling.'/'.$row['unitmstpayment_idpayment'].'/'.$row['idunitarpayment'],0,0,'L',0); 

$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
 $pdf->cell(45,$rh,'Sudah Terima Dari ',0,0,'L',0); 
$pdf->cell(30,$rh,': '.$row['pay_name'],0,0,'L',0); 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$bayar = $row['pay_value']+$row['denda'];

$terbilang = '#'.terbilang($bayar).' rupiah#';

 $pdf->cell(45,$rh,'Uang Sejumlah ',0,0,'L',0); 
$pdf->cell(30,$rh,': '.$terbilang,0,0,'L',0); 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$pdf->cell(45,$rh,'Untuk Pembayaran ',0,0,'L',0); 
$xbayar = ': '.$paymentdesc.' Kavling '.$kavling.' '.$sektorname;
$pdf->cell(30,$rh,$xbayar,0,0,'L',0); 

$yx =$pdf->getY()+$rh; $pdf->SetY($yx);

$pdf->cell(45,$rh,'Transfer ',0,0,'L',0); 
$xtrf = ': '.$row['transfer'];
$pdf->cell(30,$rh,$xtrf,0,0,'L',0); 
$yx =$pdf->getY()+5; $pdf->SetY($yx);


$pdf->cell(150,$rh,'Tulungagung,'.gettanggal($row['pay_date']),0,0,'R',0); 
$yx =$pdf->getY()+10; 
$pdf->SetY($yx);

$pdf->cell(25,$rh,'Terbilang : ',0,0,'L',0); 
$pdf->cell(30,$rh,' Rp '.nf($bayar).',--',0,0,'L',0); 
$yx =$pdf->getY()+15; 
$pdf->SetY($yx);

$pdf->cell(150,$rh,'Penerima                                    Pembayar   ',0,0,'R',0); 
$yx =$pdf->getY()+20; $pdf->SetY($yx);
$pdf->cell(150,$rh,'---------------                                 ---------------- ',0,0,'R',0); 
 } 
#output file PDF 
$pdf->Output(); 
?> 
