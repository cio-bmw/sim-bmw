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
  <table  class="header" ><tr><td class="judul">Data Detail arpdtl &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from arpdtl where idarpdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idarpdtl=$data['idarpdtl']; 
		$pvalue=$data['pvalue']; 
		$arphdr_idarphdr=$data['arphdr_idarphdr']; 
		$slshdrsektor_idslshdr=$data['slshdrsektor_idslshdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data arpdtl"; 
?> 
 <table> 
<tr><td class="right">idarpdtl</td><td><input type="text" id="idarpdtl" name="idarpdtl" size="10" <? echo readonly;?> value="<? echo $idarpdtl;?>" /></td> 
</tr> 
<tr> 
<td class="right">pvalue</td> 
<td><input type="text" id="pvalue" name="pvalue" size="30" maxlength="25" value="<? echo $pvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">arphdr_idarphdr</td> 
<td><input type="text" id="arphdr_idarphdr" name="arphdr_idarphdr" size="30" maxlength="25" value="<? echo $arphdr_idarphdr;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">slshdrsektor_idslshdr</td> 
<td><input type="text" id="slshdrsektor_idslshdr" name="slshdrsektor_idslshdr" size="30" maxlength="25" value="<? echo $slshdrsektor_idslshdr;?>" readonly /></td> 
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
