 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpaymentdtl"){ 
    dataString = 'starting='+page+'&idpaymentdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pay_value"){ 
    dataString = 'starting='+page+'&pay_value='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "receivehdr_idreceivehdr"){ 
    dataString = 'starting='+page+'&receivehdr_idreceivehdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "receive_paymenthdr_idpaymenthdr"){ 
    dataString = 'starting='+page+'&receive_paymenthdr_idpaymenthdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"receive_paymentdtl_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receive_paymentdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpaymentdtl"){ 
      dataString = 'idpaymentdtl='+ cari;  
   } 
   else if (combo == "pay_value"){ 
      dataString = 'pay_value='+ cari; 
    } 
   else if (combo == "receivehdr_idreceivehdr"){ 
      dataString = 'receivehdr_idreceivehdr='+ cari; 
    } 
   else if (combo == "receive_paymenthdr_idpaymenthdr"){ 
      dataString = 'receive_paymenthdr_idpaymenthdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "receive_paymentdtl_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receive_paymentdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receive_paymentdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendreceive_paymentdtl(n1,n2) 
 {
     document.getElementById('receive_paymentdtl_idpaymentdtl').value=n1;
     document.getElementById('receive_paymentdtl').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from receive_paymentdtl where idreceive_paymentdtl like '%".$fieldcari."%'";  
 
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
	<form method="post" name="receive_paymentdtl_lov" action="" id="receive_paymentdtl_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idpaymentdtl</th>
<th>pay_value</th>
<th>receivehdr_idreceivehdr</th>
<th>receive_paymenthdr_idpaymenthdr</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receive_paymentdtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idpaymentdtl'];?></td>
<td><? echo $row['pay_value'];?></td>
<td><? echo $row['receivehdr_idreceivehdr'];?></td>
<td><? echo $row['receive_paymenthdr_idpaymenthdr'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendreceive_paymentdtl('<? echo $row['idpaymentdtl'];?>','<? echo $row['receive_paymentdtl'];?>  ' )"></td>
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
