 <script type="text/javascript">  
 
function pagination1(page){ 
 var vcont = $("input#contractor_idcontractor").val(); 
 var vcari = $("input#fieldcari").val(); 
     
  
   dataString = 'starting='+page+'&contractor='+vcont+'&cari='+vcari+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"spkpaymenthdr_lovspk.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitspk, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
   var vcont = $("input#contractor_idcontractor").val(); 
    var vcari = $("input#fieldcari").val(); 
   
	       dataString = 'contractor='+ vcont+'&cari=' + vcari; 
    
 
  $.ajax({ 
    url: "spkpaymenthdr_lovspk.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitspk tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitspk tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendunitspk(n1,n2,n3,n4) 
 {
     document.getElementById('unitspk_idunitspk').value=n1;
     document.getElementById('category').value=n2;
     document.getElementById('kavling').value=n3;
    document.getElementById('payvalue').value=n4;
  document.getElementById('payvalue').focus();
 } 
 
 $("#btncari").click(function(){ 
		loadData();; 
	}); 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$contractor = $_GET['contractor']; 
$cari = $_GET['cari'];
 
$sql = "select * from unitspk a, unit b where a.unit_idunit = b.idunit 
and a.contractor_idcontractor = '$contractor' 
and ( kavling like  '%".$cari."%' or idunitspk like '%".$cari."%')  
order by sektor_idsektor,kavling ";  
 
if(isset($_GET['starting'])){ //starting page ou
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
	<form method="post" name="lovspk" action="" id="lovspk">  
	<p class="judul">Daftar SPK Yang Dikerjakan</p> 
	<table>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="button" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</td></tr>   
  <tr> 
 <th>No SPK</th>
<th>Jenis SPK</th>
<th>Sektor</th>
<th>Unit/Kavling</th>
<th>Sisa BON</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitspk 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
      $unit = unitinfo($row['unit_idunit']);
      $kavling = $unit['kavling'];  	
      
      $idsektor = $unit['sektor_idsektor'];
      $sektor= sektorinfo($idsektor);
      $sektorname = $sektor['sektorname'];
             
      
      $spkcat = spkcatinfo($row['spkcat_idspkcat']);
      $category = $spkcat['category'];        			
  		
      $sql1 = "select sum(payvalue) jumlah from spkpaymentdtl where unitspk_idunitspk = '".$row['idunitspk']."'"; 
      $result1 = mysql_query($sql1);
      $data1 = mysql_fetch_array($result1);
      $pembayaran = $data1[0];
      $sisa = $row['spkvalue'] - $pembayaran;    		

if ($sisa > 0) {
		
  			 ?>		 
 <tr> 
 <td><? echo $row['idunitspk'];?></td>
<td><? echo $category;?></td>
<td><? echo $sektorname;?></td>
<td><? echo $kavling;?></td>
<td class="right"><? echo nf($sisa);?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendunitspk('<? echo $row['idunitspk'];?>','<? echo $category;?>','<? echo $kavling;?>','<? echo $sisa;?>' )"></td>
</tr>
<?  
}

} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
	</form>	
	</body>
	</html>	
