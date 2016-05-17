 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsektorcostdtl"){ 
    dataString = 'starting='+page+'&idsektorcostdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "costprice"){ 
    dataString = 'starting='+page+'&costprice='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rabmst_idrabmst"){ 
    dataString = 'starting='+page+'&rabmst_idrabmst='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txndtldesc"){ 
    dataString = 'starting='+page+'&txndtldesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektorcosthdr_idsektorcosthdr"){ 
    dataString = 'starting='+page+'&sektorcosthdr_idsektorcosthdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"sektorcostdtl_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektorcostdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsektorcostdtl"){ 
      dataString = 'idsektorcostdtl='+ cari;  
   } 
   else if (combo == "costprice"){ 
      dataString = 'costprice='+ cari; 
    } 
   else if (combo == "rabmst_idrabmst"){ 
      dataString = 'rabmst_idrabmst='+ cari; 
    } 
   else if (combo == "txndtldesc"){ 
      dataString = 'txndtldesc='+ cari; 
    } 
   else if (combo == "sektorcosthdr_idsektorcosthdr"){ 
      dataString = 'sektorcosthdr_idsektorcosthdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "sektorcostdtl_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sektorcostdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektorcostdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendsektorcostdtl(n1,n2) 
 {
     window.opener.document.getElementById('sektorcostdtl_idsektorcostdtl').value=n1;
     window.opener.document.getElementById('sektorcostdtl').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from sektorcostdtl where idsektorcostdtl like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/sektorcostdtl.js"></script> 
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
 <th>idsektorcostdtl</th>
<th>costprice</th>
<th>rabmst_idrabmst</th>
<th>txndtldesc</th>
<th>sektorcosthdr_idsektorcosthdr</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sektorcostdtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idsektorcostdtl'];?></td>
<td><? echo $row['costprice'];?></td>
<td><? echo $row['rabmst_idrabmst'];?></td>
<td><? echo $row['txndtldesc'];?></td>
<td><? echo $row['sektorcosthdr_idsektorcosthdr'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendsektorcostdtl('<? echo $row['idsektorcostdtl'];?>','<? echo $row['sektorcostdtl'];?>  ' )"></td>
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
