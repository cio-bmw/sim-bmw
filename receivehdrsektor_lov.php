 <script type="text/javascript">  
 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idreceivehdr"){ 
    dataString = 'starting='+page+'&idreceivehdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "supplier_idsupp"){ 
    dataString = 'starting='+page+'&supplier_idsupp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektor_idsektor"){ 
    dataString = 'starting='+page+'&sektor_idsektor='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_date"){ 
    dataString = 'starting='+page+'&rcv_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_bon"){ 
    dataString = 'starting='+page+'&rcv_bon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_titip"){ 
    dataString = 'starting='+page+'&rcv_titip='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_desc"){ 
    dataString = 'starting='+page+'&rcv_desc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "due_date"){ 
    dataString = 'starting='+page+'&due_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "paid_date"){ 
    dataString = 'starting='+page+'&paid_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "faktur"){ 
    dataString = 'starting='+page+'&faktur='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_bayar"){ 
    dataString = 'starting='+page+'&rcv_bayar='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_status"){ 
    dataString = 'starting='+page+'&rcv_status='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_diskon"){ 
    dataString = 'starting='+page+'&rcv_diskon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_totprice"){ 
    dataString = 'starting='+page+'&rcv_totprice='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_totdiskon"){ 
    dataString = 'starting='+page+'&rcv_totdiskon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_totppn"){ 
    dataString = 'starting='+page+'&rcv_totppn='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"receivehdrsektor_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receivehdrsektor, data yang ditampilkan disesuaikan 
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
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
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
 
  $.ajax({ 
    url: "receivehdrsektor_lov.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receivehdrsektor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receivehdrsektor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	 
}); 
 
 function sendreceivehdrsektor(n1,n2) 
 {
     window.opener.document.getElementById('receivehdrsektor_idreceivehdr').value=n1;
     window.opener.document.getElementById('receivehdrsektor').value=n2;
     window.close();
 } 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_POST['fieldcari']; 
 
  $sql = "select * from receivehdrsektor where idreceivehdrsektor like '%".$fieldcari."%'";  
 
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
	<script type="text/javascript" src="js/receivehdrsektor.js"></script> 
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
 <th>idreceivehdr</th>
<th>supplier_idsupp</th>
<th>sektor_idsektor</th>
<th>rcv_date</th>
<th>rcv_bon</th>
<th>rcv_titip</th>
<th>rcv_desc</th>
<th>due_date</th>
<th>paid_date</th>
<th>faktur</th>
<th>rcv_bayar</th>
<th>rcv_status</th>
<th>rcv_diskon</th>
<th>rcv_totprice</th>
<th>rcv_totdiskon</th>
<th>rcv_totppn</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receivehdrsektor 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idreceivehdr'];?></td>
<td><? echo $row['supplier_idsupp'];?></td>
<td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $row['rcv_date'];?></td>
<td><? echo $row['rcv_bon'];?></td>
<td><? echo $row['rcv_titip'];?></td>
<td><? echo $row['rcv_desc'];?></td>
<td><? echo $row['due_date'];?></td>
<td><? echo $row['paid_date'];?></td>
<td><? echo $row['faktur'];?></td>
<td><? echo $row['rcv_bayar'];?></td>
<td><? echo $row['rcv_status'];?></td>
<td><? echo $row['rcv_diskon'];?></td>
<td><? echo $row['rcv_totprice'];?></td>
<td><? echo $row['rcv_totdiskon'];?></td>
<td><? echo $row['rcv_totppn'];?></td>
 
<td><input class="button" type=button value="Pilih" onClick="sendreceivehdrsektor('<? echo $row['idreceivehdr'];?>','<? echo $row['receivehdrsektor'];?>  ' )"></td>
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
