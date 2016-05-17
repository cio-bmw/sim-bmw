<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/receivehdr_detail.js"></script> 
</head> 
<body>  
<table class="white">
<tr><td class="white"><img src="images/logo.png"></td></tr>
<tr><td class="judul">Data Detail Penerimaan Barang</td></tr>
</table>
<?
$id=$_GET['id'];
$str="select * from receivehdr where idreceivehdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreceivehdr=$data['idreceivehdr']; 
		$supplier_idsupp=$data['supplier_idsupp']; 
		$rcv_date=$data['rcv_date']; 
		$rcv_bon=$data['rcv_bon']; 
		$rcv_titip=$data['rcv_titip']; 
		$rcv_desc=$data['rcv_desc']; 
		$due_date=$data['due_date']; 
		$paid_date=$data['paid_date']; 
		$faktur=$data['faktur']; 
		$rcv_bayar=$data['rcv_bayar']; 
		$rcv_status=$data['rcv_status']; 
		$rcv_diskon=$data['rcv_diskon']; 
		$rcv_totprice=$data['rcv_totprice']; 
		$rcv_totdiskon=$data['rcv_totdiskon']; 
		$rcv_totppn=$data['rcv_totppn']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Data Penerimaan Barang"; 


?>
<div>
<table class=header><tr> 
  <td>
<input type="button" id="btnproduct" value="Tambah Barang">
<input type="button" id="btntarif" value="Konfirmasi">
<input type="button" id="btncetak" value="Cetak">
<input type="button" id="btnback" value="Kembali Ke List">
<input type="button" id="btnexit" value="Exit">
</td></tr></table>
</div>
<br>

<table><tr><td>
<div id="divheader"> 
<form method="post" name="receivehdr_form" action="" id="receivehdr_form">  
<table> 
<tr><th colspan="4"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td>Kode</td><td><input type="text" id="idreceivehdr" name="idreceivehdr" size="10" <? echo $readonly;?> value="<? echo $idreceivehdr;?>" /></td> 
<td>rcv_date</td> 
<td><input type="text" id="rcv_date" name="rcv_date" size="30" maxlength="25" value="<? echo $rcv_date;?>" readonly/>
Status : <input type="text" id="rcv_status" name="rcv_status" size="30" maxlength="25" value="<? echo $rcv_status;?>" readonly/>
</td> 

</tr> 
<?php } else {?> 
<tr><td>idreceivehdr</td><td><input type="text" id="idreceivehdr" name="idreceivehdr" size="10" value="<? echo $idreceivehdr;?>" readonly/></td> 
<td>rcv_date</td> 
<td><input type="text" id="rcv_date" name="rcv_date" size="30" maxlength="25" value="<? echo $rcv_date;?>" readonly/></td> 

</tr> 
<?php }?> 
<tr> 
<td>supplier_idsupp</td> 
<td><input type="text" id="supplier_idsupp" name="supplier_idsupp" size="30" maxlength="25" value="<? echo $supplier_idsupp;?>" readonly />
</td> 
<td>due_date</td> 
<td><input type="text" id="due_date" name="due_date" size="30" maxlength="25" value="<? echo $due_date;?>" readonly/></td> 
</tr> 
<tr> 
<td>rcv_desc</td> 
<td><input type="text" id="rcv_desc" name="rcv_desc" size="30" maxlength="25" value="<? echo $rcv_desc;?>" readonly/></td> 
<td>faktur</td> 
<td><input type="text" id="faktur" name="faktur" size="30" maxlength="25" value="<? echo $faktur;?>" readonly/></td> 
</tr> 

<input type="hidden" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" /> 

</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</table>  

</div> 
<br /> 
<div id="divPageEntry"></div> <br />
<div id="divPageData"></div> <br />
<div id="divLoading"></div> 
</td>
<td>
 <div id="divlov"></div> <br />
</td>
</tr>
</table>

 
 
</body> 
</html> 
