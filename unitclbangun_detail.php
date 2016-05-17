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
  <table  class="header" ><tr><td class="judul">Data Detail unitclbangun &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from unitclbangun where idunitclbangun = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunitclbangun=$data['idunitclbangun']; 
		$clstatus=$data['clstatus']; 
		$clbangun_idclbangun=$data['clbangun_idclbangun']; 
		$unit_idunit=$data['unit_idunit']; 
		$bobotpct=$data['bobotpct']; 
		$unitspk_idunitspk=$data['unitspk_idunitspk']; 
		$workdays=$data['workdays']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unitclbangun"; 
?> 
 <table> 
<tr><td class="right">idunitclbangun</td><td><input type="text" id="idunitclbangun" name="idunitclbangun" size="10" <? echo readonly;?> value="<? echo $idunitclbangun;?>" /></td> 
</tr> 
<tr> 
<td class="right">clstatus</td> 
<td><input type="text" id="clstatus" name="clstatus" size="30" maxlength="25" value="<? echo $clstatus;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">clbangun_idclbangun</td> 
<td><input type="text" id="clbangun_idclbangun" name="clbangun_idclbangun" size="30" maxlength="25" value="<? echo $clbangun_idclbangun;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td><input type="text" id="unit_idunit" name="unit_idunit" size="30" maxlength="25" value="<? echo $unit_idunit;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">bobotpct</td> 
<td><input type="text" id="bobotpct" name="bobotpct" size="30" maxlength="25" value="<? echo $bobotpct;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">unitspk_idunitspk</td> 
<td><input type="text" id="unitspk_idunitspk" name="unitspk_idunitspk" size="30" maxlength="25" value="<? echo $unitspk_idunitspk;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">workdays</td> 
<td><input type="text" id="workdays" name="workdays" size="30" maxlength="25" value="<? echo $workdays;?>" readonly /></td> 
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
