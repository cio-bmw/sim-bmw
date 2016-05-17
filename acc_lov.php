 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idacc"){ 
    dataString = 'starting='+page+'&idacc='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "accname"){ 
    dataString = 'starting='+page+'&accname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "accsaldo"){ 
    dataString = 'starting='+page+'&accsaldo='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "groupacc_idgroupacc"){ 
    dataString = 'starting='+page+'&groupacc_idgroupacc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"acc_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data acc, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idacc"){ 
      dataString = 'idacc='+ cari;  
   } 
   else if (combo == "accname"){ 
      dataString = 'accname='+ cari; 
    } 
   else if (combo == "accsaldo"){ 
      dataString = 'accsaldo='+ cari; 
    } 
   else if (combo == "groupacc_idgroupacc"){ 
      dataString = 'groupacc_idgroupacc='+ cari; 
    } 
 
  $.ajax({ 
    url: "acc_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#acc tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#acc tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendacc(n1,n2) 
 {
     document.getElementById('acc_idacc').value=n1;
     document.getElementById('acc').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from acc where idacc like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script> 
	</head> 
	<body> 
	<form method="post" name="acc_lov" action="" id="acc_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idacc</th>
<th>accname</th>
<th>accsaldo</th>
<th>groupacc_idgroupacc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data acc 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idacc'];?></td>
<td><? echo $row['accname'];?></td>
<td><? echo $row['accsaldo'];?></td>
<td><? echo $row['groupacc_idgroupacc'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendacc('<? echo $row['idacc'];?>','<? echo $row['acc'];?>  ' )"></td>
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
