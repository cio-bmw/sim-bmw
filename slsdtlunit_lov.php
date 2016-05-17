 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idslsdtl"){ 
    dataString = 'starting='+page+'&idslsdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "cost_price"){ 
    dataString = 'starting='+page+'&cost_price='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "qty"){ 
    dataString = 'starting='+page+'&qty='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sales_price"){ 
    dataString = 'starting='+page+'&sales_price='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "slshdrunit_idslshdr"){ 
    dataString = 'starting='+page+'&slshdrunit_idslshdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "product_idproduct"){ 
    dataString = 'starting='+page+'&product_idproduct='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"slsdtlunit_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data slsdtlunit, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idslsdtl"){ 
      dataString = 'idslsdtl='+ cari;  
   } 
   else if (combo == "cost_price"){ 
      dataString = 'cost_price='+ cari; 
    } 
   else if (combo == "qty"){ 
      dataString = 'qty='+ cari; 
    } 
   else if (combo == "sales_price"){ 
      dataString = 'sales_price='+ cari; 
    } 
   else if (combo == "slshdrunit_idslshdr"){ 
      dataString = 'slshdrunit_idslshdr='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
 
  $.ajax({ 
    url: "slsdtlunit_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#slsdtlunit tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#slsdtlunit tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendslsdtlunit(n1,n2) 
 {
     window.opener.document.getElementById('slsdtlunit_idslsdtl').value=n1;
     window.opener.document.getElementById('slsdtlunit').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from slsdtlunit where idslsdtlunit like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/slsdtlunit.js"></script> 
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
 <th>idslsdtl</th>
<th>cost_price</th>
<th>qty</th>
<th>sales_price</th>
<th>slshdrunit_idslshdr</th>
<th>product_idproduct</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data slsdtlunit 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idslsdtl'];?></td>
<td><? echo $row['cost_price'];?></td>
<td><? echo $row['qty'];?></td>
<td><? echo $row['sales_price'];?></td>
<td><? echo $row['slshdrunit_idslshdr'];?></td>
<td><? echo $row['product_idproduct'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendslsdtlunit('<? echo $row['idslsdtl'];?>','<? echo $row['slsdtlunit'];?>  ' )"></td>
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
