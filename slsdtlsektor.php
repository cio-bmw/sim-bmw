<? require_once ('login.php'); 
$str="select * from slshdrsektor where idslshdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslshdr=$data['idslshdr']; 
		$sls_date=gettanggal($data['sls_date']); 
		$sls_bon=$data['sls_bon']; 
		$sls_titip=$data['sls_titip']; 
		$due_date=gettanggal($data['due_date']); 
		$sls_blj=$data['sls_blj']; 
		$sls_tambahan=$data['sls_tambahan']; 
		$sls_total=$data['sls_total']; 
		$sls_bayar=$data['sls_bayar']; 
		$sls_kembali=$data['sls_kembali']; 
		$sls_desc=$data['sls_desc']; 
		$payment_date=$data['payment_date']; 
		$sls_status=$data['sls_status']; 
		$sls_diskon=$data['sls_diskon']; 
		$emp_idemp=$data['emp_idemp']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data slshdrsektor"; 
$sektor=sektorinfo($sektor_idsektor);
$sektorname = $sektor['sektorname'];		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/slsdtlsektor.js"></script> 

</head> 
<body> 

<? include_once "header.php"; ?>
<div id="divSearch"> 
 <form id="formSearch"> 
<table  class="header"><tr><td class="judul"> Data Detail Pengiriman Barang &nbsp;
 <input class="button" type="button" value="Tampilkan Barang" id="btnslsdtl" />
 <input class="button" type="button" value="Tambah Barang" id="btnaddproduct" />
 <? if($sls_status=='confirm') { ?>
 <input type="button" class="button" id="btnreopen" name="btnreopen" value="Batalkan Konfirmasi"> 
<? }  else { ?> 
 <input class="button" type="button"  name="btnconfirm" value="Konfirmasi" id="btnconfirm" />

  <? } ?>
 <input class="button" type="button" value="Cetak Dokumen" id="btncetak" />
 <input  class="button" type="button" value="Kembali Data Penjualan" id="btnlist">

  </td> </tr></table>
  </form><br /> 
</div> 
<div id="divPageHeader">

<table class="grid"> 
<tr>
<td>No Dok</td>
<td><input type="text" id="idslshdr" name="idslshdr" size="5" value="<? echo $idslshdr;?>" />Tanggal :
<input type="text" id="sls_date" name="sls_date" size="10" maxlength="25" value="<? echo $sls_date;?>" />
</td> 
<td>Jatuh Tempo</td> 
<td><input type="text" id="due_date" name="due_date" size="10" maxlength="25" value="<? echo $due_date;?>" />
Status Dok :<input type="text" id="sls_status" name="sls_status" size="10" maxlength="25" value="<? echo $sls_status;?>" /> 
</td> 
</tr>
<tr>
<td>Sektor</td>
<td><input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="25" value="<? echo $sektor_idsektor;?>" /> 
<input type="text" id="sektorname" name="sektorname" size="30" maxlength="25" value="<? echo $sektorname;?>" /></td> 
<td>Catatan</td>
<td><input type="text" id="sls_desc" name="sls_desc" size="50" maxlength="50" value="<? echo $sls_desc;?>" /></td> 
</tr> 
</table> 
</div>  
<br>
<div id="column1-wrap">
  <div id="divPageEntry"></div> 
  <br>
  <div id="divPageData"></div> 
 </div> 
    <div id="divLOV"></div>
<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
