<? require_once ('login.php'); ?>  

<?
require_once ('config.php');

      $str="select * from receivehdrsektor where idreceivehdr = '$_GET[id]'"; 
		$res=mysql_query($str) ;
		$data=mysql_fetch_assoc($res); 
		$idreceivehdr=$data['idreceivehdr']; 
		$supplier_idsupp=$data['supplier_idsupp']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
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
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data receivehdrsektor"; 
		$supplier = supplierinfo($supplier_idsupp);
      $suppname=$supplier['suppname'];

      $sektor = sektorinfo($sektor_idsektor);
      $sektorname = $sektor['sektorname'];  			
 
		

?>
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/receivedtlsektor.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr> 
  <td class="judul">Detail Penerimaan Barang Sektor &nbsp;
  <input class="button" type="button" value="Tampilkan" id="btntampil"  />
  <input  class="button" type="button" value="Tambah Detail" id="btntambah">
  <input  class="button" type="button" value="Cetak" id="btncetak">
  
    <? if($rcv_status=='confirm') { ?>
 <input type="button" class="button" id="btnreopen" name="btnreopen" value="Batalkan Konfirmasi"> 
<? }  else { ?> 
 <input class="button" type="button"  name="btnconfirm" value="Konfirmasi" id="btnconfirm" />

  <? } ?>
  
  <input  class="button" type="button" value="Daftar Penerimaan" id="btnlist">
  
  </td> </tr></table>
  </form><br /> 
</div> 
<div id="pageheader">

<table class="grid"> 
<tr><td>		
<table width=100%> 
<tr><td class="right">No Dok</td><td>
<input type="text" id="idreceivehdr" name="idreceivehdr" size="10" value="<? echo $idreceivehdr;?>" />
Status : &nbsp; <input type="text" id="rcv_status" name="rcv_status" size="10" value="<? echo $rcv_status;?>" />
</td> 
</tr> 
<tr> 
<td class="right">Supplier</td> 
<td><input type="text" id="supplier_idsupp" name="supplier_idsupp" size="3" maxlength="25" value="<? echo $supplier_idsupp;?>" /> 
<input type="text" id="suppname" name="suppname" size="30" maxlength="35" value="<? echo $suppname;?>" /></td> 
</tr> 
<tr> 
<td class="right">Sektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="3" maxlength="25" value="<? echo $sektor_idsektor;?>" />
<input type="text" id="sektorname" name="sektorname" size="30" maxlength="35" value="<? echo $sektorname;?>" />
</td> 

</tr> 
</table>
</td><td>
<table width=100%>
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="rcv_date" name="rcv_date" size="30" maxlength="25" value="<? echo $rcv_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="rcv_desc" name="rcv_desc" size="30" maxlength="25" value="<? echo $rcv_desc;?>" /></td> 
</tr> 
<tr> 
<td class="right">Faktur</td> 
<td><input type="text" id="faktur" name="faktur" size="30" maxlength="25" value="<? echo $faktur;?>" /></td> 
</tr> 
</table> 
</td></tr></table>
</div>
<br>
<div id="column1-wrap">
  <div id="divPageEntry" style="width:500px;"  ></div> 
  <div id="divPageData"></div> 
 </div> 
<div id="divLOV"></div>
<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
