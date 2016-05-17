 <script type="text/javascript">  
 
function pagination(page){ 
var cari = $("select#idsektor").val(); 
   
  dataString = 'starting='+page+'&idsektor='+cari+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"slshdrunit_unitlov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unit, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
var cari = $("select#idsektor").val();
 
  dataString = 'idsektor='+ cari; 
 
  $.ajax({ 
    url: "slshdrunit_unitlov.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#unit tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unit tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendunit(n1,n2) 
 {
     document.getElementById('unit_idunit').value=n1;
     document.getElementById('kavling').value=n2;
     $('#divLOV').hide();
   } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
$idsektor = $_GET['idsektor'];
 
if ($idsektor=='%')  { 
$sql = "select * from unit";  
}
 else {
  $sql = "select * from unit where sektor_idsektor ='".$idsektor."' ";  
}
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
	<html xmlns="http://www.w3.org/1999/xhtml"> 
	<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>technosoft Indonesia</title> 
	<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
	</head> 
	<body> 
	<form method="post" name="unit_lov" action="" id="unit_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idunit</th>
<th>kavling</th>
<th>Pemilik</th>
<th>sektor_idsektor</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unit 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idunit'];?></td>
<td><? echo $row['kavling'];?></td>
<td><? echo $row['owner'];?></td>
<td><? echo $row['sektor_idsektor'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendunit('<? echo $row['idunit'];?>','<? echo $row['kavling'];?>  ' )"></td>
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
	</form>	
	</body>
	</html>	
