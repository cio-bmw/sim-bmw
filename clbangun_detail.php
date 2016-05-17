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
  <table  class="header" ><tr><td class="judul">Data Detail clbangun &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from clbangun where idclbangun = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idclbangun=$data['idclbangun']; 
		$clbangundesc=$data['clbangundesc']; 
		$bobotpct=$data['bobotpct']; 
		$spkcat_idspkcat=$data['spkcat_idspkcat']; 
		$workdays=$data['workdays']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data clbangun"; 
?> 
 <table> 
<tr><td class="right">idclbangun</td><td><input type="text" id="idclbangun" name="idclbangun" size="10" <? echo readonly;?> value="<? echo $idclbangun;?>" /></td> 
</tr> 
<tr> 
<td class="right">clbangundesc</td> 
<td><input type="text" id="clbangundesc" name="clbangundesc" size="30" maxlength="25" value="<? echo $clbangundesc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">bobotpct</td> 
<td><input type="text" id="bobotpct" name="bobotpct" size="30" maxlength="25" value="<? echo $bobotpct;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">spkcat_idspkcat</td> 
<td><input type="text" id="spkcat_idspkcat" name="spkcat_idspkcat" size="30" maxlength="25" value="<? echo $spkcat_idspkcat;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">workdays</td> 
<td><input type="text" id="workdays" name="workdays" size="30" maxlength="25" value="<? echo $workdays;?>" readonly /></td> 
</tr> 
</table> 
</div>  
<br />  
<div id="column1-wrap"></div> 
<div id="divPageEntry"></div><br> 
<div id="divPageData"></div> 
</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
</body> 
</html>  
