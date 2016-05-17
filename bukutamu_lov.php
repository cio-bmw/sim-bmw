 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idbukutamu"){ 
    dataString = 'starting='+page+'&idbukutamu='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "nama"){ 
    dataString = 'starting='+page+'&nama='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "alamat"){ 
    dataString = 'starting='+page+'&alamat='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "notlp"){ 
    dataString = 'starting='+page+'&notlp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "tanggal"){ 
    dataString = 'starting='+page+'&tanggal='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "catatan"){ 
    dataString = 'starting='+page+'&catatan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "diterima"){ 
    dataString = 'starting='+page+'&diterima='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"bukutamu_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data bukutamu, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idbukutamu"){ 
      dataString = 'idbukutamu='+ cari;  
   } 
   else if (combo == "nama"){ 
      dataString = 'nama='+ cari; 
    } 
   else if (combo == "alamat"){ 
      dataString = 'alamat='+ cari; 
    } 
   else if (combo == "notlp"){ 
      dataString = 'notlp='+ cari; 
    } 
   else if (combo == "tanggal"){ 
      dataString = 'tanggal='+ cari; 
    } 
   else if (combo == "catatan"){ 
      dataString = 'catatan='+ cari; 
    } 
   else if (combo == "diterima"){ 
      dataString = 'diterima='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
  $.ajax({ 
    url: "bukutamu_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#bukutamu tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#bukutamu tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendbukutamu(n1,n2) 
 {
     window.opener.document.getElementById('bukutamu_idbukutamu').value=n1;
     window.opener.document.getElementById('bukutamu').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from bukutamu where idbukutamu like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/bukutamu.js"></script> 
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
 <th>idbukutamu</th>
<th>nama</th>
<th>alamat</th>
<th>notlp</th>
<th>tanggal</th>
<th>catatan</th>
<th>diterima</th>
<th>emp_idemp</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data bukutamu 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idbukutamu'];?></td>
<td><? echo $row['nama'];?></td>
<td><? echo $row['alamat'];?></td>
<td><? echo $row['notlp'];?></td>
<td><? echo $row['tanggal'];?></td>
<td><? echo $row['catatan'];?></td>
<td><? echo $row['diterima'];?></td>
<td><? echo $row['emp_idemp'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendbukutamu('<? echo $row['idbukutamu'];?>','<? echo $row['bukutamu'];?>  ' )"></td>
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
