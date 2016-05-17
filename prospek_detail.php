	<?  
require_once ('login.php'); 
		$str="select * from prospek where idprospek = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idprospek=$data['idprospek']; 
		$prospek=$data['prospek']; 
		$phone=$data['phone']; 
		$alamat=$data['alamat']; 
		$catatan=$data['catatan']; 
		$marketing_idmarketing=$data['marketing_idmarketing']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$kavling=$data['kavling']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data prospek"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/prospek_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="prospek_detail" method="POST" action="" name="prospek_detail"> 
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
<p class="judul">Data Detail prospek</p>
 <table> 
<tr><td class="right">idprospek</td><td><input type="text" id="idprospek" name="idprospek" size="10" <? echo readonly;?> value="<? echo $idprospek;?>" /></td> 
</tr> 
<tr> 
<td class="right">prospek</td> 
<td><input type="text" id="prospek" name="prospek" size="30" maxlength="25" value="<? echo $prospek;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">phone</td> 
<td><input type="text" id="phone" name="phone" size="30" maxlength="25" value="<? echo $phone;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">alamat</td> 
<td><input type="text" id="alamat" name="alamat" size="30" maxlength="25" value="<? echo $alamat;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">catatan</td> 
<td><input type="text" id="catatan" name="catatan" size="30" maxlength="25" value="<? echo $catatan;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">marketing_idmarketing</td> 
<td><input type="text" id="marketing_idmarketing" name="marketing_idmarketing" size="30" maxlength="25" value="<? echo $marketing_idmarketing;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">sektor_idsektor</td> 
<td><input type="text" id="sektor_idsektor" name="sektor_idsektor" size="30" maxlength="25" value="<? echo $sektor_idsektor;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">kavling</td> 
<td><input type="text" id="kavling" name="kavling" size="30" maxlength="25" value="<? echo $kavling;?>" readonly /></td> 
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
