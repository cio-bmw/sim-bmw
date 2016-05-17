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
  <table  class="header" ><tr><td class="judul">Data Detail tipeclbangun &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from tipeclbangun where idtipeclbangun = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtipeclbangun=$data['idtipeclbangun']; 
		$bobotpct=$data['bobotpct']; 
		$tipe_idtipe=$data['tipe_idtipe']; 
		$clbangun_idclbangun=$data['clbangun_idclbangun']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data tipeclbangun"; 
?> 
 <table> 
<tr><td class="right">idtipeclbangun</td><td><input type="text" id="idtipeclbangun" name="idtipeclbangun" size="10" <? echo readonly;?> value="<? echo $idtipeclbangun;?>" /></td> 
</tr> 
<tr> 
<td class="right">bobotpct</td> 
<td><input type="text" id="bobotpct" name="bobotpct" size="30" maxlength="25" value="<? echo $bobotpct;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">tipe_idtipe</td> 
<td><input type="text" id="tipe_idtipe" name="tipe_idtipe" size="30" maxlength="25" value="<? echo $tipe_idtipe;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">clbangun_idclbangun</td> 
<td><input type="text" id="clbangun_idclbangun" name="clbangun_idclbangun" size="30" maxlength="25" value="<? echo $clbangun_idclbangun;?>" readonly /></td> 
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
