<?php 
require("fpdf.php"); 
require_once "config.php"; 

$idsektor = $_GET['sektor'];
$idrabmst = $_GET['rabmst'];
$idrabcat = $_GET['rabcat'];
$txn = $_GET['txn'];
$startdate = settanggal($_GET['start']);
$enddate = settanggal($_GET['end']);


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
$yx = $pdf->getY()+15;
$pdf->SetY($yx);
$pdf->text($x,$yx,'Daftar Pengeluaran RAB Sektor '.$idsektor);
$yx =$pdf->getY()+$rh; $pdf->SetY($yx);
$pdf->SetFont('Arial','B',12);

if ($idsektor == '%') { 
if ($_GET['start'] =='') {
$sql = "select  distinct rabcat_idrabcat from sektorrabtxn a, rabmst b 
where a.rabmst_idrabmst = b.idrabmst and rabmst_idrabmst like '%$idrabmst%' 
and rabcat_idrabcat like '%$idrabcat%'
and txndesc like '%$txn%'  
order by rabmst_idrabmst,txndate desc"; 
} else {
$sql = "select  distinct rabcat_idrabcat from sektorrabtxn a, rabmst b 
where a.rabmst_idrabmst = b.idrabmst and rabmst_idrabmst like '%$idrabmst%' 
and rabcat_idrabcat like '%$idrabcat%'
and txndesc like '%$txn%'
and txndate between '$startdate' and '$enddate'   
order by rabmst_idrabmst,txndate desc"; 
}

} else {
	
if ($_GET['start'] =='') {
	
$sql = "select distinct rabcat_idrabcat from sektorrabtxn  a, rabmst b where a.rabmst_idrabmst = b.idrabmst and sektor_idsektor = '$idsektor' 
and rabcat_idrabcat like '%$idrabcat%'
and rabmst_idrabmst like '%$idrabmst%'
and txndesc like '%$txn%' 
order by rabmst_idrabmst,txndate desc "; 
} else {
	
$sql = "select  distinct rabcat_idrabcat from sektorrabtxn  a, rabmst b where a.rabmst_idrabmst = b.idrabmst and sektor_idsektor = '$idsektor' 
and rabcat_idrabcat like '%$idrabcat%'
and rabmst_idrabmst like '%$idrabmst%'
and txndesc like '%$txn%' 
and txndate between '$startdate' and '$enddate'   
order by rabmst_idrabmst,txndate desc "; 
}
}



$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
  
 $rowrabcat = $row['rabcat_idrabcat']; 
 $rabcat = rabcatinfo($row['rabcat_idrabcat']);
 $rabcatname = $rabcat['rabcatname']; 

$pdf->cell(30,$rh,$rabcatname,0,0,'L',0); 
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$yx =$pdf->getY()+$rh; $pdf->SetY($yx); 
 
 
if ($idsektor == '%') { 
if ($_GET['start'] =='') {
$sql1 = "select distinct rabmst_idrabmst from sektorrabtxn a, rabmst b 
where a.rabmst_idrabmst = b.idrabmst and rabmst_idrabmst like '%$idrabmst%' 
and rabcat_idrabcat = '$rowrabcat'
and txndesc like '%$txn%'  
order by rabmst_idrabmst,txndate desc"; 
} else {
$sql1 = "select distinct rabmst_idrabmst from sektorrabtxn a, rabmst b 
where a.rabmst_idrabmst = b.idrabmst and rabmst_idrabmst like '%$idrabmst%' 
and rabcat_idrabcat  = '$rowrabcat'
and txndesc like '%$txn%'
and txndate between '$startdate' and '$enddate'   
order by rabmst_idrabmst,txndate desc"; 
}

} else {
	
if ($_GET['start'] =='') {
	
$sql1 = "select distinct rabmst_idrabmst from sektorrabtxn  a, rabmst b where a.rabmst_idrabmst = b.idrabmst and sektor_idsektor = '$idsektor' 
and rabcat_idrabcat  = '$rowrabcat'
and rabmst_idrabmst like '%$idrabmst%'
and txndesc like '%$txn%' 
order by rabmst_idrabmst,txndate desc "; 
} else {
	
$sql1 = "select  distinct rabmst_idrabmst from sektorrabtxn  a, rabmst b where a.rabmst_idrabmst = b.idrabmst and sektor_idsektor = '$idsektor' 
and rabcat_idrabcat  = '$rowrabcat'
and rabmst_idrabmst like '%$idrabmst%'
and txndesc like '%$txn%' 
and txndate between '$startdate' and '$enddate'   
order by rabmst_idrabmst,txndate desc "; 
}
}

