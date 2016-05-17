 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtasklist"){ 
    dataString = 'starting='+page+'&idtasklist='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "project_idproject"){ 
    dataString = 'starting='+page+'&project_idproject='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "taskname"){ 
    dataString = 'starting='+page+'&taskname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "keterangan"){ 
    dataString = 'starting='+page+'&keterangan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "startdate"){ 
    dataString = 'starting='+page+'&startdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "enddate"){ 
    dataString = 'starting='+page+'&enddate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "finishdate"){ 
    dataString = 'starting='+page+'&finishdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "files"){ 
    dataString = 'starting='+page+'&files='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "taskstatus"){ 
    dataString = 'starting='+page+'&taskstatus='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"tasklist_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data tasklist, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtasklist"){ 
      dataString = 'idtasklist='+ cari;  
   } 
   else if (combo == "project_idproject"){ 
      dataString = 'project_idproject='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
   else if (combo == "taskname"){ 
      dataString = 'taskname='+ cari; 
    } 
   else if (combo == "keterangan"){ 
      dataString = 'keterangan='+ cari; 
    } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "enddate"){ 
      dataString = 'enddate='+ cari; 
    } 
   else if (combo == "finishdate"){ 
      dataString = 'finishdate='+ cari; 
    } 
   else if (combo == "files"){ 
      dataString = 'files='+ cari; 
    } 
   else if (combo == "taskstatus"){ 
      dataString = 'taskstatus='+ cari; 
    } 
 
  $.ajax({ 
    url: "tasklist_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#tasklist tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#tasklist tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendtasklist(n1,n2) 
 {
     document.getElementById('tasklist_idtasklist').value=n1;
     document.getElementById('tasklist').value=n2;
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from tasklist where idtasklist like '%".$fieldcari."%'";  
 
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
	<p class="judul">Daftar tasklist</p>  
	<p>
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>   
	<form method="post" name="tasklist_lov" action="" id="tasklist_lov">  
	<table>  
  <tr> 
 <th>idtasklist</th>
<th>project_idproject</th>
<th>emp_idemp</th>
<th>taskname</th>
<th>keterangan</th>
<th>startdate</th>
<th>enddate</th>
<th>finishdate</th>
<th>files</th>
<th>taskstatus</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data tasklist 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtasklist'];?></td>
<td><? echo $row['project_idproject'];?></td>
<td><? echo $row['emp_idemp'];?></td>
<td><? echo $row['taskname'];?></td>
<td><? echo $row['keterangan'];?></td>
<td><? echo $row['startdate'];?></td>
<td><? echo $row['enddate'];?></td>
<td><? echo $row['finishdate'];?></td>
<td><? echo $row['files'];?></td>
<td><? echo $row['taskstatus'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendtasklist('<? echo $row['idtasklist'];?>','<? echo $row['tasklist'];?>  ' )"></td>
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
