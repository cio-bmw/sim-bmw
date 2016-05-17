 <script type="text/javascript">  
 
function pagination1(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
  var vcomp = $("select#idcompany").val(); 
   
   dataString = 'starting='+page+'&accname='+cari+'&comp='+vcomp+'&random='+Math.random(); 
 
  
   
  $.ajax({ 
    url:"accbudget_lovacc.php", 
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
  var vcari = $("input#fieldcari").val(); 
  var vcomp = $("select#idcompany").val(); 
   
  dataString = 'accname='+cari+'&comp='+vcomp; 
 
  $.ajax({ 
    url: "accbudget_lovacc.php", //file tempat pemrosesan permintaan (request) 
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
 
	$("a.pilih").click(function(){ 
		el=$(this); 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						$("#divPageData").load("pldtl_display.php?id="+$("input#idplhdr").val()); 
            //     alert("Data pldtl berhasil di Tambahkan!"); 
					} 
					else{ 
						alert("data pldtl gagal di hapus!"); 
					} 
				} 
			}); 
		
		return false; 
	});  

   
	 
}); 
function sendacc(n1,n2) 
 {
     document.getElementById('acc_idacc').value=n1;
     document.getElementById('accname').value=n2;
     document.getElementById('budget').focus();

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
$id=$_GET['id'];
if ($grup=='') {$grup='%';}


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
	<table>  
  <tr> 
 <th>idacc</th>
<th>accname</th>
<th>Aksi</th> 
  </tr> 
		<?php 
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
