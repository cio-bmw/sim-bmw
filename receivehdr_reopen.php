<?
include_once("config.php"); 
$id=$_GET['id'];

$sqlh ="select rcv_status from receivehdr where idreceivehdr ='$id'";
$resulth= mysql_query($sqlh);
$data = mysql_fetch_array($resulth);
$status = $data['rcv_status'];

if ($status=='open') {
echo "<script> alert('Data belum pernah di Konfirmasi. Tidak ada update stock '); </script>";	
}	
else {	
$sqlc = "update receivehdr set rcv_status='open' where idreceivehdr ='".$id."'";
$confirm = mysql_query($sqlc);	

$result=mysql_query("select * from receivedtl where receivehdr_idreceivehdr = '$id'");
while($row = mysql_fetch_array($result)){
	
$product = $row['product_idproduct'];
$qty = $row['qty'];
$sql1 = "update product set stock = stock-$qty where idproduct = '".$product."'";
$stock = mysql_query($sql1); 

//echo $product.' jumahnya ;',$qty;

}
echo "<script> alert('Pembatalan Konfirmasi dan proses update record selesai'); </script>";
}
?>
<script> window.close(); </script>
