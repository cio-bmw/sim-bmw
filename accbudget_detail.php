	<?  
require_once ('login.php'); 
		$str="select * from accbudget where idaccbudget = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idaccbudget=$data['idaccbudget']; 
		$tahun=$data['tahun']; 
		$bulan=$data['bulan']; 
		$budget=$data['budget']; 
		$acc_idacc=$data['acc_idacc']; 
		$saldoawal=$data['saldoawal']; 
		$saldo=$data['saldo']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data accbudget"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/accbudget_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail accbudget &nbsp; 
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
<tr><td class="right">idaccbudget</td><td><input type="text" id="idaccbudget" name="idaccbudget" size="10" <? echo readonly;?> value="<? echo $idaccbudget;?>" /></td> 
</tr> 
<tr> 
<td class="right">tahun</td> 
<td><input type="text" id="tahun" name="tahun" size="30" maxlength="25" value="<? echo $tahun;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">bulan</td> 
<td><input type="text" id="bulan" name="bulan" size="30" maxlength="25" value="<? echo $bulan;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">budget</td> 
<td><input type="text" id="budget" name="budget" size="30" maxlength="25" value="<? echo $budget;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">acc_idacc</td> 
<td><input type="text" id="acc_idacc" name="acc_idacc" size="30" maxlength="25" value="<? echo $acc_idacc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">saldoawal</td> 
<td><input type="text" id="saldoawal" name="saldoawal" size="30" maxlength="25" value="<? echo $saldoawal;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">saldo</td> 
<td><input type="text" id="saldo" name="saldo" size="30" maxlength="25" value="<? echo $saldo;?>" readonly /></td> 
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
