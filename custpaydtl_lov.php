 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcustpaydtl"){ 
    dataString = 'starting='+page+'&idcustpaydtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pay_value"){ 
    dataString = 'starting='+page+'&pay_value='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "custpayhdr_idcustpayhdr"){ 
    dataString = 'starting='+page+'&custpayhdr_idcustpayhdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unitmstpayment_idpayment"){ 
    dataString = 'starting='+page+'&unitmstpayment_idpayment='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"custpaydtl_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data custpaydtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcustpaydtl"){ 
      dataString = 'idcustpaydtl='+ cari;  
   } 
   else if (combo == "pay_value"){ 
      dataString = 'pay_value='+ cari; 
    } 
   else if (combo == "custpayhdr_idcustpayhdr"){ 
      dataString = 'custpayhdr_idcustpayhdr='+ cari; 
    } 
   else if (combo == "unitmstpayment_idpayment"){ 
      dataString = 'unitmstpayment_idpayment='+ cari; 
    } 
 
  $.ajax({ 
    url: "custpaydtl_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#custpaydtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#custpaydtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendcustpaydtl(n1,n2) 
 {
     window.opener.document.getElementById('custpaydtl_idcustpaydtl').value=n1;
     window.opener.document.getElementById('custpaydtl').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from custpaydtl where idcustpaydtl like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/custpaydtl.js"></script> 
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
 <th>idcustpaydtl</th>
<th>pay_value</th>
<th>custpayhdr_idcustpayhdr</th>
<th>unitmstpayment_idpayment</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data custpaydtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcustpaydtl'];?></td>
<td><? echo $row['pay_value'];?></td>
<td><? echo $row['custpayhdr_idcustpayhdr'];?></td>
<td><? echo $row['unitmstpayment_idpayment'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendcustpaydtl('<? echo $row['idcustpaydtl'];?>','<? echo $row['custpaydtl'];?>  ' )"></td>
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
