<?
include_once("config.php"); 
$id=$_GET['id'];
$spk=$_GET['spk'];
$unit=$_GET['unit'];


$sql= "select * from clbangun where spkcat_idspkcat = '$spk'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)){

$sqldtl = "SELECT IFNULL(max(idunitclbangun),0)+1  FROM unitclbangun";  
$resultdtl = mysql_query($sqldtl);  
$datadtl  = mysql_fetch_array($resultdtl);  
$idunitclbangun = $datadtl[0];	 	

$unit_idunit = $unit;	
$unitspk_idunitspk = $id;	
$clbangun_idclbangun = $row['idclbangun'];	
$bobotpct = $row['bobotpct'];
$workdays = $row['workdays'];
$clstatus = 'belum';

$sql1 ="  insert into unitclbangun (idunitclbangun,clstatus,clbangun_idclbangun,unit_idunit,bobotpct,unitspk_idunitspk,workdays)  values  ('$idunitclbangun','$clstatus','$clbangun_idclbangun','$unit_idunit','$bobotpct','$unitspk_idunitspk','$workdays')";  
 
echo $sql1;
$stock = mysql_query($sql1); 

}

//echo "<script> alert('Import Check List SPK Selesai'); </script>";
?>
<script> 
window.close();
 </script>
