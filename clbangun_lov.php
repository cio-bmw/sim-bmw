 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idclbangun"){ 
    dataString = 'starting='+page+'&idclbangun='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "clbangundesc"){ 
    dataString = 'starting='+page+'&clbangundesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "bobotpct"){ 
    dataString = 'starting='+page+'&bobotpct='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "spkcat_idspkcat"){ 
    dataString = 'starting='+page+'&spkcat_idspkcat='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "workdays"){ 
    dataString = 'starting='+page+'&workdays='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"clbangun_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data clbangun, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idclbangun"){ 
      dataString = 'idclbangun='+ cari;  
   } 
   else if (combo == "clbangundesc"){ 
      dataString = 'clbangundesc='+ cari; 
    } 
   else if (combo == "bobotpct"){ 
      dataString = 'bobotpct='+ cari; 
    } 
   else if (combo == "spkcat_idspkcat"){ 
      dataString = 'spkcat_idspkcat='+ cari; 
    } 
   else if (combo == "workdays"){ 
      dataString = 'workdays='+ cari; 
    } 
 
  $.ajax({ 
    url: "clbangun_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#clbangun tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#clbangun tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendclbangun(n1,n2) 
 {
     document.getElementById('clbangun_idclbangun').value=n1;
     document.getElementById('clbangun').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
$idspkcat = $_GET['cat'];
 
  $sql = "select * from clbangun where spkcat_idspkcat = '$idspkcat' and idclbangun like '%".$fieldcari."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
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
	<p class="judul">Daftar Cek Item</p> 
	<table width="500px">  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>Kode</th>
<th>Keterangan</th>
<th>bobot</th>
<th>workdays</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data clbangun 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idclbangun'];?></td>
<td><? echo $row['clbangundesc'];?></td>
<td><? echo $row['bobotpct'];?></td>
<td><? echo $row['workdays'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendclbangun('<? echo $row['idclbangun'];?>','<? echo $row['clbangun'];?>  ' )"></td>
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
