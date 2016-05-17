 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idgldtl"){ 
    dataString = 'starting='+page+'&idgldtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "glhdr_idglhdr"){ 
    dataString = 'starting='+page+'&glhdr_idglhdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Dvalue"){ 
    dataString = 'starting='+page+'&Dvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Kvalue"){ 
    dataString = 'starting='+page+'&Kvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "acc_idacc"){ 
    dataString = 'starting='+page+'&acc_idacc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"gldtl_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data gldtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idgldtl"){ 
      dataString = 'idgldtl='+ cari;  
   } 
   else if (combo == "glhdr_idglhdr"){ 
      dataString = 'glhdr_idglhdr='+ cari; 
    } 
   else if (combo == "Dvalue"){ 
      dataString = 'Dvalue='+ cari; 
    } 
   else if (combo == "Kvalue"){ 
      dataString = 'Kvalue='+ cari; 
    } 
   else if (combo == "acc_idacc"){ 
      dataString = 'acc_idacc='+ cari; 
    } 
 
  $.ajax({ 
    url: "gldtl_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#gldtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#gldtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendgldtl(n1,n2) 
 {
     document.getElementById('gldtl_idgldtl').value=n1;
     document.getElementById('gldtl').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from gldtl where idgldtl like '%".$fieldcari."%'";  
 
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
	<form method="post" name="gldtl_lov" action="" id="gldtl_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idgldtl</th>
<th>glhdr_idglhdr</th>
<th>Dvalue</th>
<th>Kvalue</th>
<th>acc_idacc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data gldtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idgldtl'];?></td>
<td><? echo $row['glhdr_idglhdr'];?></td>
<td><? echo $row['Dvalue'];?></td>
<td><? echo $row['Kvalue'];?></td>
<td><? echo $row['acc_idacc'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendgldtl('<? echo $row['idgldtl'];?>','<? echo $row['gldtl'];?>  ' )"></td>
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
