<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
$idsupplier = $_GET['idsupp'];


$sql = "select distinct supplier_idsupp from receivehdrsektor where rcv_date between '$startdate' and '$enddate' and supplier_idsupp like '%$isupplier%' order by supplier_idsupp"; 

//$sql = "select distinct supplier_idsupp from receivehdr"; 


$result = mysql_query($sql); 
?> 
	 
  <table id="receivehdr" width=500px> 
  
<p class="judul"> Rekap Nilai Penerimaan Barang Per Supplier</p>
<tr> 
<th>Kode</th>
<th>Nama Supplier</th>
<th>Total Tagihan</th>
  </tr> 
		<?php 
		//menampilkan data receivehdr 
		if(mysql_num_rows($result)!=0){ $alltotal =0;
  		while($row = mysql_fetch_array($result)){
  $idsupp = $row['supplier_idsupp'];			
$supplier = supplierinfo($row['supplier_idsupp']) ; 

$sql2="SELECT sum(receive_price * qty) vreceive FROM receivedtlsektor a, receivehdrsektor b  
where a.receivehdrsektor_idreceivehdr = b.idreceivehdr and 
b.rcv_date between '$startdate' and '$enddate' and 
supplier_idsupp = '$idsupp' group by supplier_idsupp";

$data2  = mysql_fetch_array(mysql_query($sql2));  
$mrcv = $data2[0];	

			
 ?>		 
 <tr> 
 <td><? echo $row['supplier_idsupp'];?></td>
<td><? echo $supplier['suppname'];?></td>
<td class="right"><? echo nf($mrcv);?></td>
 </tr> 
  		<?  
$alltotal = $alltotal + $mrcv;  		
  		
  		} //end while ?> 
		 <tr id="nav"><td colspan=2>Total</td><td class="right"><? echo nf($alltotal);?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="10">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
