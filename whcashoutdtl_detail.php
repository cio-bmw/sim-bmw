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
  <table  class="header" ><tr><td class="judul">Data Detail cashoutdtl &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from whcashoutdtl where idcashoutdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcashoutdtl=$data['idcashoutdtl']; 
		$dtldesc=$data['dtldesc']; 
		$txnvalue=$data['txnvalue']; 
		$cashouthdr_idcashouthdr=$data['cashouthdr_idcashouthdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data cashoutdtl"; 
?> 
 <table> 
<tr><td class="right">idcashoutdtl</td><td><input type="text" id="idcashoutdtl" name="idcashoutdtl" size="10" <? echo readonly;?> value="<? echo $idcashoutdtl;?>" /></td> 
</tr> 
<tr> 
<td class="right">dtldesc</td> 
<td><input type="text" id="dtldesc" name="dtldesc" size="30" maxlength="25" value="<? echo $dtldesc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txnvalue</td> 
<td><input type="text" id="txnvalue" name="txnvalue" size="30" maxlength="25" value="<? echo $txnvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">cashouthdr_idcashouthdr</td> 
<td><input type="text" id="cashouthdr_idcashouthdr" name="cashouthdr_idcashouthdr" size="30" maxlength="25" value="<? echo $cashouthdr_idcashouthdr;?>" readonly /></td> 
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
