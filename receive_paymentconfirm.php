<?
include_once("config.php"); 
$id=$_GET['id'];

$sqlh ="select pay_status,pay_date from receive_paymenthdr where idpaymenthdr ='$id'";
$resulth= mysql_query($sqlh);
$data = mysql_fetch_array($resulth);
$status = $data['pay_status'];
$tanggal = $data['pay_date'];

if ($status=='confirm') {
echo "<script> alert('Data sudah pernah di Konfirmasi. Tidak ada update stock '); </script>";	
}	
else {	
$sqlc = "update receive_paymenthdr set pay_status='confirm' where idpaymenthdr ='".$id."'";
$confirm = mysql_query($sqlc);	

$result=mysql_query("select * from receive_paymentdtl where receive_paymenthdr_idpaymenthdr = '$id'");
while($row = mysql_fetch_array($result)){

$sql1 = "update receivehdr  set paid_date = $tanggal where idreceivehdr = '".$row['receivehdr_idreceivehdr']."'";
$stock = mysql_query($sql1); 

}
echo "<script> alert('Konfirmasi dan proses update record selesai'); </script>";
}
?>
<script> window.close(); </script>
