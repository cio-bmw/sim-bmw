<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];
//Create new pdf file
$pdf = new FPDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('P');
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
$pdf->text($x,$yx,'Rekap Pembayaran SPK');
$pdf->SetFont('helvetica','B',10);

      $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);

//buat header tabel//

      $sql1 = "select * from unitspk where idunitspk = '".$id."'"; 
      $result1 = mysql_query($sql1);
      $data1 = mysql_fetch_array($result1);
      $tgl = gettanggal($data1['spkdate']);
      $spkvalue = nf($data1['spkvalue']);      
      $contractor = $data1['contractor_idcontractor'];
      $ccontractor = contractorinfo($contractor);
      $contractorname= $ccontractor['contractorname'];     
      
       $idunit = $data1['unit_idunit'];
       $unit = unitinfo($idunit);
       $idsektor = $unit['sektor_idsektor'];
       $kavling = $unit['kavling'];   
       $sektor = sektorinfo($idsektor);
       $sektorname = $sektor['sektorname'];
       
                      
      
    $sektorkavling = $sektorname.'/'.$kavling;       
      
      
      $spkcat = spkcatinfo($data1['spkcat_idspkcat']);
      $category = $spkcat['category'];
 
      $pdf->cell(30,$rh,'No SPK ',0,0,'L',0);
      $pdf->cell(50,$rh,': '.$id,0,0,'L',0);

      $pdf->cell(30,$rh,'Jenis SPK ',0,0,'L',0);
      $pdf->cell(50,$rh,': '.$category,0,0,'L',0);

      
      $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
      $pdf->cell(30,$rh,'Tanggal  ',0,0,'L',0);
      $pdf->cell(50,$rh,': '.$tgl,0,0,'L',0);
      
      $pdf->cell(30,$rh,'Kontraktor ',0,0,'L',0);
      $pdf->cell(50,$rh,': '.$contractorname,0,0,'L',0);
      $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
      
      $pdf->cell(30,$rh,'Nilai Kontrak  ',0,0,'L',0);
      $pdf->cell(50,$rh,': '.$spkvalue,0,0,'L',0);

      $pdf->cell(30,$rh,'Sektor/Kavling ',0,0,'L',0);
      $pdf->cell(50,$rh,': '.$sektorkavling,0,0,'L',0);
    
      $yr= $pdf->getY()+$rh+5; $pdf->setY($yr);$pdf->SetX($x);
      



 $pdf->cell(30,$rh,'Detail Pembayaran SPK',0,0,'L',0); 
 
  $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
 $pdf->cell(10,$rh,'No',1,0,'L',0); 
 $pdf->cell(20,$rh,'No Dok',1,0,'L',0); 
 $pdf->cell(30,$rh,'Tanggal',1,0,'L',0); 
 $pdf->cell(30,$rh,'Jumlah',1,0,'R',0); 

 
$yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
  
  
$sql = " select * from spkpaymenthdr a,spkpaymentdtl b 
where b.spkpaymenthdr_idspkpaymenthdr = a.idspkpaymenthdr and b.unitspk_idunitspk = '$id'"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 
 
$pdf->cell(10,$rh,$no,1,0,'L',0); 
$pdf->cell(20,$rh,$row['idspkpaymenthdr'],1,0,'L',0);
$pdf->cell(30,$rh,gettanggal($row['paydate']),1,0,'L',0);
$pdf->cell(30,$rh,nf($row['payvalue']),1,0,'R',0); 

 
$yx =$yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
$i++;
$no++; 
$total = $total + $row['payvalue'];

} 
 
$pdf->cell(60,$rh,'Total Pembayaran',1,0,'L',0); 
$pdf->cell(30,$rh,nf($total),1,0,'R',0);

$yx =$yr= $pdf->getY()+10; $pdf->setY($yr);$pdf->SetX($x);

 
#output file PDF 
$pdf->Output(); 
?> 
