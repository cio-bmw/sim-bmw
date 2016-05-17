<?php 
require("fpdf.php"); 
require_once "config.php"; 
$sektor = $_GET['sektor'];
$idcontractor = $_GET['cont'];
$idunit = $_GET['unit'];


//Create new pdf file
$pdf=new FPDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(true);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 0;
$x = 0;
$rh = 6;
$pdf -> SetMargins(5,30);
//    Image(Resource id #17, =null, =null, =0, =0, int(11)='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+20; $pdf->SetY($yx);
 $pdf->cell(200,$rh,'Rekap Pembayaran SPK',0,0,'C',0); 
$yx = $pdf->getY()+$rh; $pdf->SetY($yx);
$pdf->SetFont('helvetica','',8);
$tglcetak = date('d-m-Y H:i:s'); 
$pdf->cell(200,$rh,'Dicetak : '.$tglcetak,0,0,'C',0); 
$yx = $pdf->getY()+$rh+5; $pdf->SetY($yx);
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('Arial','',9);
$pdf->SetY($yx);
//buat header tabel//
$pdf->cell(10,$rh,'No',1,0,'C',0); 
$pdf->cell(10,$rh,'SPK',1,0,'C',0); 
$pdf->cell(20,$rh,'Tanggal',1,0,'C',0); 
$pdf->cell(40,$rh,'Jenis SPK',1,0,'C',0); 
$pdf->cell(28,$rh,'Sektor',1,0,'C',0); 
$pdf->cell(15,$rh,'Kavling',1,0,'C',0); 
$pdf->cell(25,$rh,'Kontraktor',1,0,'C',0); 
$pdf->cell(18,$rh,'Nilai SPK',1,0,'C',0); 
$pdf->cell(18,$rh,'BON',1,0,'C',0); 
$pdf->cell(18,$rh,'Sisa',1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);

if ($sektor == '%') {

if ($idcontractor=='%') {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit 
and unit_idunit like '%".$idunit."%'
order by idunitspk desc "; 
}
else {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
a.contractor_idcontractor = '".$idcontractor."' 
and unit_idunit like '%".$idunit."%'
order by idunitspk desc "; 
}

} else { 

if ($idcontractor=='%') {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
b.sektor_idsektor = '$sektor' and unit_idunit like '%".$idunit."%'
order by idunitspk desc "; 


} else {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
b.sektor_idsektor = '$sektor' and a.contractor_idcontractor = '".$idcontractor."' 
and unit_idunit like '%".$idunit."%'
order by idunitspk desc "; 
}


}


$result = mysql_query($sql); 
$i=1;  
$no=1;  
//$max =21;  
while($row = mysql_fetch_array($result)) { 
 
 /*
 
// if ($i == 41) {
// 	$pdf->AddPage('P');
// $pdf->cell(10,$rh,'No',1,0,'C',0); 
$pdf->cell(10,$rh,'SPK',1,0,'C',0); 
$pdf->cell(20,$rh,'Tanggal',1,0,'C',0); 
$pdf->cell(40,$rh,'Jenis SPK',1,0,'C',0); 
$pdf->cell(28,$rh,'Sektor',1,0,'C',0); 
$pdf->cell(15,$rh,'Kavling',1,0,'C',0); 
$pdf->cell(25,$rh,'Kontraktor',1,0,'C',0); 
$pdf->cell(18,$rh,'Nilai SPK',1,0,'C',0); 
$pdf->cell(18,$rh,'BON',1,0,'C',0); 
$pdf->cell(18,$rh,'Sisa',1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
// $i = 0;
 
 
// }
  
*/ 
 
  $unit = unitinfo($row['unit_idunit']);
      $kavling = $unit['kavling'];  	
      
      	
      $sektor = sektorinfo($unit['sektor_idsektor']);
   	$sektorname = $sektor['sektorname'];
  
      $spkcat = spkcatinfo($row['spkcat_idspkcat']);
      $category = $spkcat['category'];      
      
      $contractor = contractorinfo($row['cont']);
      $contractorname = $contractor['contractorname'];
      
       $sql1 = "select sum(payvalue) jumlah from spkpaymentdtl where unitspk_idunitspk = '".$row['idunitspk']."'"; 
      $result1 = mysql_query($sql1);
      $data1 = mysql_fetch_array($result1);
      $pembayaran = $data1[0];
      $sisa = $row['spkvalue'] - $pembayaran;      	

       if ($row['spkvalue'] != 0  ) {       
      $pct = $pembayaran/$row['spkvalue']*100;
      } else {$pct = 0; }

if ($sisa > 0 ) {
 
 $pdf->cell(10,$rh,$no,1,0,'R',0); 
 $pdf->cell(10,$rh,$row['idunitspk'],1,0,'R',0); 
$pdf->cell(20,$rh,$row['spkdate'],1,0,'L',0); 
$pdf->cell(40,$rh,$category,1,0,'L',0); 
$pdf->cell(28,$rh,$sektorname,1,0,'L',0);
$pdf->cell(15,$rh,$kavling,1,0,'L',0);
$pdf->cell(25,$rh,$contractorname,1,0,'L',0);
$pdf->cell(18,$rh,nf($row['spkvalue']),1,0,'R',0); 
$pdf->cell(18,$rh,nf($pembayaran),1,0,'R',0); 
$pdf->cell(18,$rh,nf($sisa),1,0,'R',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
}
$totalspk = $totalspk+$row['spkvalue'];
$totalbon = $totalbon + $pembayaran;
$totalsisa = $totalsisa + $sisa; 


$i++;
$no++; 
 } 
$pdf->cell(148,$rh,'Total',1,0,'L',0);
$pdf->cell(18,$rh,nf($totalspk),1,0,'R',0); 
$pdf->cell(18,$rh,nf($totalbon),1,0,'R',0); 
$pdf->cell(18,$rh,nf($totalsisa),1,0,'R',0); 
 
 
#output file PDF 
$pdf->Output(); 
?> 
