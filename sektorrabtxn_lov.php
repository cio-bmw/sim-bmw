 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxn"){ 
    dataString = 'starting='+page+'&idtxn='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "txndate"){ 
    dataString = 'starting='+page+'&txndate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnvalue"){ 
    dataString = 'starting='+page+'&txnvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txndesc"){ 
    dataString = 'starting='+page+'&txndesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektor_idsektor"){ 
    dataString = 'starting='+page+'&sektor_idsektor='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rabmst_idrabmst"){ 
    dataString = 'starting='+page+'&rabmst_idrabmst='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"sektorrabtxn_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektorrabtxn, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxn"){ 
      dataString = 'idtxn='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txnvalue"){ 
      dataString = 'txnvalue='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
   else if (combo == "rabmst_idrabmst"){ 
      dataString = 'rabmst_idrabmst='+ cari; 
    } 
 
  $.ajax({ 
    url: "sektorrabtxn_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sektorrabtxn tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektorrabtxn tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendsektorrabtxn(n1,n2) 
 {
     window.opener.document.getElementById('sektorrabtxn_idtxn').value=n1;
     window.opener.document.getElementById('sektorrabtxn').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from sektorrabtxn where idsektorrabtxn like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/sektorrabtxn.js"></script> 
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
 <th>idtxn</th>
<th>txndate</th>
<th>txnvalue</th>
<th>txndesc</th>
<th>sektor_idsektor</th>
<th>rabmst_idrabmst</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sektorrabtxn 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtxn'];?></td>
<td><? echo $row['txndate'];?></td>
<td><? echo $row['txnvalue'];?></td>
<td><? echo $row['txndesc'];?></td>
<td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $row['rabmst_idrabmst'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendsektorrabtxn('<? echo $row['idtxn'];?>','<? echo $row['sektorrabtxn'];?>  ' )"></td>
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
