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
  <table  class="header" ><tr><td class="judul">Data Detail sektorrab &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from sektorrab where idsektorrab = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idsektorrab=$data['idsektorrab']; 
		$volume=$data['volume']; 
		$hargasat=$data['hargasat']; 
		$txntotal=$data['txntotal']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$rabmst_idrabmst=$data['rabmst_idrabmst']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data sektorrab"; 
?> 
 <table> 
<tr><td class="right">idsektorrab</td><td><input type="text" id="idsektorrab" name="idsektorrab" size="10" <? echo readonly;?> value="<? echo $idsektorrab;?>" /></td> 
</tr> 
<tr> 
<td class="right">volume</td> 
<td><input type="text" id="volume" name="volume" size="30" maxlength="25" value="<? echo $volume;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">hargasat</td> 
<td><input type="text" id="hargasat" name="hargasat" size="30" maxlength="25" value="<? echo $hargasat;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">txntotal</td> 
<td><input type="text" id="txntotal" name="txntotal" size="30" maxlength="25" value="<? echo $txntotal;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">sektor_idsektor</td> 
<td><input type="text" id="sektor_idsektor" name="sektor_idsektor" size="30" maxlength="25" value="<? echo $sektor_idsektor;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rabmst_idrabmst</td> 
<td><input type="text" id="rabmst_idrabmst" name="rabmst_idrabmst" size="30" maxlength="25" value="<? echo $rabmst_idrabmst;?>" readonly /></td> 
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
