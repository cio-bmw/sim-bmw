 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idplhdr"){ 
    dataString = 'starting='+page+'&idplhdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "plhdrname"){ 
    dataString = 'starting='+page+'&plhdrname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "plhdrseq"){ 
    dataString = 'starting='+page+'&plhdrseq='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pl_idpl"){ 
    dataString = 'starting='+page+'&pl_idpl='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "plhdrsdk"){ 
    dataString = 'starting='+page+'&plhdrsdk='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"plhdr_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data plhdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idplhdr"){ 
      dataString = 'idplhdr='+ cari;  
   } 
   else if (combo == "plhdrname"){ 
      dataString = 'plhdrname='+ cari; 
    } 
   else if (combo == "plhdrseq"){ 
      dataString = 'plhdrseq='+ cari; 
    } 
   else if (combo == "pl_idpl"){ 
      dataString = 'pl_idpl='+ cari; 
    } 
   else if (combo == "plhdrsdk"){ 
      dataString = 'plhdrsdk='+ cari; 
    } 
 
  $.ajax({ 
    url: "plhdr_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#plhdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#plhdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendplhdr(n1,n2) 
 {
     document.getElementById('plhdr_idplhdr').value=n1;
     document.getElementById('plhdr').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from plhdr where idplhdr like '%".$fieldcari."%'";  
 
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
	<form method="post" name="plhdr_lov" action="" id="plhdr_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idplhdr</th>
<th>plhdrname</th>
<th>plhdrseq</th>
<th>pl_idpl</th>
<th>plhdrsdk</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data plhdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idplhdr'];?></td>
<td><? echo $row['plhdrname'];?></td>
<td><? echo $row['plhdrseq'];?></td>
<td><? echo $row['pl_idpl'];?></td>
<td><? echo $row['plhdrsdk'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendplhdr('<? echo $row['idplhdr'];?>','<? echo $row['plhdr'];?>  ' )"></td>
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
