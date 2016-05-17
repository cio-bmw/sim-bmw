 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsektor"){ 
    dataString = 'starting='+page+'&idsektor='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "sektorname"){ 
    dataString = 'starting='+page+'&sektorname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "address"){ 
    dataString = 'starting='+page+'&address='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idempmkt"){ 
    dataString = 'starting='+page+'&emp_idempmkt='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idempgdg"){ 
    dataString = 'starting='+page+'&emp_idempgdg='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "front_img"){ 
    dataString = 'starting='+page+'&front_img='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "map_img"){ 
    dataString = 'starting='+page+'&map_img='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "siteplan_img"){ 
    dataString = 'starting='+page+'&siteplan_img='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"sektor_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsektor"){ 
      dataString = 'idsektor='+ cari;  
   } 
   else if (combo == "sektorname"){ 
      dataString = 'sektorname='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "emp_idempmkt"){ 
      dataString = 'emp_idempmkt='+ cari; 
    } 
   else if (combo == "emp_idempgdg"){ 
      dataString = 'emp_idempgdg='+ cari; 
    } 
   else if (combo == "front_img"){ 
      dataString = 'front_img='+ cari; 
    } 
   else if (combo == "map_img"){ 
      dataString = 'map_img='+ cari; 
    } 
   else if (combo == "siteplan_img"){ 
      dataString = 'siteplan_img='+ cari; 
    } 
 
  $.ajax({ 
    url: "sektor_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sektor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendsektor(n1,n2) 
 {
     document.getElementById('sektor_idsektor').value=n1;
     document.getElementById('sektorname').value=n2;
   $("#divLOV").hide(); 
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from sektor where idsektor like '%".$fieldcari."%'";  
 
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
 <th>Kode</th>
<th>Nama Sektor</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sektor 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idsektor'];?></td>
<td><? echo $row['sektorname'];?></td>

 
<td><input class="button" type=button value="Pilih" onClick="sendsektor('<? echo $row['idsektor'];?>','<? echo $row['sektorname'];?>  ' )"></td>
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
