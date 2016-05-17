	<?  
require_once ('login.php'); 
		$str="select * from unithistory where idunithistory = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunithistory=$data['idunithistory']; 
		$namauser=$data['namauser']; 
		$tglmundur=$data['tglmundur']; 
		$alasan=$data['alasan']; 
		$unit_idunit=$data['unit_idunit']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unithistory"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/unithistory_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="unithistory_detail" method="POST" action="" name="unithistory_detail"> 
  <table  class="header" ><tr><td class="judul"> 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
   </td> </tr></table>
  </form> 
</div> 
<p class="judul">Data Detail unithistory</p>
 <table> 
<tr><td class="right">idunithistory</td><td><input type="text" id="idunithistory" name="idunithistory" size="10" <? echo readonly;?> value="<? echo $idunithistory;?>" /></td> 
</tr> 
<tr> 
<td class="right">namauser</td> 
<td><input type="text" id="namauser" name="namauser" size="30" maxlength="25" value="<? echo $namauser;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">tglmundur</td> 
<td><input type="text" id="tglmundur" name="tglmundur" size="30" maxlength="25" value="<? echo $tglmundur;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">alasan</td> 
<td><input type="text" id="alasan" name="alasan" size="30" maxlength="25" value="<? echo $alasan;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td><input type="text" id="unit_idunit" name="unit_idunit" size="30" maxlength="25" value="<? echo $unit_idunit;?>" readonly /></td> 
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
