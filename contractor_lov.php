 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcontractor"){ 
    dataString = 'starting='+page+'&idcontractor='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "contractorname"){ 
    dataString = 'starting='+page+'&contractorname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "contactno"){ 
    dataString = 'starting='+page+'&contactno='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "contactname"){ 
    dataString = 'starting='+page+'&contactname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "address"){ 
    dataString = 'starting='+page+'&address='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "bankname"){ 
    dataString = 'starting='+page+'&bankname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rekno"){ 
    dataString = 'starting='+page+'&rekno='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"contractor_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data contractor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcontractor"){ 
      dataString = 'idcontractor='+ cari;  
   } 
   else if (combo == "contractorname"){ 
      dataString = 'contractorname='+ cari; 
    } 
   else if (combo == "contactno"){ 
      dataString = 'contactno='+ cari; 
    } 
   else if (combo == "contactname"){ 
      dataString = 'contactname='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "bankname"){ 
      dataString = 'bankname='+ cari; 
    } 
   else if (combo == "rekno"){ 
      dataString = 'rekno='+ cari; 
    } 
 
  $.ajax({ 
    url: "contractor_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#contractor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#contractor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendcontractor(n1,n2) 
 {
     document.getElementById('contractor_idcontractor').value=n1;
     document.getElementById('contractorname').value=n2;
     
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from contractor where idcontractor like '%".$fieldcari."%'";  
 
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
	<p class="judul">Daftar Contractor</p>
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>Kode</th>
<th>Nama Contractor</th>

<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data contractor 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcontractor'];?></td>
<td><? echo $row['contractorname'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendcontractor('<? echo $row['idcontractor'];?>','<? echo $row['contractorname'];?>  ' )"></td>
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
