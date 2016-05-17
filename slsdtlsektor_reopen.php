	
<?php 

include_once('config.php'); 
$id = $_GET['id']; 


$sql = "select * from slshdrsektor where idslshdr = '$id'";
$result = mysql_query($sql);
$datahdr = mysql_fetch_array($result);
$status = $datahdr['sls_status'];
$idslshdr = $datahdr['idslshdr'];

if ($status=='open') {
echo "<script> alert('Data belum pernah di Konfirmasi. Tidak ada update stock '); </script>";	
}

else {
$sqlc = "update slshdrsektor set sls_status='open' where idslshdr ='".$id."'";
$confirm = mysql_query($sqlc);		
	

//$sql0 = "SELECT IFNULL(max(idreceivehdr),0)+1  FROM receivehdrsektor";
//$result0 = mysql_query($sql0);
//$data  = mysql_fetch_array($result0);
//$idreceivehdr = $data[0];	


$supplier_idsupp='00';
$rcv_date = date('Y-m-d');
$rcv_desc = 'Transfer dari Dok no : '.$idslshdr;
$faktur = $datahdr['faktur'];
$sektor = $datahdr['sektor_idsektor'];

//$sql="insert into receivehdrsektor (sektor_idsektor,idreceivehdr,supplier_idsupp,rcv_date,rcv_desc,faktur) 
//values ('$sektor','$idreceivehdr','$supplier_idsupp','$rcv_date','$rcv_desc','$faktur')";
//$inserthdr = mysql_query($sql);

//insert detail 

$sqld = "select * from slsdtlsektor where slshdrsektor_idslshdr = '$id'";
$resultd = mysql_query($sqld);
while($row = mysql_fetch_array($resultd)){

//$sqldtl = "SELECT IFNULL(max(idreceivedtl),0)+1  FROM receivedtlsektor";  
//$resultdtl = mysql_query($sqldtl);  
//$datadtl  = mysql_fetch_array($resultdtl);  
//$idreceivedtl = $datadtl[0];	 	

$qty = $row['qty'];
$product_idproduct = $row['product_idproduct'];
$receivehdrsektor_idreceivehdr = $idreceivehdr;
$receive_price = $row['sales_price'];

//$sqld=" insert into receivedtlsektor (idreceivedtl,qty,receive_price,dtl_ppn,receive_priceppn,receive_pricedisc,dtl_percent,dtl_discount,batch_no,exp_date,receivehdrsektor_idreceivehdr,product_idproduct)  values  ('$idreceivedtl','$qty','$receive_price','$dtl_ppn','$receive_priceppn','$receive_pricedisc','$dtl_percent','$dtl_discount','$batch_no','$exp_date','$receivehdrsektor_idreceivehdr','$product_idproduct')";  
//$insertdtl=mysql_query($sqld);

//check product di sektorstok
$sqlcs = "select count(*) jumlah from sektorstok where product_idproduct = '".$product_idproduct."' and sektor_idsektor='$sektor'";
$resultcs = mysql_query($sqlcs);
$datacs = mysql_fetch_array($resultcs);
$jmlstok = $datacs['jumlah'];


if ($jmlstok > 0) {
//	echo "<script> alert('stok sdh ada akan diupdate'); </script>";
$sqlsektorstok = "update sektorstok set qty = qty-'$qty' where product_idproduct = '".$product_idproduct."' and sektor_idsektor='$sektor'";
$updstoksektor = mysql_query($sqlsektorstok);
} else {

//echo "<script> alert('stok sektor blm ada mau insert'); </script>";	
	
$sql = "SELECT IFNULL(max(idsektorstok),0)+1  FROM sektorstok";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idsektorstok = $data[0];	 	
	
$sqlsektorstok = "insert into sektorstok (idsektorstok,qty,sektor_idsektor,product_idproduct)  values  ('$idsektorstok','$qty','$sektor','$product_idproduct')";

//echo 'test = '.$sqlsektorstok;

$updstoksektor = mysql_query($sqlsektorstok);
}

$sqlstock = "update product set stock = stock+'$qty' where idproduct = '".$product_idproduct."'";
$updstok = mysql_query($sqlstock);

}	 

echo "<script> alert('Pembatalan Konfirmasi dan proses update stok sektor selesai'); </script>";
}

?>  		
<script> 
window.close();
</script>		