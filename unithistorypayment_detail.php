	<?  
require_once ('login.php'); 
		$str="select * from unithistorypayment where idunithistorypayment = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunithistorypayment=$data['idunithistorypayment']; 
		$pay_date=$data['pay_date']; 
		$pay_value=$data['pay_value']; 
		$pay_name=$data['pay_name']; 
		$pay_note=$data['pay_note']; 
		$unitmstpayment_idpayment=$data['unitmstpayment_idpayment']; 
		$unithistory_idunithistory=$data['unithistory_idunithistory']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unithistorypayment"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/unithistorypayment_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="unithistorypayment_detail" method="POST" action="" name="unithistorypayment_detail"> 
  <table  class="header" ><tr><td class="judul"> 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  </td> </tr></table>
  </form> 
</div> 
<p class="judul">Data Detail unithistorypayment</p>
 <table> 
<tr><td class="right">idunithistorypayment</td><td><input type="text" id="idunithistorypayment" name="idunithistorypayment" size="10" <? echo readonly;?> value="<? echo $idunithistorypayment;?>" /></td> 
</tr> 
<tr> 
<td class="right">pay_date</td> 
<td><input type="text" id="pay_date" name="pay_date" size="30" maxlength="25" value="<? echo $pay_date;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">pay_value</td> 
<td><input type="text" id="pay_value" name="pay_value" size="30" maxlength="25" value="<? echo $pay_value;?>" readonly /></td> 
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
<tr> 
<td class="right">unithistory_idunithistory</td> 
<td><input type="text" id="unithistory_idunithistory" name="unithistory_idunithistory" size="30" maxlength="25" value="<? echo $unithistory_idunithistory;?>" readonly /></td> 
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
