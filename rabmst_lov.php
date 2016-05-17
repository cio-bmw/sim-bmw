 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
 
 dataString = 'starting='+page+'&cari='+cari+'&random='+Math.random(); 
   
   
  $.ajax({ 
    url:"rabmst_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data rabmst, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	
      dataString = 'rabdesc='+ cari; 
   
 
  $.ajax({ 
    url: "rabmst_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#rabmst tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#rabmst tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendrabmst(n1,n2) 
 {
     document.getElementById('rabmst_idrabmst').value=n1;
     document.getElementById('rabdesc').value=n2;
     $('#divLOV').hide();
 } 
 
  $("#btncarilov").click(function(){ 
		pagelov="rabmst_lov.php?cari="+$('input#fieldcari').val(); 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_GET['cari']; 

$sql = "select * from rabmst where rabdesc like '%".$fieldcari."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
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
	<form method="post" name="rabmst_lov" action="" id="rabmst_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="<? echo $fieldcari; ?>" />  
	<input class="button"  type="button" id="btncarilov" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idrabmst</th>
<th>rabdesc</th>
<th>satuan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data rabmst 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idrabmst'];?></td>
<td><? echo $row['rabdesc'];?></td>
<td><? echo $row['satuan'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendrabmst('<? echo $row['idrabmst'];?>','<? echo $row['rabdesc'];?>  ' )"></td>
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
