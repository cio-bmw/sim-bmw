 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
  var vcomp = $("select#idcompany").val();
   var vgroup = $("select#idgroupacc").val();  
   
   dataString = 'starting='+page+'&accname='+cari+'&comp='+vcomp+'&grup='+vgroup+ '&random='+Math.random(); 
 
  
   
  $.ajax({ 
    url:"glhdr_lovacc.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data acc, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vcomp = $("select#idcompany").val(); 
  var vgroup = $("select#idgroupacc").val(); 
   
  dataString = 'accname='+cari+'&comp='+vcomp+'&grup='+vgroup; 
 
  $.ajax({ 
    url: "glhdr_lovacc.php", //file tempat pemrosesan permintaan (request) 
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
  $('#acc tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#acc tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendacc(n1,n2) 
 {
 	
  if ( $("input#idacc1").val() == '')    {    
     document.getElementById('idacc1').value=n1;
     document.getElementById('accname1').value=n2;
     document.getElementById('debet1').focus();
  }  else if ( $("input#idacc2").val() == '') {    
     document.getElementById('idacc2').value=n1;
     document.getElementById('accname2').value=n2;
     document.getElementById('debet2').focus();
  } else if ( $("input#idacc3").val() == '')   {
     document.getElementById('idacc3').value=n1;
     document.getElementById('accname3').value=n2;
     document.getElementById('debet3').focus();
  } else {
     document.getElementById('idacc4').value=n1;
     document.getElementById('accname4').value=n2;
     document.getElementById('debet4').focus();
 	
  }

 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 

$grup = $_GET['grup'];
$comp = $_GET['comp'];
$cpx =companyinfo($comp);
$company = $cpx['company'];
if ($grup == '') {$grup='%';} 

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
	<p class="judul">Daftar Account</p>  
  
  <table style="min-width:300px;">  
  <tr> 
 <th>idacc</th>
<th>accname</th>
<th>Aksi</th> 
  </tr> 
<?php 

if ($grup =='%' ) {
$sql = "select * from acc where company_idcompany = '$comp'";  
} else { 
$sql = "select * from acc where company_idcompany = '$comp' and groupacc_idgroupacc = '$grup' ";  
}
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
$result = $obj->result; 		
		
		//menampilkan data acc 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idacc'];?></td>
<td><? echo $row['accname'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendacc('<? echo $row['idacc'];?>','<? echo $row['accname'];?>  ' )"></td>
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
