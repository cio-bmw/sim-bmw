 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#unit_idunit").val(); 

   
 dataString = 'starting='+page+'&idunit='+cari+'&random='+Math.random(); 
   
   
  $.ajax({ 
    url:"unitar_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitar, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#unit_idunit").val(); 
 
  dataString = 'idunit='+ cari; 
   
  $.ajax({ 
    url: "unitar_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitar tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitar tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendunitar(n1,n2) 
 {
document.getElementById('unitmstpayment_idpayment').value=n1;
document.getElementById('paymentdesc').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$idunit = $_POST['idunit']; 
 
  $sql = "select * from unitar where unit_idunit = '".$idunit."'  order by  unitmstpayment_idpayment  ";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
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
	</head> 
	<body> 
	<form method="post" name="agama_lov" action="" id="agama_lov">  
	<table>  
	<tr><td colspan=5 > <? echo 'unit:'.$idunit; ?>
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>idunitar</th>
<th>duedate</th>
<th>unitmstpayment_idpayment</th>
<th>value</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitar 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  		 		 $payment=unitmstpaymentinfo($row['unitmstpayment_idpayment']);
	$paymentdesc = $payment['paymentdesc'];
   			
  			 ?>		 
       <tr> 
 <td><? echo $row['idunitar'];?></td>
<td><? echo $row['duedate'];?></td>
<td><? echo $paymentdesc;?></td>
<td class="right"><? echo nf($row['value']);?></td>

 
<td><input class="button" type=button value="Pilih" onClick="sendunitar('<? echo $row['unitmstpayment_idpayment'];?>','<? echo $paymentdesc;?>  ' )"></td>
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
