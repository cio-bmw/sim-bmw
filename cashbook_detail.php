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
  <table  class="header" ><tr><td class="judul">Data Detail cashbook &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from cashbook where idcashbook = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcashbook=$data['idcashbook']; 
		$txndate=$data['txndate']; 
		$txnflag=$data['txnflag']; 
		$txnvalue=$data['txnvalue']; 
		$saldo=$data['saldo']; 
		$txndesc=$data['txndesc']; 
		$idcashin=$data['idcashin']; 
		$idcashouthdr=$data['idcashouthdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data cashbook"; 
?> 
 <table> 
<tr><td class="right">idcashbook</td><td><input type="text" id="idcashbook" name="idcashbook" size="10" <? echo readonly;?> value="<? echo $idcashbook;?>" /></td> 
</tr> 
<tr> 
<td class="right">txndate</td> 
<td><input type="text" id="txndate" name="txndate" size="30" maxlength="25" value="<? echo $txndate;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txnflag</td> 
<td><input type="text" id="txnflag" name="txnflag" size="30" maxlength="25" value="<? echo $txnflag;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txnvalue</td> 
<td><input type="text" id="txnvalue" name="txnvalue" size="30" maxlength="25" value="<? echo $txnvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">saldo</td> 
<td><input type="text" id="saldo" name="saldo" size="30" maxlength="25" value="<? echo $saldo;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txndesc</td> 
<td><input type="text" id="txndesc" name="txndesc" size="30" maxlength="25" value="<? echo $txndesc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">idcashin</td> 
<td><input type="text" id="idcashin" name="idcashin" size="30" maxlength="25" value="<? echo $idcashin;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">idcashouthdr</td> 
<td><input type="text" id="idcashouthdr" name="idcashouthdr" size="30" maxlength="25" value="<? echo $idcashouthdr;?>" readonly /></td> 
</tr> 
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
