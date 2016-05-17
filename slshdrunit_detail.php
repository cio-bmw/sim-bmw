<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/slshdrunit_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail slshdrunit &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from slshdrunit where idslshdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslshdr=$data['idslshdr']; 
		$sls_date=$data['sls_date']; 
		$sls_status=$data['sls_status']; 
		$unit_idunit=$data['unit_idunit']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data slshdrunit"; 
?> 
 <table> 
<tr><td class="right">idslshdr</td><td><input type="text" id="idslshdr" name="idslshdr" size="10" <? echo readonly;?> value="<? echo $idslshdr;?>" /></td> 
</tr> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="sls_date" name="sls_date" size="30" maxlength="25" value="<? echo $sls_date;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">Status</td> 
<td><input type="text" id="sls_status" name="sls_status" size="30" maxlength="25" value="<? echo $sls_status;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td><input type="text" id="unit_idunit" name="unit_idunit" size="30" maxlength="25" value="<? echo $unit_idunit;?>" readonly /></td> 
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
