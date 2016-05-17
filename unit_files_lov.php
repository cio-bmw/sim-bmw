 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunit_files"){ 
    dataString = 'starting='+page+'&idunit_files='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "filename"){ 
    dataString = 'starting='+page+'&filename='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "filedesc"){ 
    dataString = 'starting='+page+'&filedesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unit_idunit"){ 
    dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "doccat_iddoccat"){ 
    dataString = 'starting='+page+'&doccat_iddoccat='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"unit_files_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unit_files, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunit_files"){ 
      dataString = 'idunit_files='+ cari;  
   } 
   else if (combo == "filename"){ 
      dataString = 'filename='+ cari; 
    } 
   else if (combo == "filedesc"){ 
      dataString = 'filedesc='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "doccat_iddoccat"){ 
      dataString = 'doccat_iddoccat='+ cari; 
    } 
 
  $.ajax({ 
    url: "unit_files_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unit_files tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unit_files tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendunit_files(n1,n2) 
 {
     window.opener.document.getElementById('unit_files_idunit_files').value=n1;
     window.opener.document.getElementById('unit_files').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from unit_files where idunit_files like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/unit_files.js"></script> 
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
 <th>idunit_files</th>
<th>filename</th>
<th>filedesc</th>
<th>unit_idunit</th>
<th>doccat_iddoccat</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unit_files 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idunit_files'];?></td>
<td><? echo $row['filename'];?></td>
<td><? echo $row['filedesc'];?></td>
<td><? echo $row['unit_idunit'];?></td>
<td><? echo $row['doccat_iddoccat'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendunit_files('<? echo $row['idunit_files'];?>','<? echo $row['unit_files'];?>  ' )"></td>
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
