 <script type="text/javascript">  

function pagination1(page){ 
var dataString; 
var vcari = $("input#fieldcari").val(); 
var vidunit = $("input#idunit").val(); 
 
 	
 dataString = 'starting='+page+'&cari='+vcari+'&idunit='+vidunit+'&random='+Math.random(); 

  $.ajax({ 
    url:"unitmstpayment_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
	
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitmstpayment, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
var dataString; 
var vcari = $("input#fieldcari").val(); 
var vidunit = $("input#idunit").val(); 
 
 
dataString = 'cari='+ vcari+'&idunit='+vidunit; 
   
 
  $.ajax({ 
    url: "unitmstpayment_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitmstpayment tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitmstpayment tr:odd:not(#nav):not(#total)').addClass('odd'); 
  $("a.pilih").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageEntry").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageEntry").show(); 
		
     
    return false; 
		
		
	}); 
	
$("#btncari").click(function(){ 

	  	page="unitmstpayment_lov.php?cari="+$("input#fieldcari").val()+'&idunit='+$("input#idunit").val()
		$("#divLOV").load(page); 
		$("#divLOV").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	
 
	 
}); 


 
 </script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_GET['cari']; 
$idunit = $_GET['idunit']; 
 
$sql = "select * from unitmstpayment where paymentdesc like '%".$fieldcari."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
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
	<form method="post" name="agama_lov" action="" id="agama_lov">  
	<table width="450px">  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="<? echo $fieldcari;?>" />  
	<input class="button"  type="button" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>Kode</th>
<th>Keterangan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitmstpayment 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idpayment'];?></td>
<td><? echo $row['paymentdesc'];?></td>
 
	<td><a href="unitar_form.php?idpayment=<? echo $row['idpayment'];?>&idunit=<? echo $idunit; ?>" class="pilih"><input class="button" type="button" value="Pilih"></a></td></tr> 


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
