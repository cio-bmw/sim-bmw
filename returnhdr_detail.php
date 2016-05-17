<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/returnhdr_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail returnhdr &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btnadd">
 <input  class="button" type="button" value="Confirm" id="btnconfirm">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from returnhdr where idreturnhdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreturnhdr=$data['idreturnhdr']; 
		$return_date=$data['return_date']; 
		$catatan=$data['catatan']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data returnhdr"; 
		
		$sektor =sektorinfo($data['sektor_idsektor']);
  		$sektorname = $sektor['sektorname'];
?> 
 <table class="grid"> 
<tr>
<td class="right">No Dok</td><td><input type="text" id="idreturnhdr" name="idreturnhdr" size="5" <? echo readonly;?> value="<? echo $idreturnhdr;?>" /></td> 
<td class="right">Tanggal</td> 
<td><input type="text" id="return_date" name="return_date" size="8" maxlength="25" value="<? echo $return_date;?>" readonly /></td> 
<td class="right">Sektor</td> 
<input type="hidden" id="sektor_idsektor" name="sektor_idsektor" size="30" maxlength="25" value="<? echo $sektor_idsektor;?>" readonly /> 
<td><input type="text" id="sektorname" name="sektorname" size="20" maxlength="25" value="<? echo $sektorname;?>" readonly /></td> 

<td class="right">catatan</td> 
<td><input type="text" id="catatan" name="catatan" size="30" maxlength="25" value="<? echo $catatan;?>" readonly /></td> 
</tr> 
</table> 
<p class="judul" >Detail Retur Barang Dari Sektor </p>
</div>  
<div id="column1-wrap" style="width:500px;">
  <div id="divPageEntry"></div>
  <div id="divPageData"></div> 
</div> 
<div id="divLOV" style="width:500px;" ></div>
<div id="clear"></div><br>
</body> 
</html> 