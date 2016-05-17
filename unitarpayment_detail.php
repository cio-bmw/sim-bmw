<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail unitarpayment &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from unitarpayment where idunitarpayment = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunitarpayment=$data['idunitarpayment']; 
		$pay_value=$data['pay_value']; 
		$unit_idunit=$data['unit_idunit']; 
		$pay_date=$data['pay_date']; 
		$pay_name=$data['pay_name']; 
		$pay_note=$data['pay_note']; 
		$unitmstpayment_idpayment=$data['unitmstpayment_idpayment']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unitarpayment"; 
?> 
 <table> 
<tr><td class="right">idunitarpayment</td><td><input type="text" id="idunitarpayment" name="idunitarpayment" size="10" <? echo readonly;?> value="<? echo $idunitarpayment;?>" /></td> 
</tr> 
<tr> 
<td class="right">pay_value</td> 
<td><input type="text" id="pay_value" name="pay_value" size="30" maxlength="25" value="<? echo $pay_value;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td><input type="text" id="unit_idunit" name="unit_idunit" size="30" maxlength="25" value="<? echo $unit_idunit;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">pay_date</td> 
<td><input type="text" id="pay_date" name="pay_date" size="30" maxlength="25" value="<? echo $pay_date;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">pay_name</td> 
<td><input type="text" id="pay_name" name="pay_name" size="30" maxlength="25" value="<? echo $pay_name;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">pay_note</td> 
<td><input type="text" id="pay_note" name="pay_note" size="30" maxlength="25" value="<? echo $pay_note;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">unitmstpayment_idpayment</td> 
<td><input type="text" id="unitmstpayment_idpayment" name="unitmstpayment_idpayment" size="30" maxlength="25" value="<? echo $unitmstpayment_idpayment;?>" readonly /></td> 
</tr> 
</table> 
</div>  
<br />  
<div id="divPageEntry"></div> <br /> 
<div id="divPageData"></div> <br /> 
<div id="divLoading"></div>  
</td> 
<td> 
 <div id="divlov"></div> <br /> 
</td> 
</tr> 
</table> 
</body> 
</html>  
