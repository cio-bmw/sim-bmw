 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashbook"){ 
    dataString = 'starting='+page+'&idcashbook='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "txndate"){ 
    dataString = 'starting='+page+'&txndate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnflag"){ 
    dataString = 'starting='+page+'&txnflag='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnvalue"){ 
    dataString = 'starting='+page+'&txnvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "saldo"){ 
    dataString = 'starting='+page+'&saldo='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txndesc"){ 
    dataString = 'starting='+page+'&txndesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "idcashin"){ 
    dataString = 'starting='+page+'&idcashin='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "idcashouthdr"){ 
    dataString = 'starting='+page+'&idcashouthdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"cashbook_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data cashbook, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashbook"){ 
      dataString = 'idcashbook='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txnflag"){ 
      dataString = 'txnflag='+ cari; 
    } 
   else if (combo == "txnvalue"){ 
      dataString = 'txnvalue='+ cari; 
    } 
   else if (combo == "saldo"){ 
      dataString = 'saldo='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "idcashin"){ 
      dataString = 'idcashin='+ cari; 
    } 
   else if (combo == "idcashouthdr"){ 
      dataString = 'idcashouthdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "cashbook_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#cashbook tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#cashbook tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendcashbook(n1,n2) 
 {
     window.opener.document.getElementById('cashbook_idcashbook').value=n1;
     window.opener.document.getElementById('cashbook').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from cashbook where idcashbook like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/cashbook.js"></script> 
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
 <th>idcashbook</th>
<th>txndate</th>
<th>txnflag</th>
<th>txnvalue</th>
<th>saldo</th>
<th>txndesc</th>
<th>idcashin</th>
<th>idcashouthdr</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data cashbook 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcashbook'];?></td>
<td><? echo $row['txndate'];?></td>
<td><? echo $row['txnflag'];?></td>
<td><? echo $row['txnvalue'];?></td>
<td><? echo $row['saldo'];?></td>
<td><? echo $row['txndesc'];?></td>
<td><? echo $row['idcashin'];?></td>
<td><? echo $row['idcashouthdr'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendcashbook('<? echo $row['idcashbook'];?>','<? echo $row['cashbook'];?>  ' )"></td>
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
