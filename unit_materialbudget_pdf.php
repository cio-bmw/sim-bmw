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
$y = 0;
$x = 20;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #17, =null, =null, =0, =0, varchar(50)='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',16);
$yr= $pdf->getY()+12; $pdf->setY($yr);$pdf->SetX($x);
$pdf->cell(180,$rh,'Rencana Anggaran Belanja Unit',0,0,'C',0); 

 $yr= $pdf->getY()+$rh+3; $pdf->setY($yr);$pdf->SetX($x);

$pdf->SetFont('helvetica','B',11);
$unit = unitinfo($id);
$idsektor = $unit['sektor_idsektor'];
$sektor = sektorinfo($idsektor);
$sektorname= $sektor['sektorname'];

$kavling = $unit['kavling'];

$pdf->cell(50,$rh,'Sektor : '.$sektorname,0,0,'L',0); 
$pdf->cell(30,$rh,'Kavling : '.$kavling,0,0,'L',0); 

///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('Arial','',10);
 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
//buat header tabel//
$pdf->cell(10,$rh,No,1,0,'C',0);
$pdf->cell(20,$rh,'Kode',1,0,'C',0); 
$pdf->cell(80,$rh,'Nama Barang',1,0,'C',0); 
$pdf->cell(20,$rh,'Budget',1,0,'C',0); 
$pdf->cell(20,$rh,'Progress',1,0,'C',0); 


 
$yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
$sql = " select idbudget,budget_qty,progress_qty,unit_idunit,product_idproduct from unit_materialbudget a, product b  where unit_idunit='$id' and a.product_idproduct = b.idproduct order by productname ";
 
$result = mysql_query($sql);

$i=1;  
$no=1;  
$max =40;  
 while($row = mysql_fetch_array($result)) { 
$product = productinfo($row['product_idproduct']);
$productname = $product['productname'];
$harga = $product['salesprice'];
$jumlah = $harga * $row['budget_qty'];


if ($i > $max ) {
$i =1;
$pdf->AddPage('P');
$yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
$pdf->cell(10,$rh,No,1,0,'C',0);
$pdf->cell(20,$rh,'Kode',1,0,'C',0); 
$pdf->cell(80,$rh,'Nama Barang',1,0,'C',0); 
$pdf->cell(20,$rh,'Budget',1,0,'C',0); 
$pdf->cell(20,$rh,'Progress',1,0,'C',0); 

$yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);	
	
	
}

$pdf->cell(10,$rh,$no,1,0,'L',0); 
$pdf->cell(20,$rh,$row['product_idproduct'],1,0,'L',0); 
$pdf->cell(80,$rh,$productname,1,0,'L',0); 
$pdf->cell(20,$rh,$row['budget_qty'],1,0,'R',0); 
$pdf->cell(20,$rh,'',1,0,'R',0); 

 
 $yr= $pdf->getY()+$rh; $pdf->setY($yr);$pdf->SetX($x);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
