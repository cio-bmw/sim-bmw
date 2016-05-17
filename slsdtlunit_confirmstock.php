	
<?php 

include_once('config.php'); 
$id = $_GET['id'];
$idsektor = $_GET['sektor']; 


$sql = "select * from slshdrunit where idslshdr = '$id'";
$result = mysql_query($sql);
$datahdr = mysql_fetch_array($result);
$status = $datahdr['sls_status'];
$idslshdr = $datahdr['idslshdr'];

if ($status=='confirm') {
echo "<script> alert('Data sudah pernah di Konfirmasi. Tidak ada update stock '); </script>";	
}

else {
$sqlc = "update slshdrunit set sls_status='confirm' where idslshdr ='".$id."'";
$confirm = mysql_query($sqlc);		
	
$sqld = "select * from slsdtlunit where slshdrunit_idslshdr = '$id'";
$resultd = mysql_query($sqld);
while($row = mysql_fetch_array($resultd)){


$qty = $row['qty'];
$product_idproduct = $row['product_idproduct'];
$receivehdrunit_idreceivehdr = $idreceivehdr;
$receive_price = $row['sales_price'];


$sqlunitstok = "update sektorstok set qty = qty-'$qty' where product_idproduct = '".$product_idproduct."' and sektor_idsektor='$idsektor'";
$updstoksektor = mysql_query($sqlunitstok);
echo $sqlunitstok;

}	 

echo "<script> alert('Konfirmasi dan proses update stok unit selesai'); </script>";
}

?>  		
<script>
window.close();
 </script>		