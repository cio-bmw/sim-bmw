 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idreceivedtl"){ 
    dataString = 'starting='+page+'&idreceivedtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "product_idproduct"){ 
    dataString = 'starting='+page+'&product_idproduct='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "qty"){ 
    dataString = 'starting='+page+'&qty='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "receive_price"){ 
    dataString = 'starting='+page+'&receive_price='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "dtl_ppn"){ 
    dataString = 'starting='+page+'&dtl_ppn='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "receive_priceppn"){ 
    dataString = 'starting='+page+'&receive_priceppn='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "receive_pricedisc"){ 
    dataString = 'starting='+page+'&receive_pricedisc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "dtl_percent"){ 
    dataString = 'starting='+page+'&dtl_percent='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "dtl_discount"){ 
    dataString = 'starting='+page+'&dtl_discount='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "receivehdr_idreceivehdr"){ 
    dataString = 'starting='+page+'&receivehdr_idreceivehdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "batch_no"){ 
    dataString = 'starting='+page+'&batch_no='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "exp_date"){ 
    dataString = 'starting='+page+'&exp_date='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"receivedtl_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receivedtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idreceivedtl"){ 
      dataString = 'idreceivedtl='+ cari;  
   } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
   else if (combo == "qty"){ 
      dataString = 'qty='+ cari; 
    } 
   else if (combo == "receive_price"){ 
      dataString = 'receive_price='+ cari; 
    } 
   else if (combo == "dtl_ppn"){ 
      dataString = 'dtl_ppn='+ cari; 
    } 
   else if (combo == "receive_priceppn"){ 
      dataString = 'receive_priceppn='+ cari; 
    } 
   else if (combo == "receive_pricedisc"){ 
      dataString = 'receive_pricedisc='+ cari; 
    } 
   else if (combo == "dtl_percent"){ 
      dataString = 'dtl_percent='+ cari; 
    } 
   else if (combo == "dtl_discount"){ 
      dataString = 'dtl_discount='+ cari; 
    } 
   else if (combo == "receivehdr_idreceivehdr"){ 
      dataString = 'receivehdr_idreceivehdr='+ cari; 
    } 
   else if (combo == "batch_no"){ 
      dataString = 'batch_no='+ cari; 
    } 
   else if (combo == "exp_date"){ 
      dataString = 'exp_date='+ cari; 
    } 
 
  $.ajax({ 
    url: "receivedtl_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receivedtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receivedtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendreceivedtl(n1,n2) 
 {
     window.opener.document.getElementById('receivedtl_idreceivedtl').value=n1;
     window.opener.document.getElementById('receivedtl').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from receivedtl where idreceivedtl like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/receivedtl.js"></script> 
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
 <th>idreceivedtl</th>
<th>product_idproduct</th>
<th>qty</th>
<th>receive_price</th>
<th>dtl_ppn</th>
<th>receive_priceppn</th>
<th>receive_pricedisc</th>
<th>dtl_percent</th>
<th>dtl_discount</th>
<th>receivehdr_idreceivehdr</th>
<th>batch_no</th>
<th>exp_date</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receivedtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idreceivedtl'];?></td>
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $row['qty'];?></td>
<td><? echo $row['receive_price'];?></td>
<td><? echo $row['dtl_ppn'];?></td>
<td><? echo $row['receive_priceppn'];?></td>
<td><? echo $row['receive_pricedisc'];?></td>
<td><? echo $row['dtl_percent'];?></td>
<td><? echo $row['dtl_discount'];?></td>
<td><? echo $row['receivehdr_idreceivehdr'];?></td>
<td><? echo $row['batch_no'];?></td>
<td><? echo $row['exp_date'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendreceivedtl('<? echo $row['idreceivedtl'];?>','<? echo $row['receivedtl'];?>  ' )"></td>
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
