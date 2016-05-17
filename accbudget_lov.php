 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaccbudget"){ 
    dataString = 'starting='+page+'&idaccbudget='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "tahun"){ 
    dataString = 'starting='+page+'&tahun='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "bulan"){ 
    dataString = 'starting='+page+'&bulan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "budget"){ 
    dataString = 'starting='+page+'&budget='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "acc_idacc"){ 
    dataString = 'starting='+page+'&acc_idacc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "saldoawal"){ 
    dataString = 'starting='+page+'&saldoawal='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "saldo"){ 
    dataString = 'starting='+page+'&saldo='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"accbudget_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data accbudget, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaccbudget"){ 
      dataString = 'idaccbudget='+ cari;  
   } 
   else if (combo == "tahun"){ 
      dataString = 'tahun='+ cari; 
    } 
   else if (combo == "bulan"){ 
      dataString = 'bulan='+ cari; 
    } 
   else if (combo == "budget"){ 
      dataString = 'budget='+ cari; 
    } 
   else if (combo == "acc_idacc"){ 
      dataString = 'acc_idacc='+ cari; 
    } 
   else if (combo == "saldoawal"){ 
      dataString = 'saldoawal='+ cari; 
    } 
   else if (combo == "saldo"){ 
      dataString = 'saldo='+ cari; 
    } 
 
  $.ajax({ 
    url: "accbudget_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#accbudget tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#accbudget tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendaccbudget(n1,n2) 
 {
     document.getElementById('accbudget_idaccbudget').value=n1;
     document.getElementById('accbudget').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from accbudget where idaccbudget like '%".$fieldcari."%'";  
 
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
	<p class="judul">Daftar accbudget</p>  
	<p>
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>   
	<form method="post" name="accbudget_lov" action="" id="accbudget_lov">  
	<table>  
  <tr> 
 <th>idaccbudget</th>
<th>tahun</th>
<th>bulan</th>
<th>budget</th>
<th>acc_idacc</th>
<th>saldoawal</th>
<th>saldo</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data accbudget 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idaccbudget'];?></td>
<td><? echo $row['tahun'];?></td>
<td><? echo $row['bulan'];?></td>
<td><? echo $row['budget'];?></td>
<td><? echo $row['acc_idacc'];?></td>
<td><? echo $row['saldoawal'];?></td>
<td><? echo $row['saldo'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendaccbudget('<? echo $row['idaccbudget'];?>','<? echo $row['accbudget'];?>  ' )"></td>
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
