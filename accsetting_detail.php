	<?  
require_once ('login.php'); 
		$str="select * from accsetting where idaccsetting = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idaccsetting=$data['idaccsetting']; 
		$app=$data['app']; 
		$dacc_idacc=$data['dacc_idacc']; 
		$kacc_idacc=$data['kacc_idacc']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data accsetting"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/accsetting_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="accsetting_detail" method="POST" action="" name="accsetting_detail"> 
  <table  class="header" ><tr><td class="judul">Data Detail accsetting &nbsp; 
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
<tr><td class="right">idaccsetting</td><td><input type="text" id="idaccsetting" name="idaccsetting" size="10" <? echo readonly;?> value="<? echo $idaccsetting;?>" /></td> 
</tr> 
<tr> 
<td class="right">app</td> 
<td><input type="text" id="app" name="app" size="30" maxlength="25" value="<? echo $app;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">dacc_idacc</td> 
<td><input type="text" id="dacc_idacc" name="dacc_idacc" size="30" maxlength="25" value="<? echo $dacc_idacc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">kacc_idacc</td> 
<td><input type="text" id="kacc_idacc" name="kacc_idacc" size="30" maxlength="25" value="<? echo $kacc_idacc;?>" readonly /></td> 
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
