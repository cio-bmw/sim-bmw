<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/arpdtl.js"></script> 
</head> 
<body> 
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr> 
  <td class="judul">Detail Penerimaan Pembayaran &nbsp; 
   <input  class="button" type="button" value="Tambah" id="btntambah">
   <input  class="button" type="button" value="Daftar Penerimaan" id="btnlist">
  
  </td> </tr></table>
  </form><br /> 
</div> 
<div id="pageheader">
<?
 include_once("config.php"); 
$str="select * from arphdr where idarphdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idarphdr=$data['idarphdr']; 
		$arphdr_date=gettanggal($data['arphdr_date']); 
		$arphdr_desc=$data['arphdr_desc']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Penerimaan Pembayaran Piutang Sektor"; 
		$sektor = sektorinfo(	$sektor_idsektor);
		$sektorname = $sektor['sektorname'];

?>
<form method="post" name="arphdr_form" action="" id="arphdr_form">  
<table class="grid"> 

<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Dok No</td><td><input type="text" id="idarphdr" name="idarphdr" size="10" <? echo $readonly;?> value="<? echo $idarphdr;?>" /></td> 
<td class="right">Tanggal Pembayaran</td> 
<td><input type="text" id="arphdr_date" name="arphdr_date" size="20" maxlength="25" value="<? echo $arphdr_date;?>" /></td> 

</tr> 
<?php } else {?> 
<tr><td class="right">Dok No</td><td><input type="text" id="idarphdr" name="idarphdr" size="10" value="<? echo $idarphdr;?>" /></td> 
<td class="right">Tanggal Pembayaran</td> 
<td><input type="text" id="arphdr_date" name="arphdr_date" size="20" maxlength="25" value="<? echo $arphdr_date;?>" /></td> 

</tr> 
<?php }?> 
<tr> 
<td class="right">Sektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="25" value="<? echo $sektor_idsektor;?>" />

<input type="text" id="sektorname" name="sektorname" size="30" maxlength="25" value="<? echo $sektorname;?>" />
</td> 
<td class="right">Keterangan</td> 
<td><input type="text" id="arphdr_desc" name="arphdr_desc" size="40" maxlength="45" value="<? echo $arphdr_desc;?>" /></td> 

</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 		
</div>
<br> 
<div id="divPageEntry"></div><br>
<table><tr><td>
<div id="divPageData"></div> 
</td><td>
<div id="divLOV"></div> 
</td></tr></table>
<div id="divLoading"></div> 
 
</body> 
</html> 
