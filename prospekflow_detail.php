	<?  
require_once ('login.php'); 
		$str="select * from prospekflow where idprospekflow = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idprospekflow=$data['idprospekflow']; 
		$prospekflow=$data['prospekflow']; 
		$dateflow=$data['dateflow']; 
		$prospek_idprospek=$data['prospek_idprospek']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data prospekflow"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/prospekflow_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="prospekflow_detail" method="POST" action="" name="prospekflow_detail"> 
  <table  class="header" ><tr><td class="judul"> 
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
<p class="judul">Data Detail prospekflow</p>
 <table> 
<tr><td class="right">idprospekflow</td><td><input type="text" id="idprospekflow" name="idprospekflow" size="10" <? echo readonly;?> value="<? echo $idprospekflow;?>" /></td> 
</tr> 
<tr> 
<td class="right">prospekflow</td> 
<td><input type="text" id="prospekflow" name="prospekflow" size="30" maxlength="25" value="<? echo $prospekflow;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">dateflow</td> 
<td><input type="text" id="dateflow" name="dateflow" size="30" maxlength="25" value="<? echo $dateflow;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">prospek_idprospek</td> 
<td><input type="text" id="prospek_idprospek" name="prospek_idprospek" size="30" maxlength="25" value="<? echo $prospek_idprospek;?>" readonly /></td> 
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
