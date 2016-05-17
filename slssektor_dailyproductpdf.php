<?php 
require("fpdf.php"); 
require_once "config.php"; 
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
$idsektor = $_GET['idsektor'];

//$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//$pdf = new FPDF('P','mm',array(100,150));
//Disable automatic page break
$pdf->SetAutoPageBreak(true);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 0;
$x = 0;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #16, =null, =null, =0, =0, varchar(5)='', ='') 
$pdf->image('./images/logo.png',30,15,145,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+20;
$pdf->SetY($yx);
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')

$pdf->SetY($yx);
$pdf->cell(120,$rh,'Rekap Pengeluaran Barang ke '.$idsektor.' Per Tanggal '.gettanggal($startdate).' s/d '.gettanggal($enddate),0,0,'L',0); 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',8);
//buat header tabel//
 $pdf->cell(10,$rh,'No',1,0,'C',0); 
 $pdf->cell(15,$rh,'Kode',1,0,'C',0);
 $pdf->cell(65,$rh,'Nama Barang',1,0,'C',0);
 $pdf->cell(10,$rh,'Jumlah',1,0,'C',0);
 $pdf->cell(20,$rh,'Beli (Rp)',1,0,'C',0);
 $pdf->cell(20,$rh,'Jual (Rp)',1,0,'C',0);
 $pdf->cell(20,$rh,'Margin (Rp)',1,0,'C',0);
 $pdf->cell(10,$rh,'(%)',1,0,'C',0);

 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);

if ($idsektor == '%') {
$sql="SELECT product_idproduct,sum(qty) qty,sum(sales_price * qty) jumlah FROM slsdtlsektor a, slshdrsektor b  
where a.slshdrsektor_idslshdr = b.idslshdr and 
b.sls_date between '$startdate' and '$enddate'  group by product_idproduct ";
} else {
$sql="SELECT product_idproduct,sum(qty) qty,sum(sales_price * qty) jumlah FROM slsdtlsektor a, slshdrsektor b  
where a.slshdrsektor_idslshdr = b.idslshdr and 
b.sls_date between '$startdate' and '$enddate'  and 
sektor_idsektor = '$idsektor'  group by product_idproduct ";
	
}

//$sql = "select distinct supplier_idsupp from receivehdr where rcv_date between '$startdate' and '$enddate' order by supplier_idsupp"; 
$result = mysql_query($sql);


$no=1;  
$i=0;
$max =40;  
$hal = 1;
$alltotal =0; $alltotal1 =0; $alltotal2 =0;
while($row = mysql_fetch_array($result)) { 
$product = productinfo($row['product_idproduct']);
  			$productname = $product['productname'];
  			$beli = $product['costprice'];
  			$vbeli = $beli * $row['qty'];
  			$vmargin = $row['jumlah']- $vbeli;


$data2  = mysql_fetch_array(mysql_query($sql2));  
$mrcv = $data2[0];	
 
$pdf->cell(10,$rh,$no,1,0,'R',0); 
$pdf->cell(15,$rh,$row['product_idproduct'],1,0,'L',0); 
$pdf->cell(65,$rh,$productname,1,0,'L',0); 
$pdf->cell(10,$rh,$row['qty'],1,0,'R',0);
$pdf->cell(20,$rh,nf($row['jumlah']),1,0,'R',0);
$pdf->cell(20,$rh,nf($vbeli),1,0,'R',0);
$pdf->cell(20,$rh,nf($vmargin),1,0,'R',0);
$pdf->cell(10,$rh,nf($vmargin/$vbeli*100),1,0,'R',0);
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$no=$no+1; 
$i=$i+1;
$alltotal = $alltotal + $row['jumlah'];
$alltotal1 = $alltotal1 + $vjual;
$alltotal2 = $alltotal2 + $vmargin;

 } 
$pdf->cell(100,$rh,'Total',1,0,'R',0); 
$pdf->cell(20,$rh,nf($alltotal),1,0,'R',0); 
$pdf->cell(20,$rh,nf($alltotal1),1,0,'R',0); 
$pdf->cell(20,$rh,nf($alltotal2),1,0,'R',0);  
$pdf->cell(10,$rh,'',1,0,'R',0);
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$pdf->cell(180,$rh,'Halaman '.$hal,0,0,'R',0); 
#output file PDF 
$pdf->Output(); 
?> 
