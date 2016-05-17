 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitarpayment"){ 
    dataString = 'starting='+page+'&idunitarpayment='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pay_value"){ 
    dataString = 'starting='+page+'&pay_value='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unit_idunit"){ 
    dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
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
   else if (combo == "unitmstpayment_idpayment"){ 
    dataString = 'starting='+page+'&unitmstpayment_idpayment='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"unitarpayment_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitarpayment, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitarpayment"){ 
      dataString = 'idunitarpayment='+ cari;  
   } 
   else if (combo == "pay_value"){ 
      dataString = 'pay_value='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
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
   else if (combo == "unitmstpayment_idpayment"){ 
      dataString = 'unitmstpayment_idpayment='+ cari; 
    } 
 
  $.ajax({ 
    url: "unitarpayment_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitarpayment tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitarpayment tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendunitarpayment(n1,n2) 
 {
     window.opener.document.getElementById('unitarpayment_idunitarpayment').value=n1;
     window.opener.document.getElementById('unitarpayment').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from unitarpayment where idunitarpayment like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/unitarpayment.js"></script> 
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
 <th>idunitarpayment</th>
<th>pay_value</th>
<th>unit_idunit</th>
<th>pay_date</th>
<th>pay_name</th>
<th>pay_note</th>
<th>unitmstpayment_idpayment</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitarpayment 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idunitarpayment'];?></td>
<td><? echo $row['pay_value'];?></td>
<td><? echo $row['unit_idunit'];?></td>
<td><? echo $row['pay_date'];?></td>
<td><? echo $row['pay_name'];?></td>
<td><? echo $row['pay_note'];?></td>
<td><? echo $row['unitmstpayment_idpayment'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendunitarpayment('<? echo $row['idunitarpayment'];?>','<? echo $row['unitarpayment'];?>  ' )"></td>
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
