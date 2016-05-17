<?php 
require("fpdf.php"); 
require_once "config.php"; 
$sektor_idsektor = $_GET['id']; 
$sektor=sektorinfo($_GET['id']);
$sektorname = $sektor['sektorname'];

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
$pdf -> SetMargins(20,20);
//    Image(Resource id #17, =null, =null, =0, =0, int(11)='', ='') 
//$pdf->image('./images/logo.jpeg',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+10;
$pdf->SetY($yx);
$pdf->cell(120,$rh,'Rencana Anggaran Belanja Sektor  '.$sektorname,0,0,'L',0); 
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',10);
$pdf->SetY($yx);
$totalallcat=0; $totalallacc=0;

$sql0 = "select * from rabcat";
$result0 = mysql_query($sql0);
while($row0= mysql_fetch_array($result0)) { 
$idrabcat = $row0['idrabcat'];

$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$pdf->cell(120,$rh,$row0['rabcatname'],0,0,'L',0); 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(10,$rh,'No',1,0,'C',0); 
 $pdf->cell(70,$rh,'Keterangan',1,0,'C',0); 
$pdf->cell(15,$rh,volume,1,0,'C',0); 
$pdf->cell(20,$rh,hargasat,1,0,'C',0); 
$pdf->cell(25,$rh,Jumlah,1,0,'C',0); 
$pdf->cell(25,$rh,Akumulasi,1,0,'C',0); 

 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = "select * from sektorrab a, rabmst b 
where a.rabmst_idrabmst = b.idrabmst and  
b.rabcat_idrabcat = '$idrabcat' and 
sektor_idsektor ='$sektor_idsektor' order by rabmst_idrabmst"; 

$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
$totalcat = 0; $totalacc =0; 
 while($row = mysql_fetch_array($result)) { 
 $idrabmst = $row['rabmst_idrabmst'];  		
$rabmst = rabmstinfo($row['rabmst_idrabmst']);
$rabdesc = $rabmst['rabdesc'];  
$total = $row['volume']*$row['hargasat'];	 		
$totalcat = $totalcat + $total; 



$sql1 = "select IFNULL(sum(txnvalue),0) jml from sektorrabtxn
where rabmst_idrabmst = '$idrabmst' and sektor_idsektor = '$sektor_idsektor' "; 
$data1  = mysql_fetch_array(mysql_query($sql1));  
$jumlah = $data1[0];	



//$sql1 = "select IFNULL(sum(costprice),0) jml from sektorcostdtl a, sektorcosthdr b
//where a.sektorcosthdr_idsektorcosthdr = b.idsektorcosthdr and 
//a.rabmst_idrabmst = '$idrabmst' and b.sektor_idsektor = '$sektor_idsektor' "; 
//$data1  = mysql_fetch_array(mysql_query($sql1));  
//$jumlah = $data1[0];	 


$totalacc = $totalacc + $jumlah;

 $pdf->cell(10,$rh,$no,1,0,'L',0); 
 $pdf->cell(70,$rh,$rabdesc,1,0,'L',0); 
$pdf->cell(15,$rh,nf($row['volume']),1,0,'R',0); 
$pdf->cell(20,$rh,nf($row['hargasat']),1,0,'R',0); 
$pdf->cell(25,$rh,nf($total),1,0,'R',0); 
$pdf->cell(25,$rh,nf($jumlah),1,0,'R',0); 

 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 

$totalallcat = $totalallcat + $total;
$totalallacc = $totalallacc + $jumlah;
 }
$pdf->cell(115,$rh,'Total '.$row0['rabcatname'],1,0,'L',0);  
$pdf->cell(25,$rh,nf($totalcat),1,0,'R',0);  
$pdf->cell(25,$rh,nf($totalacc),1,0,'R',0);  
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);


}  
$pdf->cell(115,$rh,'Total RAB Sektor ',1,0,'L',0);  
$pdf->cell(25,$rh,nf($totalallcat),1,0,'R',0);  
$pdf->cell(25,$rh,nf($totalallacc),1,0,'R',0);  

#output file PDF 
$pdf->Output(); 
?> 
