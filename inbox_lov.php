 <script type="text/javascript">  
 
function pagination1(page){ 
  var vcari = $("input#carilov").val(); 
   
    dataString = 'starting='+page+'&cari='+vcari+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"inbox_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data inbox, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vcari = $("input#carilov").val(); 
   
      dataString = 'cari='+ vcari; 
 
  $.ajax({ 
    url: "inbox_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#inbox tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#inbox tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
  $("#btncari").click(function(){  
  		page1="inbox_lov.php?cari="+$("input#carilov").val();  
  		$("#divLOV").load(page1);  
  		$("#divLOV").show();  
     	return false;  
  	});   
	 
}); 
 
 function sendinbox(n1,n2) 
 {
     document.getElementById('inbox_UpdatedInDB').value=n1;
     document.getElementById('inbox').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$cari = $_GET['cari']; 
 
  $sql = "select * from inbox where idinbox like '%".$cari."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
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
	<p class="judul">Daftar inbox</p>  
	<p>
	<form method="post" name="inbox_lov" action="" id="inbox_lov">  
	Cari Data : <input size=10 type="text" name="carilov" id="carilov" value="<? echo $cari; ?>" />  
	<input class="button"  type="button" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>   
	</form>   
	<table>  
  <tr> 
 <th>UpdatedInDB</th>
<th>ReceivingDateTime</th>
<th>Text</th>
<th>SenderNumber</th>
<th>Coding</th>
<th>UDH</th>
<th>SMSCNumber</th>
<th>Class</th>
<th>TextDecoded</th>
<th>ID</th>
<th>RecipientID</th>
<th>Processed</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data inbox 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['UpdatedInDB'];?></td>
<td><? echo $row['ReceivingDateTime'];?></td>
<td><? echo $row['Text'];?></td>
<td><? echo $row['SenderNumber'];?></td>
<td><? echo $row['Coding'];?></td>
<td><? echo $row['UDH'];?></td>
<td><? echo $row['SMSCNumber'];?></td>
<td><? echo $row['Class'];?></td>
<td><? echo $row['TextDecoded'];?></td>
<td><? echo $row['ID'];?></td>
<td><? echo $row['RecipientID'];?></td>
<td><? echo $row['Processed'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendinbox('<? echo $row['UpdatedInDB'];?>','<? echo $row['inbox'];?>  ' )"></td>
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
