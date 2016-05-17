	<?  
require_once ('login.php'); 
		$str="select * from members where idmembers = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$member_id=$data['member_id']; 
		$hp_no=$data['hp_no']; 
		$name=$data['name']; 
		$address=$data['address']; 
		$title=$data['title']; 
		$pilih=$data['pilih']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data members"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/members_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="members_detail" method="POST" action="" name="members_detail"> 
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
<p class="judul">Data Detail members</p>
 <table> 
<tr><td class="right">member_id</td><td><input type="text" id="member_id" name="member_id" size="10" <? echo readonly;?> value="<? echo $member_id;?>" /></td> 
</tr> 
<tr> 
<td class="right">hp_no</td> 
<td><input type="text" id="hp_no" name="hp_no" size="30" maxlength="25" value="<? echo $hp_no;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">name</td> 
<td><input type="text" id="name" name="name" size="30" maxlength="25" value="<? echo $name;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">address</td> 
<td><input type="text" id="address" name="address" size="30" maxlength="25" value="<? echo $address;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">title</td> 
<td><input type="text" id="title" name="title" size="30" maxlength="25" value="<? echo $title;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">pilih</td> 
<td><input type="text" id="pilih" name="pilih" size="30" maxlength="25" value="<? echo $pilih;?>" readonly /></td> 
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
