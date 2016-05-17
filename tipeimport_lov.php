 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtipe"){ 
    dataString = 'starting='+page+'&idtipe='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "tipename"){ 
    dataString = 'starting='+page+'&tipename='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "ukuran"){ 
    dataString = 'starting='+page+'&ukuran='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "lb"){ 
    dataString = 'starting='+page+'&lb='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "lt"){ 
    dataString = 'starting='+page+'&lt='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"tipe_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data tipe, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtipe"){ 
      dataString = 'idtipe='+ cari;  
   } 
   else if (combo == "tipename"){ 
      dataString = 'tipename='+ cari; 
    } 
   else if (combo == "ukuran"){ 
      dataString = 'ukuran='+ cari; 
    } 
   else if (combo == "lb"){ 
      dataString = 'lb='+ cari; 
    } 
   else if (combo == "lt"){ 
      dataString = 'lt='+ cari; 
    } 
 
  $.ajax({ 
    url: "tipe_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#tipe tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#tipe tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendtipe(n1,n2) 
 {
     document.getElementById('idtipefrom').value=n1;
     document.getElementById('tipenamefrom').value=n2;
     $("#divLOV").hide();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from tipe where idtipe like '%".$fieldcari."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
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
	<form method="post" name="agama_lov" action="" id="agama_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idtipe</th>
<th>tipename</th>
<th>ukuran</th>
<th>lb</th>
<th>lt</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data tipe 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtipe'];?></td>
<td><? echo $row['tipename'];?></td>
<td><? echo $row['ukuran'];?></td>
<td><? echo $row['lb'];?></td>
<td><? echo $row['lt'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendtipe('<? echo $row['idtipe'];?>','<? echo $row['tipename'];?>  ' )"></td>
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
