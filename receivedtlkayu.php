<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/receivedtlkayu.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
 <table  class="header" ><tr><td class="judul"> Data Detail Penerimaan Kayu</td>
 <td align=right>
 <input class="button" type="button" value="Tampilkan Barang" id="btnrcvdtl" />
 <input class="button" type="button" value="Tambah Barang" id="btnaddproduct" />
 <input class="button" type="button" value="Konfirmasi" id="btnconfirm" />
 <input class="button" type="button" value="Cetak" id="btncetak" />
 
 <input  class="button" type="button" value="Kembali Data Penerimaan" id="btnlist">

  </td> </tr></table>
<br /> 
</div> 
<div id="divPageHeader">
<?
$str="select * from receivehdrkayu where idreceivehdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreceivehdr=$data['idreceivehdr']; 
		$supplier_idsupp=$data['supplier_idsupp']; 
		$rcv_date=gettanggal($data['rcv_date']); 
		$rcv_bon=$data['rcv_bon']; 
		$rcv_titip=$data['rcv_titip']; 
		$rcv_desc=$data['rcv_desc']; 
		$due_date=gettanggal($data['due_date']); 
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
		$judul="Update data receivehdr"; 
		$supplier = supplierinfo($supplier_idsupp);
		$suppname = $supplier['suppname'];
?>
<form id="receivehdr" name="receivehdr" >
<table class="grid"> 


<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Dok</td><td><input type="text" id="idreceivehdr" name="idreceivehdr" size="10" <? echo $readonly;?> value="<? echo $idreceivehdr;?>" />
Tanggal :<input type="text" id="rcv_date" name="rcv_date" size="10" maxlength="25" value="<? echo $rcv_date;?>" />
Status : <input type="text" id="rcv_status" name="rcv_status" size="30" maxlength="25" value="<? echo $rcv_status;?>" readonly/>

</td> 
<td class="right">Jatuh Tempo</td> 
<td><input type="text" id="due_date" name="due_date" size="30" maxlength="25" value="<? echo $due_date;?>" /></td> 

</tr> 
<?php } else {?> 
<tr><td class="right">No Dok</td><td><input type="text" id="idreceivehdr" name="idreceivehdr" size="10" value="<? echo $idreceivehdr;?>" />
Tanggal : <input type="text" id="rcv_date" name="rcv_date" size="10" maxlength="25" value="<? echo $rcv_date;?>" />
Status : <input type="text" id="rcv_status" name="rcv_status" size="10" maxlength="25" value="<? echo $rcv_status;?>" readonly/>

</td> 
<td class="right">Jatuh Tempo</td> 
<td><input type="text" id="due_date" name="due_date" size="30" maxlength="25" value="<? echo $due_date;?>" /></td> 

</tr> 
<?php }?> 
<tr> 
<td class="right">Supplier</td> 
<td><input type="text" id="supplier_idsupp" name="supplier_idsupp" size="10" maxlength="25" value="<? echo $supplier_idsupp;?>" />
<input type="text" id="suppname" name="suppname" size="40" maxlength="25" value="<? echo $suppname;?>" />
</td> 


<td class="right">No Faktur</td> 
<td><input type="text" id="faktur" name="faktur" size="30" maxlength="25" value="<? echo $faktur;?>" /></td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form>
</div>
<div id="column1-wrap">
  <div id="divPageEntry"></div> 
  <div id="divPageData"></div> 
 </div> 
    <div id="divLOV"></div>
<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
