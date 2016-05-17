 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idemp"){ 
    dataString = 'starting='+page+'&idemp='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "empasswd"){ 
    dataString = 'starting='+page+'&empasswd='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "empname"){ 
    dataString = 'starting='+page+'&empname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "empphone"){ 
    dataString = 'starting='+page+'&empphone='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "gp"){ 
    dataString = 'starting='+page+'&gp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "gs"){ 
    dataString = 'starting='+page+'&gs='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "mkt"){ 
    dataString = 'starting='+page+'&mkt='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "tch"){ 
    dataString = 'starting='+page+'&tch='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "acc"){ 
    dataString = 'starting='+page+'&acc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kpr"){ 
    dataString = 'starting='+page+'&kpr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "adm"){ 
    dataString = 'starting='+page+'&adm='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"emp_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data emp, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idemp"){ 
      dataString = 'idemp='+ cari;  
   } 
   else if (combo == "empasswd"){ 
      dataString = 'empasswd='+ cari; 
    } 
   else if (combo == "empname"){ 
      dataString = 'empname='+ cari; 
    } 
   else if (combo == "empphone"){ 
      dataString = 'empphone='+ cari; 
    } 
   else if (combo == "gp"){ 
      dataString = 'gp='+ cari; 
    } 
   else if (combo == "gs"){ 
      dataString = 'gs='+ cari; 
    } 
   else if (combo == "mkt"){ 
      dataString = 'mkt='+ cari; 
    } 
   else if (combo == "tch"){ 
      dataString = 'tch='+ cari; 
    } 
   else if (combo == "acc"){ 
      dataString = 'acc='+ cari; 
    } 
   else if (combo == "kpr"){ 
      dataString = 'kpr='+ cari; 
    } 
   else if (combo == "adm"){ 
      dataString = 'adm='+ cari; 
    } 
 
  $.ajax({ 
    url: "emp_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#emp tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#emp tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendemp(n1,n2) 
 {
     document.getElementById('emp_idemp').value=n1;
     document.getElementById('emp').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from emp where idemp like '%".$fieldcari."%'";  
 
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
	<p class="judul">Daftar emp</p>  
	<p>
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>   
	<form method="post" name="emp_lov" action="" id="emp_lov">  
	<table>  
  <tr> 
 <th>idemp</th>
<th>empasswd</th>
<th>empname</th>
<th>empphone</th>
<th>gp</th>
<th>gs</th>
<th>mkt</th>
<th>tch</th>
<th>acc</th>
<th>kpr</th>
<th>adm</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data emp 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idemp'];?></td>
<td><? echo $row['empasswd'];?></td>
<td><? echo $row['empname'];?></td>
<td><? echo $row['empphone'];?></td>
<td><? echo $row['gp'];?></td>
<td><? echo $row['gs'];?></td>
<td><? echo $row['mkt'];?></td>
<td><? echo $row['tch'];?></td>
<td><? echo $row['acc'];?></td>
<td><? echo $row['kpr'];?></td>
<td><? echo $row['adm'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendemp('<? echo $row['idemp'];?>','<? echo $row['emp'];?>  ' )"></td>
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
