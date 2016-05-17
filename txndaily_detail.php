	<?  
require_once ('login.php'); 
		$str="select * from txndaily where idtxndaily = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtxndaily=$data['idtxndaily']; 
		$txndate=$data['txndate']; 
		$txndesc=$data['txndesc']; 
		$dvalue=$data['dvalue']; 
		$kvalue=$data['kvalue']; 
		$saldo=$data['saldo']; 
		$txnflag=$data['txnflag']; 
		$txnpos_idtxnpos=$data['txnpos_idtxnpos']; 
		$txnalokasi_idtxnalokasi=$data['txnalokasi_idtxnalokasi']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data txndaily"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/txndaily_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail txndaily &nbsp; 
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
<tr><td class="right">idtxndaily</td><td><input type="text" id="idtxndaily" name="idtxndaily" size="10" <? echo readonly;?> value="<? echo $idtxndaily;?>" /></td> 
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
<td class="right">dvalue</td> 
<td><input type="text" id="dvalue" name="dvalue" size="30" maxlength="25" value="<? echo $dvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">kvalue</td> 
<td><input type="text" id="kvalue" name="kvalue" size="30" maxlength="25" value="<? echo $kvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">saldo</td> 
<td><input type="text" id="saldo" name="saldo" size="30" maxlength="25" value="<? echo $saldo;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txnflag</td> 
<td><input type="text" id="txnflag" name="txnflag" size="30" maxlength="25" value="<? echo $txnflag;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txnpos_idtxnpos</td> 
<td><input type="text" id="txnpos_idtxnpos" name="txnpos_idtxnpos" size="30" maxlength="25" value="<? echo $txnpos_idtxnpos;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txnalokasi_idtxnalokasi</td> 
<td><input type="text" id="txnalokasi_idtxnalokasi" name="txnalokasi_idtxnalokasi" size="30" maxlength="25" value="<? echo $txnalokasi_idtxnalokasi;?>" readonly /></td> 
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
