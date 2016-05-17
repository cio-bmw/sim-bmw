<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/spkpaymenthdr_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail spkpaymenthdr &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  
  </td> </tr></table>
  </form>
</div> 
	<?  
		$str="select * from spkpaymenthdr where idspkpaymenthdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idspkpaymenthdr=$data['idspkpaymenthdr']; 
		$paydate=$data['paydate']; 
		$contractor_idcontractor=$data['contractor_idcontractor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data spkpaymenthdr"; 
		$contractor = contractorinfo($contractor_idcontractor);
		$contractorname = $contractor['contractorname'];
?> 
 <table class="grid"> 
<tr><td class="right">
No Dok </td><td><input type="text" id="idspkpaymenthdr" name="idspkpaymenthdr" size="10" <? echo readonly;?> value="<? echo $idspkpaymenthdr;?>" /></td> 
<td class="right">Tanggal</td> 
<td><input type="text" id="paydate" name="paydate" size="30" maxlength="25" value="<? echo $paydate;?>" readonly /></td> 
<td class="right">Contractor</td> 
<td>
<input type="text" id="contractor_idcontractor" name="contractor_idcontractor" size="5" maxlength="25" value="<? echo $contractor_idcontractor;?>" readonly />
<input type="text" id="contractorname" name="contractorname" size="30" maxlength="25" value="<? echo $contractorname;?>" readonly />

</td> 
</tr> 
</table> 
</div>  
 
<div id="column1-wrap">
<div id="divPageEntry" style="width:500px;"></div>
<div id="divPageData"></div> 
</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
</body> 
</html>  
