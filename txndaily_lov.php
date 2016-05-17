 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxndaily"){ 
    dataString = 'starting='+page+'&idtxndaily='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "txndate"){ 
    dataString = 'starting='+page+'&txndate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txndesc"){ 
    dataString = 'starting='+page+'&txndesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "dvalue"){ 
    dataString = 'starting='+page+'&dvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kvalue"){ 
    dataString = 'starting='+page+'&kvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "saldo"){ 
    dataString = 'starting='+page+'&saldo='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnflag"){ 
    dataString = 'starting='+page+'&txnflag='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnpos_idtxnpos"){ 
    dataString = 'starting='+page+'&txnpos_idtxnpos='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnalokasi_idtxnalokasi"){ 
    dataString = 'starting='+page+'&txnalokasi_idtxnalokasi='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"txndaily_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data txndaily, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxndaily"){ 
      dataString = 'idtxndaily='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "dvalue"){ 
      dataString = 'dvalue='+ cari; 
    } 
   else if (combo == "kvalue"){ 
      dataString = 'kvalue='+ cari; 
    } 
   else if (combo == "saldo"){ 
      dataString = 'saldo='+ cari; 
    } 
   else if (combo == "txnflag"){ 
      dataString = 'txnflag='+ cari; 
    } 
   else if (combo == "txnpos_idtxnpos"){ 
      dataString = 'txnpos_idtxnpos='+ cari; 
    } 
   else if (combo == "txnalokasi_idtxnalokasi"){ 
      dataString = 'txnalokasi_idtxnalokasi='+ cari; 
    } 
 
  $.ajax({ 
    url: "txndaily_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#txndaily tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#txndaily tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendtxndaily(n1,n2) 
 {
     document.getElementById('txndaily_idtxndaily').value=n1;
     document.getElementById('txndaily').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from txndaily where idtxndaily like '%".$fieldcari."%'";  
 
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
	<form method="post" name="txndaily_lov" action="" id="txndaily_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idtxndaily</th>
<th>txndate</th>
<th>txndesc</th>
<th>dvalue</th>
<th>kvalue</th>
<th>saldo</th>
<th>txnflag</th>
<th>txnpos_idtxnpos</th>
<th>txnalokasi_idtxnalokasi</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data txndaily 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtxndaily'];?></td>
<td><? echo $row['txndate'];?></td>
<td><? echo $row['txndesc'];?></td>
<td><? echo $row['dvalue'];?></td>
<td><? echo $row['kvalue'];?></td>
<td><? echo $row['saldo'];?></td>
<td><? echo $row['txnflag'];?></td>
<td><? echo $row['txnpos_idtxnpos'];?></td>
<td><? echo $row['txnalokasi_idtxnalokasi'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendtxndaily('<? echo $row['idtxndaily'];?>','<? echo $row['txndaily'];?>  ' )"></td>
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
