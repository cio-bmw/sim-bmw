	<?  
require_once ('login.php'); 
		$str="select * from receive_paymentdtl where idreceive_paymentdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpaymentdtl=$data['idpaymentdtl']; 
		$pay_value=$data['pay_value']; 
		$receivehdr_idreceivehdr=$data['receivehdr_idreceivehdr']; 
		$receive_paymenthdr_idpaymenthdr=$data['receive_paymenthdr_idpaymenthdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data receive_paymentdtl"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/receive_paymentdtl_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail receive_paymentdtl &nbsp; 
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
 <table> 
<tr><td class="right">idpaymentdtl</td><td><input type="text" id="idpaymentdtl" name="idpaymentdtl" size="10" <? echo readonly;?> value="<? echo $idpaymentdtl;?>" /></td> 
</tr> 
<tr> 
<td class="right">pay_value</td> 
<td><input type="text" id="pay_value" name="pay_value" size="30" maxlength="25" value="<? echo $pay_value;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">receivehdr_idreceivehdr</td> 
<td><input type="text" id="receivehdr_idreceivehdr" name="receivehdr_idreceivehdr" size="30" maxlength="25" value="<? echo $receivehdr_idreceivehdr;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">receive_paymenthdr_idpaymenthdr</td> 
<td><input type="text" id="receive_paymenthdr_idpaymenthdr" name="receive_paymenthdr_idpaymenthdr" size="30" maxlength="25" value="<? echo $receive_paymenthdr_idpaymenthdr;?>" readonly /></td> 
</tr> 
</table> 
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
