	<?  
require_once ('login.php'); 
		$str="select * from whcashout where idwhcashout = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcashout=$data['idcashout']; 
		$txndate=$data['txndate']; 
		$txndesc=$data['txndesc']; 
		$txnvalue=$data['txnvalue']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data whcashout"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/whcashout_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail whcashout &nbsp; 
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
<tr><td class="right">idcashout</td><td><input type="text" id="idcashout" name="idcashout" size="10" <? echo readonly;?> value="<? echo $idcashout;?>" /></td> 
</tr> 
<tr> 
<td class="right">txndate</td> 
<td><input type="text" id="txndate" name="txndate" size="30" maxlength="25" value="<? echo $txndate;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txndesc</td> 
<td><input type="text" id="txndesc" name="txndesc" size="30" maxlength="25" value="<? echo $txndesc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txnvalue</td> 
<td><input type="text" id="txnvalue" name="txnvalue" size="30" maxlength="25" value="<? echo $txnvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">sektor_idsektor</td> 
<td><input type="text" id="sektor_idsektor" name="sektor_idsektor" size="30" maxlength="25" value="<? echo $sektor_idsektor;?>" readonly /></td> 
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
