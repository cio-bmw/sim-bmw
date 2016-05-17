 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtipeclbangun"){ 
    dataString = 'starting='+page+'&idtipeclbangun='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "bobotpct"){ 
    dataString = 'starting='+page+'&bobotpct='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "tipe_idtipe"){ 
    dataString = 'starting='+page+'&tipe_idtipe='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "clbangun_idclbangun"){ 
    dataString = 'starting='+page+'&clbangun_idclbangun='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"tipeclbangun_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data tipeclbangun, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtipeclbangun"){ 
      dataString = 'idtipeclbangun='+ cari;  
   } 
   else if (combo == "bobotpct"){ 
      dataString = 'bobotpct='+ cari; 
    } 
   else if (combo == "tipe_idtipe"){ 
      dataString = 'tipe_idtipe='+ cari; 
    } 
   else if (combo == "clbangun_idclbangun"){ 
      dataString = 'clbangun_idclbangun='+ cari; 
    } 
 
  $.ajax({ 
    url: "tipeclbangun_lov.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#tipeclbangun tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#tipeclbangun tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendtipeclbangun(n1,n2) 
 {
     window.opener.document.getElementById('tipeclbangun_idtipeclbangun').value=n1;
     window.opener.document.getElementById('tipeclbangun').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from tipeclbangun where idtipeclbangun like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/tipeclbangun.js"></script> 
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
 <th>idtipeclbangun</th>
<th>bobotpct</th>
<th>tipe_idtipe</th>
<th>clbangun_idclbangun</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data tipeclbangun 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtipeclbangun'];?></td>
<td><? echo $row['bobotpct'];?></td>
<td><? echo $row['tipe_idtipe'];?></td>
<td><? echo $row['clbangun_idclbangun'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendtipeclbangun('<? echo $row['idtipeclbangun'];?>','<? echo $row['tipeclbangun'];?>  ' )"></td>
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
