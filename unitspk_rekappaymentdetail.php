<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/unitspk_rekappaymentdetail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail Pembayaran SPK &nbsp; 
  <input  class="button" type="button" value="Cetak" id="btncetak">
 
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from unitspk where idunitspk = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunitspk=$data['idunitspk']; 
		$spkdate=$data['spkdate']; 
		$spkdesc1=$data['spkdesc1']; 
		$spkdesc2=$data['spkdesc2']; 
		$spkvalue=nf($data['spkvalue']); 
		$spkcat_idspkcat=$data['spkcat_idspkcat']; 
		$unit_idunit=$data['unit_idunit']; 
		$contractor_idcontractor=$data['contractor_idcontractor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unitspk"; 
		
		$unit = unitinfo($unit_idunit);
      $kavling = $unit['kavling'];
      
      $spkcat = spkcatinfo($data['spkcat_idspkcat']);
      $category = $spkcat['category'];      
      
      $contractor = contractorinfo($data['contractor_idcontractor']);
      $contractorname = $contractor['contractorname'];
		
		
?> 
<table class="grid"><tr><td>
 <table> 
<tr><td class="right">No SPK</td><td><input type="text" id="idunitspk" name="idunitspk" size="10" <? echo readonly;?> value="<? echo $idunitspk;?>" /></td> 
</tr> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="spkdate" name="spkdate" size="30" maxlength="25" value="<? echo $spkdate;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">spkdesc1</td> 
<td><input type="text" id="spkdesc1" name="spkdesc1" size="30" maxlength="25" value="<? echo $spkdesc1;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">spkdesc2</td> 
<td><input type="text" id="spkdesc2" name="spkdesc2" size="30" maxlength="25" value="<? echo $spkdesc2;?>" readonly /></td> 
</tr> 
</table></td>
<td>
<table>
<tr> 
<td class="right">Unit/Kavling</td> 
<td>
<input type="text" id="unit_idunit" name="unit_idunit" size="5" maxlength="25" value="<? echo $unit_idunit;?>" readonly />
<input type="text" id="kavling" name="kavling" size="30" maxlength="25" value="<? echo $kavling;?>" readonly />
</td> 
</tr> 

<tr> 
<td class="right">Nilai Kontrak</td> 
<td><input   class="right" type="text" id="spkvalue" name="spkvalue" size="10" maxlength="25" value="<? echo $spkvalue;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">Kategori</td> 
<td>
<input type="text" id="spkcat_idspkcat" name="spkcat_idspkcat" size="5" maxlength="25" value="<? echo $spkcat_idspkcat;?>" readonly />
<input type="text" id="category" name="category" size="30" maxlength="25" value="<? echo $category;?>" readonly />

</td> 
</tr> 
<tr> 
<td class="right">Contractor</td> 
<td>
<input type="text" id="contractor_idcontractor" name="contractor_idcontractor" size="5" maxlength="25" value="<? echo $contractor_idcontractor;?>" readonly />
<input type="text" id="contractorname" name="contractorname" size="30" maxlength="25" value="<? echo $contractorname;?>" readonly />

</td> 
</tr> 
</table> 
</td>
</tr> 
</table> 

</div>  
<div id="column1-wrap">
<div id="divPageEntry"></div>
<div id="divPageData"></div> 
</div>
<div id="divLOV" style="align: right;"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
</body> 
</html>  
