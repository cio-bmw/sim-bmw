 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   

dataString = 'starting='+page+'&suppname='+cari+'&random='+Math.random(); 
 
   
  $.ajax({ 
    url:"supplier_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data supplier, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
  
      dataString = 'suppname='+ cari; 
 
 
  $.ajax({ 
    url: "supplier_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#supplier tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#supplier tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendsupplier(n1,n2) 
 {
          document.getElementById('supplier_idsupp').value=n1;
          document.getElementById('suppname').value=n2;
          $('#divLOV').hide();
 } 
 
$("#btncarilov").click(function(){ 
		pagelov="supplier_lov.php?fieldcari="+$('input#fieldcarilov').val(); 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	});  
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcarilov = $_GET['fieldcari']; 
 
$sql = "select * from supplier where suppname like '%".$fieldcarilov."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
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
	<p class="judul"> 
	Daftar Supplier :  <input size=10 type="text" name="fieldcarilov" id="fieldcarilov" value="<? echo $fieldcarilov; ?>" />  
	<input class="button"  type="button" id="btncarilov" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>   
	 
	<table width="400px">  
  <tr> 
 <th>Kode <? echo $fieldcarilov; ?></th>
<th>Supplier</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data supplier 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idsupp'];?></td>
<td><? echo $row['suppname'];?></td>

<td><input class="button" type=button value="Pilih" onClick="sendsupplier('<? echo $row['idsupp'];?>','<? echo $row['suppname'];?>  ' )"></td>
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
