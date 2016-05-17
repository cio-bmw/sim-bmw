	<?  
require_once ('login.php'); 
		$str="select * from emp where idemp = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idemp=$data['idemp']; 
		$empasswd=$data['empasswd']; 
		$empname=$data['empname']; 
		$empphone=$data['empphone']; 
		$gp=$data['gp']; 
		$gs=$data['gs']; 
		$mkt=$data['mkt']; 
		$tch=$data['tch']; 
		$acc=$data['acc']; 
		$kpr=$data['kpr']; 
		$adm=$data['adm']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data emp"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/emp_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail emp &nbsp; 
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
<tr><td class="right">idemp</td><td><input type="text" id="idemp" name="idemp" size="10" <? echo readonly;?> value="<? echo $idemp;?>" /></td> 
</tr> 
<tr> 
<td class="right">empasswd</td> 
<td><input type="text" id="empasswd" name="empasswd" size="30" maxlength="25" value="<? echo $empasswd;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">empname</td> 
<td><input type="text" id="empname" name="empname" size="30" maxlength="25" value="<? echo $empname;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">empphone</td> 
<td><input type="text" id="empphone" name="empphone" size="30" maxlength="25" value="<? echo $empphone;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">gp</td> 
<td><input type="text" id="gp" name="gp" size="30" maxlength="25" value="<? echo $gp;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">gs</td> 
<td><input type="text" id="gs" name="gs" size="30" maxlength="25" value="<? echo $gs;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">mkt</td> 
<td><input type="text" id="mkt" name="mkt" size="30" maxlength="25" value="<? echo $mkt;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">tch</td> 
<td><input type="text" id="tch" name="tch" size="30" maxlength="25" value="<? echo $tch;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">acc</td> 
<td><input type="text" id="acc" name="acc" size="30" maxlength="25" value="<? echo $acc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">kpr</td> 
<td><input type="text" id="kpr" name="kpr" size="30" maxlength="25" value="<? echo $kpr;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">adm</td> 
<td><input type="text" id="adm" name="adm" size="30" maxlength="25" value="<? echo $adm;?>" readonly /></td> 
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
