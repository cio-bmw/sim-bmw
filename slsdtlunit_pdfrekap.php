<?php 
require("fpdf.php"); 
require_once "config.php"; 
$idunit = $_GET['id']; 

$unit = unitinfo($idunit);
$kavling = $unit['kavling'];
$idsektor = $unit['sektor_idsektor'];
$tipe = $unit['tipe'];
$lt = $unit['luastanah'];


$sektor = sektorinfo($idsektor);
$sektorname= $sektor['sektorname'];

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
//    Image(Resource id #17, =null, =null, =0, =0, varchar(50)='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+15;
$pdf->SetY($yx);
 $pdf->cell(130,$rh,'Rekap Pengeluaran Material Ke unit',0,0,'C',0); 

$pdf->SetFont('helvetica','B',10);
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','',10);

$yx =$pdf->getY()+$rh; $pdf->SetY($yx);
 $pdf->cell(10,$rh,'Sektor :'.$sektorname.'   Unit/Kavling : '.$idunit.'/'.$kavling.'  Tipe : '.$tipe    ,0,0,'L',0); 
$yx =$pdf->getY()+$rh; $pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(10,$rh,No,1,0,'C',0); 
$pdf->cell(20,$rh,'Kode',1,0,'C',0); 
$pdf->cell(65,$rh,'Nama Barang',1,0,'C',0); 
$pdf->cell(15,$rh,'Progres',1,0,'C',0); 
$pdf->cell(15,$rh,'Budget',1,0,'C',0); 
$pdf->cell(30,$rh,'Total Progress',1,0,'C',0); 
$pdf->cell(30,$rh,'Total Budget',1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; $pdf->SetY($yx);

$sql = "select sum(qty) qty, sum(qty*sales_price) harga, product_idproduct,unit_idunit from slsdtlunit a, slshdrunit b, product c where a.product_idproduct = c.idproduct 
and a.slshdrunit_idslshdr = b.idslshdr and  b.unit_idunit = '$idunit' group by product_idproduct order by productname"; 




$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 
if ($i == 40) {
	$pdf->AddPage('P');
	//buat header tabel//
 $pdf->cell(10,$rh,No,1,0,'C',0); 
$pdf->cell(20,$rh,'Kode',1,0,'C',0); 
$pdf->cell(65,$rh,'Nama Barang',1,0,'C',0); 
$pdf->cell(15,$rh,'Progres',1,0,'C',0); 
$pdf->cell(15,$rh,'Budget',1,0,'C',0); 
$pdf->cell(30,$rh,'Total Progress',1,0,'C',0); 
$pdf->cell(30,$rh,'Total Budget',1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; $pdf->SetY($yx);
$i=1;
	
	} 
 
 
   $idproduct = 	$row['product_idproduct'];
  		$product = productinfo($row['product_idproduct']);
  		$productname = $product['productname'];	
      $unit_idunit = $row['unit_idunit'];

       $resultb=mysql_query("select IFNULL(budget_qty,0) qty, sum(price*budget_qty) hargab  from unit_materialbudget where product_idproduct = '$idproduct' and unit_idunit='$unit_idunit'" );
       $datab  = mysql_fetch_array($resultb);  
       $budgetqty=$datab[0];
       $hargab=$datab[1];
       

$pdf->cell(10,$rh,$no,1,0,'L',0); 
$pdf->cell(20,$rh,$row['product_idproduct'],1,0,'L',0); 
$pdf->cell(65,$rh,$productname,1,0,'L',0); 

$pdf->cell(15,$rh,nf($row['qty']),1,0,'R',0); 
$pdf->cell(15,$rh,nf($budgetqty),1,0,'R',0); 
$pdf->cell(30,$rh,nf($row['harga']),1,0,'R',0); 
$pdf->cell(30,$rh,nf($hargab),1,0,'R',0); 

 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
$total = $total + $row['harga'];
       $totalb = $totalb + $hargab;   
 } 
 $pdf->cell(125,$rh,'Total',1,0,'L',0);
 $pdf->cell(30,$rh,nf($total),1,0,'R',0);
  $pdf->cell(30,$rh,nf($totalb),1,0,'R',0);
 
#output file PDF 
$pdf->Output(); 
?> 
