 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var vsektor = $("input#sektor_idsektor").val(); 

    dataString = 'starting='+page+'&sektor='+vsektor+'&random='+Math.random(); 
   
   
  $.ajax({ 
    url:"sektorrab_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektorrab, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var vsektor = $("input#sektor_idsektor").val(); 
 	
      dataString = 'sektor='+ vsektor; 
  
 
  $.ajax({ 
    url: "sektorrab_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sektorrab tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektorrab tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendsektorrab(n1,n2) 
 {
     document.getElementById('rabmst_idrabmst').value=n1;
     document.getElementById('rabdesc').value=n2;
     
 } 
 
$("#btncarilov").click(function(){ 
	
		pagelov="sektorrab_lov.php?id="+$("input#idsektorcosthdr").val()+'&sektor='+$("input#sektor_idsektor").val(); 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 



		return false; 
	});  
 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
$idsektor = $_GET['sektor']; 
 
  $sql = "select * from sektorrab a, rabmst b
   where a.rabmst_idrabmst = b.idrabmst and b.rabdesc like '%$fieldcari%' and sektor_idsektor = '$idsektor'";
  //and sektor_idsektor ='$idsektor'";  
 
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
	<table width="400">  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="button" id="btncarilov" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>Nox</th>
<th>Sektor</th>

<th>RAB Desc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sektorrab 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
      $rabmst = rabmstinfo($row['rabmst_idrabmst']) ;
      $rabdesc = $rabmst['rabdesc']; 			
  			 ?>		 
       <tr> 
 <td><? echo $row['idsektorrab'];?></td>

<td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $rabdesc;?></td>

 
<td><input class="button" type=button value="Pilih" onClick="sendsektorrab('<? echo $row['rabmst_idrabmst'];?>','<? echo $rabdesc;?>  ' )"></td>
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
