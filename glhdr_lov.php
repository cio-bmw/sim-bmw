 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idglhdr"){ 
    dataString = 'starting='+page+'&idglhdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "gl_date"){ 
    dataString = 'starting='+page+'&gl_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "gl_desc"){ 
    dataString = 'starting='+page+'&gl_desc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "gl_refno"){ 
    dataString = 'starting='+page+'&gl_refno='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"glhdr_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data glhdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idglhdr"){ 
      dataString = 'idglhdr='+ cari;  
   } 
   else if (combo == "gl_date"){ 
      dataString = 'gl_date='+ cari; 
    } 
   else if (combo == "gl_desc"){ 
      dataString = 'gl_desc='+ cari; 
    } 
   else if (combo == "gl_refno"){ 
      dataString = 'gl_refno='+ cari; 
    } 
 
  $.ajax({ 
    url: "glhdr_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#glhdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#glhdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendglhdr(n1,n2) 
 {
     document.getElementById('glhdr_idglhdr').value=n1;
     document.getElementById('glhdr').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from glhdr where idglhdr like '%".$fieldcari."%'";  
 
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
	<form method="post" name="glhdr_lov" action="" id="glhdr_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idglhdr</th>
<th>gl_date</th>
<th>gl_desc</th>
<th>gl_refno</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data glhdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idglhdr'];?></td>
<td><? echo $row['gl_date'];?></td>
<td><? echo $row['gl_desc'];?></td>
<td><? echo $row['gl_refno'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendglhdr('<? echo $row['idglhdr'];?>','<? echo $row['glhdr'];?>  ' )"></td>
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