$result1 = mysql_query($sql1); 
$i1=1;  
$no=1;  
$max =21;  
 while($row1 = mysql_fetch_array($result1)) {  
$rowrabmst = $row1['rabmst_idrabmst'];
$rabmst = rabmstinfo($rowrabmst);
$rabdesc = $rabmst['rabdesc']; 
 
 $pdf->cell(30,$rh,$rabcatname.'-->'.$rabdesc,0,0,'L',0); 
 $yx =$pdf->getY()+$rh;$pdf->SetY($yx);

 
if ($idsektor == '%') { 
if ($_GET['start'] =='') {
$sql2 = "select * from sektorrabtxn a, rabmst b 
where a.rabmst_idrabmst = b.idrabmst 
and rabmst_idrabmst  = '$rowrabmst'  
and rabcat_idrabcat = '$rowrabcat'
and txndesc like '%$txn%'  
order by rabmst_idrabmst,txndate desc"; 
} else {
$sql2 = "select * from sektorrabtxn a, rabmst b 
where a.rabmst_idrabmst = b.idrabmst 
and rabmst_idrabmst = '$rowrabmst' 
and rabcat_idrabcat  = '$rowrabcat'
and txndesc like '%$txn%'
and txndate between '$startdate' and '$enddate'   
order by rabmst_idrabmst,txndate desc"; 
}

} else {
	
if ($_GET['start'] =='') {
	
$sql2 = "select * from sektorrabtxn  a, rabmst b where a.rabmst_idrabmst = b.idrabmst and sektor_idsektor = '$idsektor' 
and rabcat_idrabcat  = '$rowrabcat'
and rabmst_idrabmst  = '$rowrabmst' 
and txndesc like '%$txn%' 
order by rabmst_idrabmst,txndate desc "; 
} else {
	
$sql2 = "select  * from sektorrabtxn  a, rabmst b where a.rabmst_idrabmst = b.idrabmst and sektor_idsektor = '$idsektor' 
and rabcat_idrabcat  = '$rowrabcat'
and rabmst_idrabmst  = '$rowrabmst' 
and txndesc like '%$txn%' 
and txndate between '$startdate' and '$enddate'   
order by rabmst_idrabmst,txndate desc "; 
}
}

$result2 = mysql_query($sql2); 
$i2=1;  
$no=1;  
$max =21;  
$total = 0;
 while($row2 = mysql_fetch_array($result2)) {  
 
 
$pdf->cell(15,$rh,$row2['idtxn'],1,0,'L',0); 
//$pdf->cell(15,$rh,$i,1,0,'L',0); 
$pdf->cell(25,$rh,gettanggal($row2['txndate']),1,0,'L',0); 
$pdf->cell(100,$rh,$row2['txndesc'],1,0,'L',0); 
$pdf->cell(30,$rh,nf($row2['txnvalue']),1,0,'R',0); 
 
$yx =$pdf->getY()+$rh;$pdf->SetY($yx);

$i2++;
$i = $i+1;
$total = $total + $row2['txnvalue'];
}
$pdf->cell(140,$rh,'Total',1,0,'L',0); 
$pdf->cell(30,$rh,nf($total),1,0,'R',0); 

 
$yx =$pdf->getY()+$rh+6; $pdf->SetY($yx);

$i1++;
$i=$i+1;
}

$yx =$pdf->getY()+$rh; $pdf->SetY($yx);
$i=$i+1;
$no++; 
} 
#output file PDF 
$pdf->Output(); 
?> 
