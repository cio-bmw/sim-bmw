<?
include_once("config.php"); 
$id=$_GET['id'];

$sqlh ="select * from unit where idunit ='$id'";
$resulth= mysql_query($sqlh);
$dataunit = mysql_fetch_array($resulth);

$sql = "SELECT IFNULL(max(CAST(idunithistory AS UNSIGNED)),0)+1  FROM unithistory";  
$result = mysql_query($sql);  
$data  = mysql_fetch_array($result);  
$idunithistory = $data[0];	 

$namauser=$dataunit['owner']; 
$tglmundur=''; 
$alasan='Tanya Marketingnya'; 
$unit_idunit=$dataunit['idunit']; 


mysql_query(" insert into unithistory (idunithistory,namauser,tglmundur,alasan,unit_idunit)  values  ('$idunithistory','$namauser','$tglmundur','$alasan','$unit_idunit')")  or die("Data gagal Di Tambahkan!");  
 	

$result1=mysql_query("select * from unitarpayment where unit_idunit = '$id'");

while($row = mysql_fetch_array($result1)){

$sqlz = "SELECT IFNULL(max(CAST(idunithistorypayment AS UNSIGNED)),0)+1  FROM unithistorypayment";  
$resultz = mysql_query($sqlz);  
$dataz  = mysql_fetch_array($resultz);  
$idunithistorypayment = $dataz[0];	 

 $pay_date=$row['pay_date']; 
 $pay_value=$row['pay_value']; 
 $pay_name=$row['pay_name']; 
 $pay_note=$row['pay_note']; 
 $unitmstpayment_idpayment=$row['unitmstpayment_idpayment']; 
 $unithistory_idunithistory=$idunithistory; 



mysql_query(" insert into unithistorypayment (idunithistorypayment,pay_date,pay_value,pay_name,pay_note,unitmstpayment_idpayment,unithistory_idunithistory)  values  ('$idunithistorypayment','$pay_date','$pay_value','$pay_name','$pay_note','$unitmstpayment_idpayment','$unithistory_idunithistory')")  or die("Data gagal Di Tambahkan!");  
mysql_query(" update unit set owner=null,address=null,phone=null,phone2=null,nkontrakuser=null where idunit = '$id'");  
mysql_query(" delete from unitarpayment where unit_idunit = '$id'");
mysql_query(" delete from unitar where unit_idunit = '$id'");



echo "<script> alert('proses ".$pay_value."user mundur selesai'); </script>";

}
echo "<script> alert('proses user mundur selesai'); </script>";
?>
<script> window.close(); </script>
