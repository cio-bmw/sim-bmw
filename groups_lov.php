 <script type="text/javascript">  
 
function pagination1(page){ 
  var vcari = $("input#carilov").val(); 
   
    dataString = 'starting='+page+'&cari='+vcari+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"groups_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data groups, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vcari = $("input#carilov").val(); 
   
      dataString = 'cari='+ vcari; 
 
  $.ajax({ 
    url: "groups_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#groups tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#groups tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
  $("#btncari").click(function(){  
  		page1="groups_lov.php?cari="+$("input#carilov").val();  
  		$("#divLOV").load(page1);  
  		$("#divLOV").show();  
     	return false;  
  	});   
	 
}); 
 
 function sendgroups(n1,n2) 
 {
     document.getElementById('groups_group_id').value=n1;
     document.getElementById('groups').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$cari = $_GET['cari']; 
 
  $sql = "select * from groups where idgroups like '%".$cari."%'";  
 
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
	<p class="judul">Daftar groups</p>  
	<p>
	<form method="post" name="groups_lov" action="" id="groups_lov">  
	Cari Data : <input size=10 type="text" name="carilov" id="carilov" value="<? echo $cari; ?>" />  
	<input class="button"  type="button" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>   
	</form>   
	<table>  
  <tr> 
 <th>group_id</th>
<th>group_name</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data groups 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['group_id'];?></td>
<td><? echo $row['group_name'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendgroups('<? echo $row['group_id'];?>','<? echo $row['groups'];?>  ' )"></td>
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
