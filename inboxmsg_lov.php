 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idinboxmsg"){ 
    dataString = 'starting='+page+'&idinboxmsg='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "status"){ 
    dataString = 'starting='+page+'&status='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "msg"){ 
    dataString = 'starting='+page+'&msg='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "inboxdate"){ 
    dataString = 'starting='+page+'&inboxdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idempfrom"){ 
    dataString = 'starting='+page+'&emp_idempfrom='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idempto"){ 
    dataString = 'starting='+page+'&emp_idempto='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"inboxmsg_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data inboxmsg, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idinboxmsg"){ 
      dataString = 'idinboxmsg='+ cari;  
   } 
   else if (combo == "status"){ 
      dataString = 'status='+ cari; 
    } 
   else if (combo == "msg"){ 
      dataString = 'msg='+ cari; 
    } 
   else if (combo == "inboxdate"){ 
      dataString = 'inboxdate='+ cari; 
    } 
   else if (combo == "emp_idempfrom"){ 
      dataString = 'emp_idempfrom='+ cari; 
    } 
   else if (combo == "emp_idempto"){ 
      dataString = 'emp_idempto='+ cari; 
    } 
 
  $.ajax({ 
    url: "inboxmsg_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#inboxmsg tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#inboxmsg tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendinboxmsg(n1,n2) 
 {
     window.opener.document.getElementById('inboxmsg_idinboxmsg').value=n1;
     window.opener.document.getElementById('inboxmsg').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from inboxmsg where idinboxmsg like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/inboxmsg.js"></script> 
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
 <th>idinboxmsg</th>
<th>status</th>
<th>msg</th>
<th>inboxdate</th>
<th>emp_idempfrom</th>
<th>emp_idempto</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data inboxmsg 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idinboxmsg'];?></td>
<td><? echo $row['status'];?></td>
<td><? echo $row['msg'];?></td>
<td><? echo $row['inboxdate'];?></td>
<td><? echo $row['emp_idempfrom'];?></td>
<td><? echo $row['emp_idempto'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendinboxmsg('<? echo $row['idinboxmsg'];?>','<? echo $row['inboxmsg'];?>  ' )"></td>
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
