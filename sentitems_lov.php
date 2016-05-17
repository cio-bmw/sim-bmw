 <script type="text/javascript">  
 
function pagination1(page){ 
  var vcari = $("input#carilov").val(); 
   
    dataString = 'starting='+page+'&cari='+vcari+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"sentitems_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sentitems, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vcari = $("input#carilov").val(); 
   
      dataString = 'cari='+ vcari; 
 
  $.ajax({ 
    url: "sentitems_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sentitems tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sentitems tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
  $("#btncari").click(function(){  
  		page1="sentitems_lov.php?cari="+$("input#carilov").val();  
  		$("#divLOV").load(page1);  
  		$("#divLOV").show();  
     	return false;  
  	});   
	 
}); 
 
 function sendsentitems(n1,n2) 
 {
     document.getElementById('sentitems_UpdatedInDB').value=n1;
     document.getElementById('sentitems').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$cari = $_GET['cari']; 
 
  $sql = "select * from sentitems where idsentitems like '%".$cari."%'";  
 
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
	<p class="judul">Daftar sentitems</p>  
	<p>
	<form method="post" name="sentitems_lov" action="" id="sentitems_lov">  
	Cari Data : <input size=10 type="text" name="carilov" id="carilov" value="<? echo $cari; ?>" />  
	<input class="button"  type="button" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>   
	</form>   
	<table>  
  <tr> 
 <th>UpdatedInDB</th>
<th>InsertIntoDB</th>
<th>SendingDateTime</th>
<th>DeliveryDateTime</th>
<th>Text</th>
<th>DestinationNumber</th>
<th>Coding</th>
<th>UDH</th>
<th>SMSCNumber</th>
<th>Class</th>
<th>TextDecoded</th>
<th>ID</th>
<th>SenderID</th>
<th>SequencePosition</th>
<th>Status</th>
<th>StatusError</th>
<th>TPMR</th>
<th>RelativeValidity</th>
<th>CreatorID</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sentitems 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['UpdatedInDB'];?></td>
<td><? echo $row['InsertIntoDB'];?></td>
<td><? echo $row['SendingDateTime'];?></td>
<td><? echo $row['DeliveryDateTime'];?></td>
<td><? echo $row['Text'];?></td>
<td><? echo $row['DestinationNumber'];?></td>
<td><? echo $row['Coding'];?></td>
<td><? echo $row['UDH'];?></td>
<td><? echo $row['SMSCNumber'];?></td>
<td><? echo $row['Class'];?></td>
<td><? echo $row['TextDecoded'];?></td>
<td><? echo $row['ID'];?></td>
<td><? echo $row['SenderID'];?></td>
<td><? echo $row['SequencePosition'];?></td>
<td><? echo $row['Status'];?></td>
<td><? echo $row['StatusError'];?></td>
<td><? echo $row['TPMR'];?></td>
<td><? echo $row['RelativeValidity'];?></td>
<td><? echo $row['CreatorID'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendsentitems('<? echo $row['UpdatedInDB'];?>','<? echo $row['sentitems'];?>  ' )"></td>
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
