 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idproduct"){ 
    dataString = 'starting='+page+'&idproduct='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "productname"){ 
    dataString = 'starting='+page+'&productname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "uom_iduom"){ 
    dataString = 'starting='+page+'&uom_iduom='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "category_idcat"){ 
    dataString = 'starting='+page+'&category_idcat='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "supplier_idsupp"){ 
    dataString = 'starting='+page+'&supplier_idsupp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "location_idlocation"){ 
    dataString = 'starting='+page+'&location_idlocation='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "salesprice"){ 
    dataString = 'starting='+page+'&salesprice='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "costprice"){ 
    dataString = 'starting='+page+'&costprice='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "stock"){ 
    dataString = 'starting='+page+'&stock='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "stockwh"){ 
    dataString = 'starting='+page+'&stockwh='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "limitstock"){ 
    dataString = 'starting='+page+'&limitstock='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "limitstockwh"){ 
    dataString = 'starting='+page+'&limitstockwh='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "status"){ 
    dataString = 'starting='+page+'&status='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "active"){ 
    dataString = 'starting='+page+'&active='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "boxqty"){ 
    dataString = 'starting='+page+'&boxqty='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"product_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data product, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idproduct"){ 
      dataString = 'idproduct='+ cari;  
   } 
   else if (combo == "productname"){ 
      dataString = 'productname='+ cari; 
    } 
   else if (combo == "uom_iduom"){ 
      dataString = 'uom_iduom='+ cari; 
    } 
   else if (combo == "category_idcat"){ 
      dataString = 'category_idcat='+ cari; 
    } 
   else if (combo == "supplier_idsupp"){ 
      dataString = 'supplier_idsupp='+ cari; 
    } 
   else if (combo == "location_idlocation"){ 
      dataString = 'location_idlocation='+ cari; 
    } 
   else if (combo == "salesprice"){ 
      dataString = 'salesprice='+ cari; 
    } 
   else if (combo == "costprice"){ 
      dataString = 'costprice='+ cari; 
    } 
   else if (combo == "stock"){ 
      dataString = 'stock='+ cari; 
    } 
   else if (combo == "stockwh"){ 
      dataString = 'stockwh='+ cari; 
    } 
   else if (combo == "limitstock"){ 
      dataString = 'limitstock='+ cari; 
    } 
   else if (combo == "limitstockwh"){ 
      dataString = 'limitstockwh='+ cari; 
    } 
   else if (combo == "status"){ 
      dataString = 'status='+ cari; 
    } 
   else if (combo == "active"){ 
      dataString = 'active='+ cari; 
    } 
   else if (combo == "boxqty"){ 
      dataString = 'boxqty='+ cari; 
    } 
 
  $.ajax({ 
    url: "product_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#product tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#product tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendproduct(n1,n2) 
 {
     window.opener.document.getElementById('product_idproduct').value=n1;
     window.opener.document.getElementById('product').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from product where idproduct like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/agama.js"></script> 
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
 <th>idproduct</th>
<th>productname</th>
<th>uom_iduom</th>
<th>category_idcat</th>
<th>supplier_idsupp</th>
<th>location_idlocation</th>
<th>salesprice</th>
<th>costprice</th>
<th>stock</th>
<th>stockwh</th>
<th>limitstock</th>
<th>limitstockwh</th>
<th>status</th>
<th>active</th>
<th>boxqty</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data product 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idproduct'];?></td>
<td><? echo $row['productname'];?></td>
<td><? echo $row['uom_iduom'];?></td>
<td><? echo $row['category_idcat'];?></td>
<td><? echo $row['supplier_idsupp'];?></td>
<td><? echo $row['location_idlocation'];?></td>
<td><? echo $row['salesprice'];?></td>
<td><? echo $row['costprice'];?></td>
<td><? echo $row['stock'];?></td>
<td><? echo $row['stockwh'];?></td>
<td><? echo $row['limitstock'];?></td>
<td><? echo $row['limitstockwh'];?></td>
<td><? echo $row['status'];?></td>
<td><? echo $row['active'];?></td>
<td><? echo $row['boxqty'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendproduct('<? echo $row['idagama'];?>','<? echo $row['agama'];?>  ' )"></td>
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
