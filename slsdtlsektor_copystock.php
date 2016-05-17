	
<?php 

include_once('config.php'); 
$sektor = $_GET['sektor']; 


echo "<script> alert('copy stok akan di mulai harap bersabar'); </script>";

$sqld = "select * from product";
$resultd = mysql_query($sqld);
while($row = mysql_fetch_array($resultd)) {

$product_idproduct = $row['idproduct'];

$sqlcs = "select count(*) jumlah from sektorstok where idproduct = '".$product_idproduct."' and sektor_idsektor='$sektor'";
$resultcs = mysql_query($sqlcs);
$datacs = mysql_fetch_array($resultcs);
$jmlstok = $datacs['jumlah'];


if ($jmlstok < 1) {
$sql = "SELECT IFNULL(max(idsektorstok),0)+1  FROM sektorstok";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idsektorstok = $data[0];	 	
	
$sqlsektorstok = "insert into sektorstok (idsektorstok,qty,sektor_idsektor,product_idproduct)  values  ('$idsektorstok','$qty','$sektor','$product_idproduct')";
$updstoksektor = mysql_query($sqlsektorstok);
}
}

echo "<script> alert('copy stok sektor selesai'); </script>";

?>  		
<script> alert('proses confirm berhasil'); 
window.close();
</script>		