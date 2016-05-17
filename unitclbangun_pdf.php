<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];

$unitspk = unitspkinfo($id);
$idunit = $unitspk['unit_idunit'];
$tanggal = $unitspk['spkdate'];
$idcontractor = $unit['contractor_idcontractor'];
$contractor = contractorinfo($idcontractor);
$kontraktor = $contractor['contractorname'];


$unit = unitinfo($idunit);
$kavling = $unit['kavling'];
$idsektor = $unit['sektor_idsektor'];



$sektor = sektorinfo($idsektor);
$sektorname = $sektor['sektorname'];


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
$pdf -> SetMargins(5,30);
//    Image(Resource id #17, =null, =null, =0, =0, decimal(5,2)='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+10;
$pdf->SetY($yx);
$pdf->cell(200,$rh,'Progres Pekerjaan Kontraktor',0,0,'C',0); 
$yx =$pdf->getY()+$rh+3; $pdf->SetY($yx);
$pdf->cell(30,$rh,'Sektor',0,0,'L',0); 
$pdf->cell(100,$rh,': '.$sektorname,0,0,'L',0); 
$pdf->cell(30,$rh,'No SPK',0,0,'L',0); 
$pdf->cell(100,$rh,': '.$id,0,0,'L',0); 
$yx =$pdf->getY()+$rh; $pdf->SetY($yx);
$pdf->cell(30,$rh,'Kavling',0,0,'L',0); 
$pdf->cell(100,$rh,': '.$kavling,0,0,'L',0); 
$pdf->cell(30,$rh,'Tgl SPK',0,0,'L',0); 
$pdf->cell(100,$rh,': '.$tanggal,0,0,'L',0); 
$yx =$pdf->getY()+$rh; $pdf->SetY($yx);
$pdf->cell(30,$rh,'',0,0,'L',0); 
$pdf->cell(100,$rh,'',0,0,'C',0); 
$pdf->cell(30,$rh,'Kontraktor',0,0,'L',0); 
$pdf->cell(100,$rh,': '.$kontraktor,0,0,'L',0); 
$yx =$pdf->getY()+$rh; $pdf->SetY($yx);



$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
$pdf->cell(30,$rh,'No',1,0,'C',0); 
$pdf->cell(30,$rh,'Check Item',1,0,'C',0); 
$pdf->cell(30,$rh,'Bobot',1,0,'C',0); 
$pdf->cell(30,$rh,'Progress',1,0,'C',0); 
$pdf->cell(30,$rh,workdays,1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; $pdf->SetY($yx);
$sql = " select * from unitclbangun where unitspk_idunitspk = '$id'"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$no,1,0,'L',0); 
$pdf->cell(30,$rh,$row['clstatus'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['clbangun_idclbangun'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['unit_idunit'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['bobotpct'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['unitspk_idunitspk'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['workdays'],1,0,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
