<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/sektorcosthdr_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail sektorcosthdr &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
  <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from sektorcosthdr where idsektorcosthdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idsektorcosthdr=$data['idsektorcosthdr']; 
		$txndate=$data['txndate']; 
		$txndesc=$data['txndesc']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data sektorcosthdr"; 
		$sektor =sektorinfo($sektor_idsektor);
  		$sektorname = $sektor['sektorname'];
  	
		
?> 
 <table class="grid"> 
<tr><td>No Dok</td><td>Tanggal</td><td>Keterangan</td><td colspan="2" width="200">Sektor</td></tr> 
<tr><td><input type="text" id="idsektorcosthdr" name="idsektorcosthdr" size="5" <? echo readonly;?> value="<? echo $idsektorcosthdr;?>" /></td> 
<td><input type="text" id="txndate" name="txndate" size="10" maxlength="25" value="<? echo $txndate;?>" readonly /></td> 
<td><input type="text" id="txndesc" name="txndesc" size="40" maxlength="25" value="<? echo $txndesc;?>" readonly /></td> 
<td><input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="25" value="<? echo $sektor_idsektor;?>" readonly /></td> 
<td><input type="text" id="sektorname" name="sektorname" size="25" maxlength="25" value="<? echo $sektorname;?>" readonly /></td> 

</tr> 
</table> 
</div> <br>
<div id="column1-wrap" style="width:610px;">
    <div id="divPageEntry"></div> <br>
    <div id="divPageData"></div> 
 </div> 
    <div id="divLOV" style="width:400px;"></div>

<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
