	<?  
require_once ('login.php'); 
		$str="select * from receive_paymenthdr where idpaymenthdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpaymenthdr=$data['idpaymenthdr']; 
		$pay_date=$data['pay_date']; 
		$pay_name=$data['pay_name']; 
		$pay_note=$data['pay_note']; 
		$supplier_idsupp=$data['supplier_idsupp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data receive_paymenthdr"; 
		
		$supplier = supplierinfo($supplier_idsupp);
		$suppname = $supplier['suppname'];
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/receive_paymenthdr_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail receive_paymenthdr &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <? if($sls_status=='confirm') { ?>
 <input type="button" class="button" id="btnreopen" name="btnreopen" value="Batalkan Konfirmasi"> 
<? }  else { ?> 
 <input class="button" type="button"  name="btnconfirm" value="Konfirmasi" id="btnconfirm" />

  <? } ?>
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  
  </td> </tr></table>
  </form> 
</div> 
<p class="judul" >Detail Pembayaran Supplier</p>
 <table> 
<tr><td class="right">No Dok</td><td><input type="text" id="idpaymenthdr" name="idpaymenthdr" size="10" <? echo readonly;?> value="<? echo $idpaymenthdr;?>" />
<input type="text" id="pay_date" name="pay_date" size="30" maxlength="25" value="<? echo $pay_date;?>" readonly />
</td> 
<td class="right">Di terima Oleh</td> 
<td><input type="text" id="pay_name" name="pay_name" size="30" maxlength="25" value="<? echo $pay_name;?>" readonly /></td> 
</tr> 

<tr> 
<td class="right">Supplier</td> 
<td>
<input type="text" id="supplier_idsupp" name="supplier_idsupp" size="10" maxlength="25" value="<? echo $supplier_idsupp;?>" readonly />
<input type="text" id="suppname" name="suppname" size="30" maxlength="25" value="<? echo $suppname;?>" readonly />
</td> 

<td class="right">Catatan</td> 
<td><input type="text" id="pay_note" name="pay_note" size="30" maxlength="25" value="<? echo $pay_note;?>" readonly /></td> 
</tr> 
</table> 
</div>  
<div id="column1-wrap">
<div id="divPageEntry" style="width : 500px;"></div>
<div id="divPageData"></div> 
</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
</body> 
</html>  
