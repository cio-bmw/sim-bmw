 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idxfiles"){ 
    dataString = 'starting='+page+'&idxfiles='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "xfilesname"){ 
    dataString = 'starting='+page+'&xfilesname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "xfilesdesc"){ 
    dataString = 'starting='+page+'&xfilesdesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "xfilesdate"){ 
    dataString = 'starting='+page+'&xfilesdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"xfiles_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data xfiles, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idxfiles"){ 
      dataString = 'idxfiles='+ cari;  
   } 
   else if (combo == "xfilesname"){ 
      dataString = 'xfilesname='+ cari; 
    } 
   else if (combo == "xfilesdesc"){ 
      dataString = 'xfilesdesc='+ cari; 
    } 
   else if (combo == "xfilesdate"){ 
      dataString = 'xfilesdate='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
  $.ajax({ 
    url: "xfiles_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#xfiles tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#xfiles tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendxfiles(n1,n2) 
 {
     document.getElementById('xfiles_idxfiles').value=n1;
     document.getElementById('xfiles').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from xfiles where idxfiles like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/xfiles.js"></script> 
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
 <th>idxfiles</th>
<th>xfilesname</th>
<th>xfilesdesc</th>
<th>xfilesdate</th>
<th>emp_idemp</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data xfiles 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idxfiles'];?></td>
<td><? echo $row['xfilesname'];?></td>
<td><? echo $row['xfilesdesc'];?></td>
<td><? echo $row['xfilesdate'];?></td>
<td><? echo $row['emp_idemp'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendxfiles('<? echo $row['idxfiles'];?>','<? echo $row['xfiles'];?>  ' )"></td>
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
