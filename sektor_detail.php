<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/sektor_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail sektor &nbsp; 
 <input  class="button" type="button" value="Tipe" id="btntipe">
 <input  class="button" type="button" value="Unit" id="btnunit">
  <input  class="button" type="button" value="Gambar" id="btngambar">
 <input  class="button" type="button" value="Spesifikasi" id="btnspec">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
<div id="pageheader">
	<?  
		$str="select * from sektor where idsektor = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idsektor=$data['idsektor']; 
		$sektorname=$data['sektorname']; 
		$address=$data['address']; 
		$emp_idempmkt=$data['emp_idempmkt']; 
		$emp_idempgdg=$data['emp_idempgdg']; 
		$front_img=$data['front_img']; 
		$map_img=$data['map_img']; 
		$siteplan_img=$data['siteplan_img']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data sektor"; 
?> 
 <table> 
<tr><td class="right">
<input type="text" id="idsektor" name="idsektor" size="10" <? echo readonly;?> value="<? echo $idsektor;?>" />
<input type="text" id="sektorname" name="sektorname" size="30" maxlength="25" value="<? echo $sektorname;?>" readonly />
<input type="text" id="address" name="address" size="30" maxlength="25" value="<? echo $address;?>" readonly />
</td> 
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
