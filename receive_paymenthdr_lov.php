 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpaymenthdr"){ 
    dataString = 'starting='+page+'&idpaymenthdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pay_date"){ 
    dataString = 'starting='+page+'&pay_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pay_name"){ 
    dataString = 'starting='+page+'&pay_name='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pay_note"){ 
    dataString = 'starting='+page+'&pay_note='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "supplier_idsupp"){ 
    dataString = 'starting='+page+'&supplier_idsupp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"receive_paymenthdr_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receive_paymenthdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpaymenthdr"){ 
      dataString = 'idpaymenthdr='+ cari;  
   } 
   else if (combo == "pay_date"){ 
      dataString = 'pay_date='+ cari; 
    } 
   else if (combo == "pay_name"){ 
      dataString = 'pay_name='+ cari; 
    } 
   else if (combo == "pay_note"){ 
      dataString = 'pay_note='+ cari; 
    } 
   else if (combo == "supplier_idsupp"){ 
      dataString = 'supplier_idsupp='+ cari; 
    } 
 
  $.ajax({ 
    url: "receive_paymenthdr_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receive_paymenthdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receive_paymenthdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendreceive_paymenthdr(n1,n2) 
 {
     document.getElementById('receive_paymenthdr_idpaymenthdr').value=n1;
     document.getElementById('receive_paymenthdr').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from receive_paymenthdr where idreceive_paymenthdr like '%".$fieldcari."%'";  
 
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
	<form method="post" name="receive_paymenthdr_lov" action="" id="receive_paymenthdr_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idpaymenthdr</th>
<th>pay_date</th>
<th>pay_name</th>
<th>pay_note</th>
<th>supplier_idsupp</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receive_paymenthdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idpaymenthdr'];?></td>
<td><? echo $row['pay_date'];?></td>
<td><? echo $row['pay_name'];?></td>
<td><? echo $row['pay_note'];?></td>
<td><? echo $row['supplier_idsupp'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendreceive_paymenthdr('<? echo $row['idpaymenthdr'];?>','<? echo $row['receive_paymenthdr'];?>  ' )"></td>
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
