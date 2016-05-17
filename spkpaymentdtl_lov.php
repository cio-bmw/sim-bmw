 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idspkpaymentdtl"){ 
    dataString = 'starting='+page+'&idspkpaymentdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "payvalue"){ 
    dataString = 'starting='+page+'&payvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "spkpaymenthdr_idspkpaymenthdr"){ 
    dataString = 'starting='+page+'&spkpaymenthdr_idspkpaymenthdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unitspk_idunitspk"){ 
    dataString = 'starting='+page+'&unitspk_idunitspk='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"spkpaymentdtl_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data spkpaymentdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idspkpaymentdtl"){ 
      dataString = 'idspkpaymentdtl='+ cari;  
   } 
   else if (combo == "payvalue"){ 
      dataString = 'payvalue='+ cari; 
    } 
   else if (combo == "spkpaymenthdr_idspkpaymenthdr"){ 
      dataString = 'spkpaymenthdr_idspkpaymenthdr='+ cari; 
    } 
   else if (combo == "unitspk_idunitspk"){ 
      dataString = 'unitspk_idunitspk='+ cari; 
    } 
 
  $.ajax({ 
    url: "spkpaymentdtl_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#spkpaymentdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#spkpaymentdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendspkpaymentdtl(n1,n2) 
 {
     document.getElementById('spkpaymentdtl_idspkpaymentdtl').value=n1;
     document.getElementById('spkpaymentdtl').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from spkpaymentdtl where idspkpaymentdtl like '%".$fieldcari."%'";  
 
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
	<form method="post" name="agama_lov" action="" id="agama_lov">  
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idspkpaymentdtl</th>
<th>payvalue</th>
<th>spkpaymenthdr_idspkpaymenthdr</th>
<th>unitspk_idunitspk</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data spkpaymentdtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idspkpaymentdtl'];?></td>
<td><? echo $row['payvalue'];?></td>
<td><? echo $row['spkpaymenthdr_idspkpaymenthdr'];?></td>
<td><? echo $row['unitspk_idunitspk'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendspkpaymentdtl('<? echo $row['idspkpaymentdtl'];?>','<? echo $row['spkpaymentdtl'];?>  ' )"></td>
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
