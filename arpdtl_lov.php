 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idarpdtl"){ 
    dataString = 'starting='+page+'&idarpdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pvalue"){ 
    dataString = 'starting='+page+'&pvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "arphdr_idarphdr"){ 
    dataString = 'starting='+page+'&arphdr_idarphdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "slshdrsektor_idslshdr"){ 
    dataString = 'starting='+page+'&slshdrsektor_idslshdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"arpdtl_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data arpdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idarpdtl"){ 
      dataString = 'idarpdtl='+ cari;  
   } 
   else if (combo == "pvalue"){ 
      dataString = 'pvalue='+ cari; 
    } 
   else if (combo == "arphdr_idarphdr"){ 
      dataString = 'arphdr_idarphdr='+ cari; 
    } 
   else if (combo == "slshdrsektor_idslshdr"){ 
      dataString = 'slshdrsektor_idslshdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "arpdtl_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#arpdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#arpdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendarpdtl(n1,n2) 
 {
     window.opener.document.getElementById('arpdtl_idarpdtl').value=n1;
     window.opener.document.getElementById('arpdtl').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from arpdtl where idarpdtl like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/arpdtl.js"></script> 
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
 <th>idarpdtl</th>
<th>pvalue</th>
<th>arphdr_idarphdr</th>
<th>slshdrsektor_idslshdr</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data arpdtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idarpdtl'];?></td>
<td><? echo $row['pvalue'];?></td>
<td><? echo $row['arphdr_idarphdr'];?></td>
<td><? echo $row['slshdrsektor_idslshdr'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendarpdtl('<? echo $row['idarpdtl'];?>','<? echo $row['arpdtl'];?>  ' )"></td>
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
