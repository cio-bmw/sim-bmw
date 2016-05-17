	
<?php 

include_once('config.php'); 
$tipe_idtipe = $_GET['idtipe']; 
$unit_idunit = $_GET['idunit'];

$sql = "select * from tipe_materialbudget where tipe_idtipe ='".$tipe_idtipe."'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	
$sqlx = "SELECT IFNULL(max(idbudget),0)+1  FROM unit_materialbudget";  
$resultx = mysql_query($sqlx);  
$datax  = mysql_fetch_array($resultx);  
$idbudget = $datax[0];	 


$budget_qty = $row['qty'];
$product_idproduct = $row['product_idproduct'];

$sqlp = "SELECT salesprice FROM product where idproduct = '$product_idproduct'";  
$resultp = mysql_query($sqlp);  
$datap  = mysql_fetch_array($resultp);  
$price = $datap[0];



$sqld="insert into unit_materialbudget (idbudget,budget_qty,unit_idunit,product_idproduct,price)  values  ('$idbudget','$budget_qty','$unit_idunit','$product_idproduct','$price')";     ;
$insertdtl=mysql_query($sqld);

//echo $sqld;
}	 

echo "<script> alert('Import Budget Unit selesai'); </script>";

?>  		
<script> alert('proses confirm berhasil'); 
window.close();
</script>		