<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/slsdtlunit.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr> 
  <td>Detail Pengeluaran Barang Ke Unit
 <input  class="button" type="button" value="Tampilkan" id="btntampil">

 <input  class="button" type="button" value="Tambah Barang" id="btntambah">
  <input  class="button" type="button" value="Konfirmasi" id="btnconfirm">
   <input  class="button" type="button" value="Kembali Ke Daftar" id="btnlist">
  
  </td> </tr></table>
  </form><br /> 
</div> 

<div>
 <?
$str="select * from slshdrunit where idslshdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslshdr=$data['idslshdr']; 
		$sls_date=$data['sls_date']; 
		$sls_status=$data['sls_status']; 
		$emp_idemp=$data['emp_idemp']; 
		$unit_idunit=$data['unit_idunit']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data slshdrunit"; 
		$unit = unitinfo($unit_idunit);
		$kavling = $unit['kavling'];
		$idsektor = $unit['sektor_idsektor'];
      $sektor = sektorinfo($idsektor);  			
      $sektorname = $sektor['sektorname'];  			
  			
		
?>
<table class="grid">
<tr><td>
No Dok : <input type="text" id="idslshdr" name="idslshdr" size="5" value="<? echo $idslshdr;?>" /> 
Tanggal : <input type="text" id="sls_date" name="sls_date" size="10" maxlength="25" value="<? echo $sls_date;?>" />
<input type="hidden" id="unit_idunit" name="unit_idunit" size="3" maxlength="25" value="<? echo $unit_idunit;?>" />
Kavling : <input type="text" id="kavling" name="kavling" size="5" maxlength="25" value="<? echo $kavling;?>" />
Sektor : 
<input type="text" id="idsektor" name="idsektor" size="5" maxlength="25" value="<? echo $idsektor;?>" />
<input type="text" id="sektor" name="sektor" size="25" maxlength="25" value="<? echo $sektorname;?>" />
Status :  
<input type="text" id="sls_status" name="sls_status" size="5" maxlength="25" value="<? echo $sls_status;?>" />
</td> 
</tr> 

<input type="hidden" id="sls_status" name="sls_status" size="30" maxlength="25" value="<? echo $sls_status;?>" />
<input type="hidden" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" />
</table>
</div>
<br>
<div id="column1-wrap">
  <div id="divPageEntry" style="width:500px;"></div> 
  <br>
  <div id="divPageData"></div> 
 </div> 
    <div id="divLOV"></div>
<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
