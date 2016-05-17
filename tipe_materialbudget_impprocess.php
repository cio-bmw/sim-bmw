	
<?php 

include_once('config.php'); 
$idtipefrom = $_GET['idtipefrom']; 
$idtipeto = $_GET['idtipeto'];

$sql = "select * from tipe_materialbudget where tipe_idtipe ='".$idtipefrom."'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	

	
$sqlx = "SELECT IFNULL(max(idbudget),0)+1  FROM tipe_materialbudget";  
$resultx = mysql_query($sqlx);  
$datax  = mysql_fetch_array($resultx);  
$idbudget = $datax[0];	 


$budget_qty = $row['qty'];
$product_idproduct = $row['product_idproduct'];

$sqlp = "SELECT salesprice FROM product where idproduct = '$product_idproduct'";  
$resultp = mysql_query($sqlp);  
$datap  = mysql_fetch_array($resultp);  
$price = $datap[0];

$sqld="insert into tipe_materialbudget (idbudget,qty,tipe_idtipe,product_idproduct,price)  values  ('$idbudget','$budget_qty','$idtipeto','$product_idproduct','$price')";     ;
$insertdtl=mysql_query($sqld);
echo $sqld;	
//echo $sqld;
}	 

//echo "<script> alert('Import Budget Unit selesai'); </script>";

?>  		
<script> 
alert('proses Import RAB Tipe berhasil'); 

window.close();
</script>		