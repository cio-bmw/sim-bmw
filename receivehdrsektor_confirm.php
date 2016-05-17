<?
include_once("config.php"); 
$id=$_GET['id'];

$sqlh ="select * from receivehdrsektor where idreceivehdr ='$id'";
$resulth= mysql_query($sqlh);
$data = mysql_fetch_array($resulth);
$status = $data['rcv_status'];
$sektor = $data['sektor_idsektor'];


if ($status=='confirm') {
echo "<script> alert('Data sudah pernah di Konfirmasi. Tidak ada update stock '); </script>";	
}

else {
$sqlc = "update receivehdrsektor set rcv_status='confirm' where idreceivehdr ='".$id."'";
$confirm = mysql_query($sqlc);	

$sql= "select * from receivedtlsektor where receivehdrsektor_idreceivehdr = '".$id."'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)){

$product = $row['product_idproduct'];
$qty = $row['qty'];
$price=$row['receive_price'];

$sqls = "SELECT IFNULL(max(idsektorstok),0)+1  FROM sektorstok";  
$results = mysql_query($sqls);  
$datas  = mysql_fetch_array($results);  
$idsektorstok = $datas[0];	 


$sqlc ="select count(*) jml from sektorstok where sektor_idsektor = '$sektor' and product_idproduct = '$product'";
$resultc= mysql_query($sqlc);
$datac = mysql_fetch_array($resultc);
$jumlah = $datac['jml'];


if ($jumlah==0) {
$sql1 =" insert into sektorstok (idsektorstok,qty,sektor_idsektor,product_idproduct,sls_price)  values  ('$idsektorstok','$qty','$sektor','$product','$price')";  
	} else {
$sql1 = "update sektorstok set qty = qty+$qty,sls_price='$price'  where product_idproduct = '".$product."' and sektor_idsektor='".$sektor."'";
}

//echo $sql1;
$stock = mysql_query($sql1); 

}

echo "<script> alert('Konfirmasi dan proses update record selesai'); </script>";
}

?>
<script> 
window.close();
 </script>
