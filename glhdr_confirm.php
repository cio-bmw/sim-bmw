<?
include_once("config.php"); 
$id=$_GET['id'];

$sqlh ="select gl_status from glhdr where idglhdr ='$id'";
$resulth= mysql_query($sqlh);
$data = mysql_fetch_array($resulth);
$status = $data['gl_status'];

if ($status=='posted') {
echo "<script> alert('Data sudah di posting'); </script>";	
}	
else {	
$result=mysql_query("select sum(dvalue) debet, sum(kvalue) kredit  from gldtl where glhdr_idglhdr = '$id'");
while($row = mysql_fetch_array($result)){
$debet = $row['debet'];
$kredit = $row['kredit'];
}


if ($debet-$kredit == 0 ) {
$sqlc = "update glhdr set gl_status='posted' where idglhdr ='".$id."'";
$confirm = mysql_query($sqlc);	
echo "<script> alert('Posting selesai'); </script>";
} else {
echo "<script> alert('Transaksi belum balance tidak bisa di posting'); </script>";	
}
}
?>
<script> window.close(); </script>
