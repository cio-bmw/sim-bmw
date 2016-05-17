<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/amclist_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail amclist &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from amclist where idamclist = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idamclist=$data['idamclist']; 
		$amclist=$data['amclist']; 
		$amclistseq=$data['amclistseq']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data amclist"; 
?> 
 <table> 
<tr><td class="right">idamclist</td><td><input type="text" id="idamclist" name="idamclist" size="10" <? echo readonly;?> value="<? echo $idamclist;?>" /></td> 
</tr> 
<tr> 
<td class="right">amclist</td> 
<td><input type="text" id="amclist" name="amclist" size="30" maxlength="25" value="<? echo $amclist;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">amclistseq</td> 
<td><input type="text" id="amclistseq" name="amclistseq" size="30" maxlength="25" value="<? echo $amclistseq;?>" readonly /></td> 
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
