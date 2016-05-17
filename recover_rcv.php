<script> alert('start'); </script>

<?php 
include_once('config.php'); 

$sqld = "select * from receivedtl";
$resultd = mysql_query($sqld);


while($row = mysql_fetch_array($resultd)){ 

$product = $row['product_idproduct'];
$info = productinfo($product);
$harga = $info['costprice'];


$sqlstock = "update receivedtl set receive_price = '$harga' where product_idproduct = '".$product."'";
$updstok = mysql_query($sqlstock);

echo 'test '.$sqlstock;

}	 

?>
