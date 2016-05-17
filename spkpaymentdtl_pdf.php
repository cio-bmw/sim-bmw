<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];
//Create new pdf file
$pdf = new FPDF('P','mm','A4');
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('L');
//set initial y axis position per page
$y = 0;
$x = 25;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #17, =null, =null, =0, =0, int(11)='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',18);
$yx = $pdf->getY()+15;
$pdf->SetY($yx);
$pdf->cell(150,$rh,'Pembayaran Kontraktor',0,0,'C',0);
$pdf->SetFont('arial','',10);
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('arial','',12);

//buat header tabel//

      $sql1 = "select * from spkpaymenthdr where idspkpaymenthdr = '".$id."'"; 
      $result1 = mysql_query($sql1);
      $data1 = mysql_fetch_array($result1);
      $nodok = $data1['idspkpaymenthdr'];
      $tgl = $data1['paydate'];
      $contractor = $data1['contractor_idcontractor'];
      $ccontractor = contractorinfo($contractor);
      $contractorname= $ccontractor['contractorname'];     
      $yr= $pdf->getY()+$rh+3; $pdf->setY($yr);$pdf->SetX($x);
      $pdf->cell(30,$rh,'No Dok ',0,0,'L',0);
      $pdf->cell(75,$rh,': '.$nodok,0,0,'L',0);

      $pdf->cell(30,$rh,'Kontraktor ',0,0,'L',0);
      $pdf->cell(75,$rh,': '.$contractor.'/'.$contractorname,0,0,'L',0);

      
      $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
      $pdf->cell(30,$rh,'Tanggal  ',0,0,'L',0);
      $pdf->cell(75,$rh,': '.gettanggal($tgl),0,0,'L',0);
       
      $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
      



 $pdf->cell(30,$rh,'Detail Pembayaran SPK',0,0,'L',0); 
 
  $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
 $pdf->cell(10,$rh,No,1,0,'L',0); 
 $pdf->cell(20,$rh,'No SPK',1,0,'L',0); 
 $pdf->cell(50,$rh,Keterangan,1,0,'L',0); 
 $pdf->cell(50,$rh,Kavling,1,0,'L',0); 
$pdf->cell(30,$rh,Jumlah,1,0,'R',0); 

 
$yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
  
  
$sql = " select * from spkpaymentdtl 
where spkpaymenthdr_idspkpaymenthdr = '$id'"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 
 
$unitspk = unitspkinfo($row['unitspk_idunitspk']); 
$spkcat=$unitspk['spkcat_idspkcat'];
$cspkcat = spkcatinfo($spkcat);
$category = $cspkcat['category'];

$unit=$unitspk['unit_idunit'];
$cunit = unitinfo($unit);
$kavling = $cunit['kavling'];
$idsektor = $cunit['sektor_idsektor'];
$sektor = sektorinfo($idsektor);
$sektorname = $sektor['sektorname'];

 
$pdf->cell(10,$rh,$no,1,0,'L',0); 
$pdf->cell(20,$rh,$row['unitspk_idunitspk'],1,0,'L',0);
$pdf->cell(50,$rh,$category,1,0,'L',0);
 $pdf->cell(50,$rh,$sektorname.'/'.$kavling,1,0,'L',0);
$pdf->cell(30,$rh,nf($row['payvalue']),1,0,'R',0); 

 
$yx =$yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
$i++;
$no++; 
$total = $total + $row['payvalue'];

} 
 
$pdf->cell(130,$rh,'Total Pembayaran',1,0,'L',0); 
$pdf->cell(30,$rh,nf($total),1,0,'R',0);

$yx =$yr= $pdf->getY()+10; $pdf->setY($yr);$pdf->SetX($x);
$pdf->cell(80,$rh,'Di Bayarkan Oleh',0,0,'C',0); 
$pdf->cell(80,$rh,'Di Terima Oleh',0,0,'C',0);
$yx =$yr= $pdf->getY()+30; $pdf->setY($yr);$pdf->SetX($x);
$pdf->cell(80,$rh,'------------------',0,0,'C',0); 
$pdf->cell(80,$rh,'------------------',0,0,'C',0);

 
#output file PDF 
$pdf->Output(); 
?> 
