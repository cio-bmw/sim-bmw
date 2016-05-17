 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var supp = $("input#supplier_idsupp").val(); 
   dataString = 'starting='+page+'&idsupp='+supp+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"receivehdr_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receivehdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idreceivehdr"){ 
      dataString = 'idreceivehdr='+ cari;  
   } 
   else if (combo == "supplier_idsupp"){ 
      dataString = 'supplier_idsupp='+ cari; 
    } 
   else if (combo == "rcv_date"){ 
      dataString = 'rcv_date='+ cari; 
    } 
   else if (combo == "rcv_bon"){ 
      dataString = 'rcv_bon='+ cari; 
    } 
   else if (combo == "rcv_titip"){ 
      dataString = 'rcv_titip='+ cari; 
    } 
   else if (combo == "rcv_desc"){ 
      dataString = 'rcv_desc='+ cari; 
    } 
   else if (combo == "due_date"){ 
      dataString = 'due_date='+ cari; 
    } 
   else if (combo == "paid_date"){ 
      dataString = 'paid_date='+ cari; 
    } 
   else if (combo == "faktur"){ 
      dataString = 'faktur='+ cari; 
    } 
   else if (combo == "rcv_bayar"){ 
      dataString = 'rcv_bayar='+ cari; 
    } 
   else if (combo == "rcv_status"){ 
      dataString = 'rcv_status='+ cari; 
    } 
   else if (combo == "rcv_diskon"){ 
      dataString = 'rcv_diskon='+ cari; 
    } 
   else if (combo == "rcv_totprice"){ 
      dataString = 'rcv_totprice='+ cari; 
    } 
   else if (combo == "rcv_totdiskon"){ 
      dataString = 'rcv_totdiskon='+ cari; 
    } 
   else if (combo == "rcv_totppn"){ 
      dataString = 'rcv_totppn='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
  $.ajax({ 
    url: "receivehdr_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receivehdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receivehdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendreceivehdr(n1,n2) 
 {
     document.getElementById('receivehdr_idreceivehdr').value=n1;
     document.getElementById('pay_value').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
$idsupp = $_GET['idsupp'];
 
  $sql = "select * from receivehdr where paid_date is not null and supplier_idsupp = '$idsupp' and idreceivehdr like '%".$fieldcari."%'";  
 
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
  <p class="judul">
	Daftar Penerimaan Barang : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" />  
	<input class="button"  type="submit" id="btncari" value="Tampilkan" /> 
	<input type="hidden" name="id" value=<? echo $id; ?> 
	</p>
	<table width="450px">  
	
  <tr> 
 <th>No Dok</th>
<th>Supplier</th>
<th>Tanggal</th>
<th>Jumlah</th>
<th>Status</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receivehdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 

   $id = $row['idreceivehdr']; 
	$sqlx = "SELECT sum(qty*receive_price) FROM receivedtl where receivehdr_idreceivehdr = '$id' ";
   $resultx = mysql_query($sqlx);
   $datax  = mysql_fetch_array($resultx);
   $jumlah = $datax[0];	

  		
  		
  		?>		 
       <tr> 
 <td><? echo $row['idreceivehdr'];?></td>
<td><? echo $row['supplier_idsupp'];?></td>
<td><? echo $row['rcv_date'];?></td>
<td class="right"><? echo nf($jumlah);?></td>
<td><? echo $row['rcv_status'];?></td>

<td><input class="button" type=button value="Pilih" onClick="sendreceivehdr('<? echo $row['idreceivehdr'];?>','<? echo $jumlah;?>  ' )"></td>
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
