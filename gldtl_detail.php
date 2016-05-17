	<?  
require_once ('login.php'); 
		$str="select * from gldtl where idgldtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idgldtl=$data['idgldtl']; 
		$glhdr_idglhdr=$data['glhdr_idglhdr']; 
		$Dvalue=$data['Dvalue']; 
		$Kvalue=$data['Kvalue']; 
		$acc_idacc=$data['acc_idacc']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data gldtl"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/gldtl_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail gldtl &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <? if($sls_status=='confirm') { ?>
 <input type="button" class="button" id="btnreopen" name="btnreopen" value="Batalkan Konfirmasi"> 
<? }  else { ?> 
 <input class="button" type="button"  name="btnconfirm" value="Konfirmasi" id="btnconfirm" />

  <? } ?>
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
   <input  class="button" type="button" value="Kembali Ke Menu" id="btnexit">
  </td> </tr></table>
  </form> 
</div> 
 <table> 
<tr><td class="right">idgldtl</td><td><input type="text" id="idgldtl" name="idgldtl" size="10" <? echo readonly;?> value="<? echo $idgldtl;?>" /></td> 
</tr> 
<tr> 
<td class="right">glhdr_idglhdr</td> 
<td><input type="text" id="glhdr_idglhdr" name="glhdr_idglhdr" size="30" maxlength="25" value="<? echo $glhdr_idglhdr;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">Dvalue</td> 
<td><input type="text" id="Dvalue" name="Dvalue" size="30" maxlength="25" value="<? echo $Dvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">Kvalue</td> 
<td><input type="text" id="Kvalue" name="Kvalue" size="30" maxlength="25" value="<? echo $Kvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">acc_idacc</td> 
<td><input type="text" id="acc_idacc" name="acc_idacc" size="30" maxlength="25" value="<? echo $acc_idacc;?>" readonly /></td> 
</tr> 
</table> 
</div>  
<div id="column1-wrap">
<div id="divPageEntry"></div>
<div id="divPageData"></div> 
</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
</body> 
</html>  
