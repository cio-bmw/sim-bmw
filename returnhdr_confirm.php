<?
include_once("config.php"); 
$id=$_GET['id'];

$sqlh ="select return_status from returnhdr where idreturnhdr ='$id'";
$resulth= mysql_query($sqlh);
$data = mysql_fetch_array($resulth);
$status = $data['return_status'];

if ($status=='confirm') {
echo "<script> alert('Data sudah pernah di Konfirmasi. Tidak ada update stock '); </script>";	
}	
else {	
$sqlc = "update returnhdr set return_status='confirm' where idreturnhdr ='".$id."'";
$confirm = mysql_query($sqlc);	

$result=mysql_query("select * from returndtl where returnhdr_idreturnhdr = '$id'");
while($row = mysql_fetch_array($result)){
	
$product = $row['product_idproduct'];
$qty = $row['qty'];
$sql1 = "update product set stock = stock+$qty where idproduct = '".$product."'";
$stock = mysql_query($sql1); 

//echo $product.' jumahnya ;',$qty;

}
echo "<script> alert('Konfirmasi dan proses update record selesai'); </script>";
}
?>
<script> window.close(); </script>
