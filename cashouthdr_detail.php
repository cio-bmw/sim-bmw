<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/cashouthdr_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Pengeluaran Kas Kecil &nbsp; 
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from cashouthdr where idcashouthdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcashouthdr=$data['idcashouthdr']; 
		$txndate=$data['txndate']; 
		$txndesc=$data['txndesc']; 
		$costcenter_idcostcenter=$data['costcenter_idcostcenter']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data cashouthdr"; 
		
		$cc = costcenterinfo($costcenter_idcostcenter);
  		$costcentername = $cc['costcentername'];
  
?> 
 <table class="grid"> 
<tr> 
<td class="center">No Dok</td>
<td class="center">Tanggal</td>
<td class="center">Keterangan</td>
<td class="center" colspan=2>Unit Kerja</td>
</tr>

<tr>
<td><input type="text" id="idcashouthdr" name="idcashouthdr" size="3" <? echo readonly;?> value="<? echo $idcashouthdr;?>" /></td> 
<td><input type="text" id="txndate" name="txndate" size="10" maxlength="25" value="<? echo $txndate;?>" readonly /></td> 
<td><input type="text" id="txndesc" name="txndesc" size="50" maxlength="40" value="<? echo $txndesc;?>" readonly /></td> 
<td><input type="text" id="costcenter_idcostcenter" name="costcenter_idcostcenter" size="5" maxlength="25" value="<? echo $costcenter_idcostcenter;?>" readonly /></td> 
<td><input type="text" id="costcentername" name="costcentername" size="30" maxlength="25" value="<? echo $costcentername;?>" readonly /></td> 

</tr> 
</table> 
</div>  <br>
<div id="column1-wrap">
    <div id="divPageData"></div> 
 </div> 
    <div id="divlov"></div>

<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
