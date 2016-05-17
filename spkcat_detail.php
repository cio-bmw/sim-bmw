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
  <table  class="header" ><tr><td class="judul">Data Detail spkcat &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from spkcat where idspkcat = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idspkcat=$data['idspkcat']; 
		$category=$data['category']; 
		$spkdesc1=$data['spkdesc1']; 
		$spkdesc2=$data['spkdesc2']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data spkcat"; 
?> 
 <table> 
<tr><td class="right">idspkcat</td><td><input type="text" id="idspkcat" name="idspkcat" size="10" <? echo readonly;?> value="<? echo $idspkcat;?>" /></td> 
</tr> 
<tr> 
<td class="right">category</td> 
<td><input type="text" id="category" name="category" size="30" maxlength="25" value="<? echo $category;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">spkdesc1</td> 
<td><input type="text" id="spkdesc1" name="spkdesc1" size="30" maxlength="25" value="<? echo $spkdesc1;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">spkdesc2</td> 
<td><input type="text" id="spkdesc2" name="spkdesc2" size="30" maxlength="25" value="<? echo $spkdesc2;?>" readonly /></td> 
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
