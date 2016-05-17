	
<?php 

include_once('config.php'); 
$unit_idunit = $_GET['idunit'];

$sqld="delete from unit_materialbudget where unit_idunit = '".$unit_idunit."'" ;
$delete=mysql_query($sqld);
?>

<script> 
alert('Proses Menghapus RAB berhasil'); window.close();
</script>		