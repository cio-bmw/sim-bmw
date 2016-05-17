<?php 
require("fpdf.php"); 
require_once "config.php"; 
$id = $_GET['id'];
//Create new pdf file
$pdf=new FPDF();
//$pdf = new FPDF('P','mm',array(100,150));
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
//Add first L landscape P portrait page
$pdf->AddPage('P');
//set initial y axis position per page
$y = 0;
$x = 0;
$rh = 6;
$pdf -> SetMargins(30,30);
//    Image(Resource id #16, =null, =null, =0, =0, varchar(5)='', ='') 
$pdf->image('./images/logo.png',$x,$y,150,20);
$pdf->SetFont('helvetica','B',14);
$yx = $pdf->getY()+40;
$pdf->SetY($yx);
$pdf->text($x,$yx,'Daftar receivehdr');
$pdf->SetFont('helvetica','B',10);
$yx = $pdf->getY()+$rh;
///function Cell($w, $h=0, $txt='', =0, =0, ='', =false, ='')
$pdf->SetFillColor(236,147,109);
$pdf->SetFont('helvetica','B',12);
$pdf->SetY($yx);
//buat header tabel//
 $pdf->cell(30,$rh,idreceivehdr,1,0,'C',0); 
$pdf->cell(30,$rh,supplier_idsupp,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_date,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_bon,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_titip,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_desc,1,0,'C',0); 
$pdf->cell(30,$rh,due_date,1,0,'C',0); 
$pdf->cell(30,$rh,paid_date,1,0,'C',0); 
$pdf->cell(30,$rh,faktur,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_bayar,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_status,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_diskon,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_totprice,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_totdiskon,1,0,'C',0); 
$pdf->cell(30,$rh,rcv_totppn,1,0,'C',0); 
$pdf->cell(30,$rh,emp_idemp,1,0,'C',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$sql = " select idreceivehdr,supplier_idsupp,rcv_date,rcv_bon,rcv_titip,rcv_desc,due_date,paid_date,faktur,rcv_bayar,rcv_status,rcv_diskon,rcv_totprice,rcv_totdiskon,rcv_totppn,emp_idemp from receivehdr"; 
$result = mysql_query($sql); 
$i=1;  
$no=1;  
$max =21;  
 while($row = mysql_fetch_array($result)) { 
 $pdf->cell(30,$rh,$row['idreceivehdr'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['supplier_idsupp'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_date'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_bon'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_titip'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_desc'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['due_date'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['paid_date'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['faktur'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_bayar'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_status'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_diskon'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_totprice'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_totdiskon'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['rcv_totppn'],1,0,'L',0); 
$pdf->cell(30,$rh,$row['emp_idemp'],1,0,'L',0); 
 
$yx =$pdf->getY()+$rh; 
$pdf->SetY($yx);
$i++;
$no++; 
 } 
#output file PDF 
$pdf->Output(); 
?> 
