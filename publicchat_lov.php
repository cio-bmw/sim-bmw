 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpublicchat"){ 
    dataString = 'starting='+page+'&idpublicchat='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "chatdate"){ 
    dataString = 'starting='+page+'&chatdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "chatmsg"){ 
    dataString = 'starting='+page+'&chatmsg='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "chatimg"){ 
    dataString = 'starting='+page+'&chatimg='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"publicchat_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data publicchat, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpublicchat"){ 
      dataString = 'idpublicchat='+ cari;  
   } 
   else if (combo == "chatdate"){ 
      dataString = 'chatdate='+ cari; 
    } 
   else if (combo == "chatmsg"){ 
      dataString = 'chatmsg='+ cari; 
    } 
   else if (combo == "chatimg"){ 
      dataString = 'chatimg='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
  $.ajax({ 
    url: "publicchat_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#publicchat tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#publicchat tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendpublicchat(n1,n2) 
 {
     window.opener.document.getElementById('publicchat_idpublicchat').value=n1;
     window.opener.document.getElementById('publicchat').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from publicchat where idpublicchat like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/publicchat.js"></script> 
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
 <th>idpublicchat</th>
<th>chatdate</th>
<th>chatmsg</th>
<th>chatimg</th>
<th>emp_idemp</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data publicchat 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idpublicchat'];?></td>
<td><? echo $row['chatdate'];?></td>
<td><? echo $row['chatmsg'];?></td>
<td><? echo $row['chatimg'];?></td>
<td><? echo $row['emp_idemp'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendpublicchat('<? echo $row['idpublicchat'];?>','<? echo $row['publicchat'];?>  ' )"></td>
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
