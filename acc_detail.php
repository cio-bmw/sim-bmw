	<?  
require_once ('login.php'); 
		$str="select * from acc where idacc = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idacc=$data['idacc']; 
		$accname=$data['accname']; 
		$accsaldo=$data['accsaldo']; 
		$groupacc_idgroupacc=$data['groupacc_idgroupacc']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data acc"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script> 
<script type="text/javascript" src="js/acc_detail.js"></script> 
</head> 
<body> 
<table class="white">
<tr><td class="white"><img src="images/logo.png"></td></tr>
</table>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail acc &nbsp; 
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
<tr><td class="right">idacc</td><td><input type="text" id="idacc" name="idacc" size="10" <? echo readonly;?> value="<? echo $idacc;?>" /></td> 
</tr> 
<tr> 
<td class="right">accname</td> 
<td><input type="text" id="accname" name="accname" size="30" maxlength="25" value="<? echo $accname;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">accsaldo</td> 
<td><input type="text" id="accsaldo" name="accsaldo" size="30" maxlength="25" value="<? echo $accsaldo;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">groupacc_idgroupacc</td> 
<td><input type="text" id="groupacc_idgroupacc" name="groupacc_idgroupacc" size="30" maxlength="25" value="<? echo $groupacc_idgroupacc;?>" readonly /></td> 
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
