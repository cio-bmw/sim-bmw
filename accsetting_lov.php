 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaccsetting"){ 
    dataString = 'starting='+page+'&idaccsetting='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "app"){ 
    dataString = 'starting='+page+'&app='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "dacc_idacc"){ 
    dataString = 'starting='+page+'&dacc_idacc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kacc_idacc"){ 
    dataString = 'starting='+page+'&kacc_idacc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"accsetting_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data accsetting, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaccsetting"){ 
      dataString = 'idaccsetting='+ cari;  
   } 
   else if (combo == "app"){ 
      dataString = 'app='+ cari; 
    } 
   else if (combo == "dacc_idacc"){ 
      dataString = 'dacc_idacc='+ cari; 
    } 
   else if (combo == "kacc_idacc"){ 
      dataString = 'kacc_idacc='+ cari; 
    } 
 
  $.ajax({ 
    url: "accsetting_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#accsetting tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#accsetting tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendaccsetting(n1,n2) 
 {
     document.getElementById('accsetting_idaccsetting').value=n1;
     document.getElementById('accsetting').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from accsetting where idaccsetting like '%".$fieldcari."%'";  
 
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
	<p class="judul">Daftar accsetting</p>  
	<p>
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>   
	<form method="post" name="accsetting_lov" action="" id="accsetting_lov">  
	<table>  
  <tr> 
 <th>idaccsetting</th>
<th>app</th>
<th>dacc_idacc</th>
<th>kacc_idacc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data accsetting 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idaccsetting'];?></td>
<td><? echo $row['app'];?></td>
<td><? echo $row['dacc_idacc'];?></td>
<td><? echo $row['kacc_idacc'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendaccsetting('<? echo $row['idaccsetting'];?>','<? echo $row['accsetting'];?>  ' )"></td>
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
