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
  <table  class="header" ><tr><td class="judul">Data Detail contractor &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from contractor where idcontractor = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcontractor=$data['idcontractor']; 
		$contractorname=$data['contractorname']; 
		$contactno=$data['contactno']; 
		$contactname=$data['contactname']; 
		$address=$data['address']; 
		$bankname=$data['bankname']; 
		$rekno=$data['rekno']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data contractor"; 
?> 
 <table> 
<tr><td class="right">idcontractor</td><td><input type="text" id="idcontractor" name="idcontractor" size="10" <? echo readonly;?> value="<? echo $idcontractor;?>" /></td> 
</tr> 
<tr> 
<td class="right">contractorname</td> 
<td><input type="text" id="contractorname" name="contractorname" size="30" maxlength="25" value="<? echo $contractorname;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">contactno</td> 
<td><input type="text" id="contactno" name="contactno" size="30" maxlength="25" value="<? echo $contactno;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">contactname</td> 
<td><input type="text" id="contactname" name="contactname" size="30" maxlength="25" value="<? echo $contactname;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">address</td> 
<td><input type="text" id="address" name="address" size="30" maxlength="25" value="<? echo $address;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">bankname</td> 
<td><input type="text" id="bankname" name="bankname" size="30" maxlength="25" value="<? echo $bankname;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rekno</td> 
<td><input type="text" id="rekno" name="rekno" size="30" maxlength="25" value="<? echo $rekno;?>" readonly /></td> 
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
