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
  <table  class="header" ><tr><td class="judul">Data Detail sektorcostdtl &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from sektorcostdtl where idsektorcostdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idsektorcostdtl=$data['idsektorcostdtl']; 
		$costprice=$data['costprice']; 
		$rabmst_idrabmst=$data['rabmst_idrabmst']; 
		$txndtldesc=$data['txndtldesc']; 
		$sektorcosthdr_idsektorcosthdr=$data['sektorcosthdr_idsektorcosthdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data sektorcostdtl"; 
?> 
 <table> 
<tr><td class="right">idsektorcostdtl</td><td><input type="text" id="idsektorcostdtl" name="idsektorcostdtl" size="10" <? echo readonly;?> value="<? echo $idsektorcostdtl;?>" /></td> 
</tr> 
<tr> 
<td class="right">costprice</td> 
<td><input type="text" id="costprice" name="costprice" size="30" maxlength="25" value="<? echo $costprice;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rabmst_idrabmst</td> 
<td><input type="text" id="rabmst_idrabmst" name="rabmst_idrabmst" size="30" maxlength="25" value="<? echo $rabmst_idrabmst;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txndtldesc</td> 
<td><input type="text" id="txndtldesc" name="txndtldesc" size="30" maxlength="25" value="<? echo $txndtldesc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">sektorcosthdr_idsektorcosthdr</td> 
<td><input type="text" id="sektorcosthdr_idsektorcosthdr" name="sektorcosthdr_idsektorcosthdr" size="30" maxlength="25" value="<? echo $sektorcosthdr_idsektorcosthdr;?>" readonly /></td> 
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
