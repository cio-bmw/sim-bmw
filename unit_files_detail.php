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
  <table  class="header" ><tr><td class="judul">Data Detail unit_files &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from unit_files where idunit_files = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunit_files=$data['idunit_files']; 
		$filename=$data['filename']; 
		$filedesc=$data['filedesc']; 
		$unit_idunit=$data['unit_idunit']; 
		$doccat_iddoccat=$data['doccat_iddoccat']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unit_files"; 
?> 
 <table> 
<tr><td class="right">idunit_files</td><td><input type="text" id="idunit_files" name="idunit_files" size="10" <? echo readonly;?> value="<? echo $idunit_files;?>" /></td> 
</tr> 
<tr> 
<td class="right">filename</td> 
<td><input type="text" id="filename" name="filename" size="30" maxlength="25" value="<? echo $filename;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">filedesc</td> 
<td><input type="text" id="filedesc" name="filedesc" size="30" maxlength="25" value="<? echo $filedesc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td><input type="text" id="unit_idunit" name="unit_idunit" size="30" maxlength="25" value="<? echo $unit_idunit;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">doccat_iddoccat</td> 
<td><input type="text" id="doccat_iddoccat" name="doccat_iddoccat" size="30" maxlength="25" value="<? echo $doccat_iddoccat;?>" readonly /></td> 
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
