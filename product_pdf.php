<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 5;
$x = 15;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #16, =null, =null, =0, =0, int(11)='', ='') 
$pdf->image('./images/logo.png',$x,$y,100,10);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+12;
$pdf->SetY($yx);$pdf->setX($x);
$pdf->text($x,$yx,'DAFTAR BARANG');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',8);
$pdf->SetY($yx); $pdf->setX($x);
//buat header tabel//
 $pdf->cell(15,$rh,'KODE',1,0,'C',0); 
$pdf->cell(75,$rh,'NAMA BARANG',1,0,'C',0); 
$pdf->cell(20,$rh,'JUAL',1,0,'C',0); 
$pdf->cell(20,$rh,'BELI',1,0,'C',0); 
$pdf->cell(20,$rh,'STOK',1,0,'C',0); 
$pdf->cell(20,$rh,'LIMIT',1,0,'C',0); 
 

$sql = " select idproduct,productname,uom_iduom,category_idcat,supplier_idsupp,location_idlocation,salesprice,costprice,stock,stockwh,limitstock,limitstockwh,status,active,boxqty from product"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =40;  
 while($row = mysql_fetch_array($result)) { 
 
 if ($i==$max) {
$pdf->AddPage('P');     
$pdf->image('./images/logo.png',$x,$y,100,10);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY();
$pdf->SetY($yx);$pdf->setX($x);
$pdf->text($x,$yx,'DAFTAR BARANG');
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);$pdf->setX($x); 
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',8);
$pdf->setX($x);
$pdf->cell(15,$rh,'KODE',1,0,'C',0); 
$pdf->cell(75,$rh,'NAMA BARANG',1,0,'C',0); 
$pdf->cell(20,$rh,'JUAL',1,0,'C',0); 
$pdf->cell(20,$rh,'BELI',1,0,'C',0); 
$pdf->cell(20,$rh,'STOK',1,0,'C',0); 
$pdf->cell(20,$rh,'LIMIT',1,0,'C',0); 
 $pdf->setX($x);
   	
   $i = 1;
   	
}
 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);$pdf->setX($x); 
 
 
$pdf->cell(15,$rh,$row['idproduct'],1,0,'L',0); 
$pdf->cell(75,$rh,$row['productname'],1,0,'L',0); 
$pdf->cell(20,$rh,$row['salesprice'],1,0,'R',0); 
$pdf->cell(20,$rh,$row['costprice'],1,0,'R',0); 
$pdf->cell(20,$rh,$row['stock'],1,0,'R',0); 
$pdf->cell(20,$rh,$row['limitstock'],1,0,'R',0); 
 

$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
