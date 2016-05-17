<?
include_once("config.php"); 
$id=$_GET['id'];

$sqlh ="select count(*) jumlah from sektorrab where sektor_idsektor ='$id'";
$resulth= mysql_query($sqlh);
$data = mysql_fetch_array($resulth);
$status = $data['jumlah'];

if ($status > 0) {
echo "<script> alert('Data Rab Sektor Sudah Ada  '); </script>";	
}
else {

$sql= "select * from rabmst";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)){

$sqldtl = "SELECT IFNULL(max(idsektorrab),0)+1  FROM sektorrab";  
$resultdtl = mysql_query($sqldtl);  
$datadtl  = mysql_fetch_array($resultdtl);  
$idsektorrab = $datadtl[0];	 	

$sektor_idsektor = $id;	
$rabmst_idrabmst = $row['idrabmst'];	

$sql1 =" insert into sektorrab (idsektorrab,sektor_idsektor,rabmst_idrabmst)  values  ('$idsektorrab','$sektor_idsektor','$rabmst_idrabmst')";  
 
//echo $sql1;
$stock = mysql_query($sql1); 

}

echo "<script> alert('Import RAB Selesai'); </script>";
}

?>
<script> 
window.close();
 </script>
