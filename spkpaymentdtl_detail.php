<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail spkpaymentdtl &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from spkpaymentdtl where idspkpaymentdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idspkpaymentdtl=$data['idspkpaymentdtl']; 
		$payvalue=$data['payvalue']; 
		$spkpaymenthdr_idspkpaymenthdr=$data['spkpaymenthdr_idspkpaymenthdr']; 
		$unitspk_idunitspk=$data['unitspk_idunitspk']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data spkpaymentdtl"; 
?> 
 <table> 
<tr><td class="right">No Dok</td><td><input type="text" id="idspkpaymentdtl" name="idspkpaymentdtl" size="10" <? echo readonly;?> value="<? echo $idspkpaymentdtl;?>" /></td> 
</tr> 
<tr> 
<td class="right">Jumlah Pembayaran</td> 
<td><input type="text" id="payvalue" name="payvalue" size="30" maxlength="25" value="<? echo $payvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">No Pembayaran</td> 
<td><input type="text" id="spkpaymenthdr_idspkpaymenthdr" name="spkpaymenthdr_idspkpaymenthdr" size="30" maxlength="25" value="<? echo $spkpaymenthdr_idspkpaymenthdr;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">No SPK</td> 
<td><input type="text" id="unitspk_idunitspk" name="unitspk_idunitspk" size="30" maxlength="25" value="<? echo $unitspk_idunitspk;?>" readonly /></td> 
</tr> 
</table> 
</div>  
<br />  
<div id="column1-wrap">
<div id="divPageEntry"></div><br> 
<div id="divPageData"></div> 
</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
</body> 
</html>  
