<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];
//Create new pdf file
//$pdf=new FPDF();
$pdf = new FPDF('P','mm',array(210,200));
//Disable automatic page break
$pdf->SetAutoPageBreak(true);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 0;
$x = 20;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #16, =null, =null, =0, =0, date='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+15;
$pdf->SetY($yx);$pdf->SetX($x);
$pdf->text($x,$yx,'PENERIMAAN BARANG DI GUDANG BESAR');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;$pdf->SetY($yx);$pdf->SetX($x);

$sqlh = "select * from receivehdr where idreceivehdr='$id'"; 
$resulth = mysql_query($sqlh); 
$data  = mysql_fetch_array($resulth);  
$idsupp = $data['supplier_idsupp'];

$pdf->cell(20,$rh,'No',0,0,'L',0); 
$pdf->cell(70,$rh,': '.$data['idreceivehdr'],0,0,'L',0); 

$pdf->cell(20,$rh,'Tanggal',0,0,'L',0); 
$pdf->cell(70,$rh,': '.gettanggal($data['rcv_date']),0,0,'L',0); 
$yx = $pdf->getY()+$rh;$pdf->SetY($yx);$pdf->SetX($x);

$pdf->cell(20,$rh,'Supplier',0,0,'L',0); 
$pdf->cell(70,$rh,': '.$data['supplier_idsupp'],0,0,'L',0); 

$pdf->cell(20,$rh,'Faktur',0,0,'L',0); 
$pdf->cell(70,$rh,': '.$data['faktur'],0,0,'L',0); 
$yx = $pdf->getY()+$rh;$pdf->SetY($yx);$pdf->SetX($x);


///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',9);
$pdf->SetY($yx);$pdf->SetX($x);
//buat header tabel//
$pdf->cell(10,$rh,'No',1,0,'C',0); 
$pdf->cell(15,$rh,'Kode',1,0,'C',0); 
$pdf->cell(100,$rh,'Nama Barang',1,0,'C',0); 

$pdf->cell(10,$rh,'Qty',1,0,'C',0); 
$pdf->cell(20,$rh,'Harga',1,0,'C',0); 
$pdf->cell(20,$rh,'Total',1,0,'C',0); 

$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);$pdf->SetX($x);
$sql = " select idreceivedtl,product_idproduct,qty,receive_price from receivedtl where receivehdr_idreceivehdr='$id'"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
$alltotal =0;
 while($row = mysql_fetch_array($result)) {
$product = productinfo($row['product_idproduct']);
$productname = $product['productname']; 	
$total = $row['qty'] * $row['receive_price'];


$pdf->cell(10,$rh,$no,1,0,'L',0); 
$pdf->cell(15,$rh,$row['product_idproduct'],1,0,'L',0); 
$pdf->cell(100,$rh,$productname,1,0,'L',0); 
$pdf->cell(10,$rh,nf($row['qty']),1,0,'R',0); 
$pdf->cell(20,$rh,nf($row['receive_price']),1,0,'R',0); 
$pdf->cell(20,$rh,nf($total),1,0,'R',0); 

 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);$pdf->SetX($x);
$i++;
$no++; 
$alltotal = $alltotal + $total;
} 
$pdf->cell(175,$rh,nf($alltotal),1,0,'R',0);  
 
#output file PDF 
$pdf->Output(); 
?> 
