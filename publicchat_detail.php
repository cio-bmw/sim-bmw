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
  <table  class="header" ><tr><td class="judul">Data Detail publicchat &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from publicchat where idpublicchat = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpublicchat=$data['idpublicchat']; 
		$chatdate=$data['chatdate']; 
		$chatmsg=$data['chatmsg']; 
		$chatimg=$data['chatimg']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data publicchat"; 
?> 
 <table> 
<tr><td class="right">idpublicchat</td><td><input type="text" id="idpublicchat" name="idpublicchat" size="10" <? echo readonly;?> value="<? echo $idpublicchat;?>" /></td> 
</tr> 
<tr> 
<td class="right">chatdate</td> 
<td><input type="text" id="chatdate" name="chatdate" size="30" maxlength="25" value="<? echo $chatdate;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">chatmsg</td> 
<td><input type="text" id="chatmsg" name="chatmsg" size="30" maxlength="25" value="<? echo $chatmsg;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">chatimg</td> 
<td><input type="text" id="chatimg" name="chatimg" size="30" maxlength="25" value="<? echo $chatimg;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">emp_idemp</td> 
<td><input type="text" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" readonly /></td> 
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
