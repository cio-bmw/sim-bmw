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
  <table  class="header" ><tr><td class="judul">Data Detail xfiles &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from xfiles where idxfiles = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idxfiles=$data['idxfiles']; 
		$xfilesname=$data['xfilesname']; 
		$xfilesdesc=$data['xfilesdesc']; 
		$xfilesdate=$data['xfilesdate']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data xfiles"; 
?> 
 <table> 
<tr><td class="right">idxfiles</td><td><input type="text" id="idxfiles" name="idxfiles" size="10" <? echo readonly;?> value="<? echo $idxfiles;?>" /></td> 
</tr> 
<tr> 
<td class="right">xfilesname</td> 
<td><input type="text" id="xfilesname" name="xfilesname" size="30" maxlength="25" value="<? echo $xfilesname;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">xfilesdesc</td> 
<td><input type="text" id="xfilesdesc" name="xfilesdesc" size="30" maxlength="25" value="<? echo $xfilesdesc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">xfilesdate</td> 
<td><input type="text" id="xfilesdate" name="xfilesdate" size="30" maxlength="25" value="<? echo $xfilesdate;?>" readonly /></td> 
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
