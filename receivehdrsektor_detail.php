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
  <table  class="header" ><tr><td class="judul">Data Detail receivehdrsektor &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from receivehdrsektor where idreceivehdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreceivehdr=$data['idreceivehdr']; 
		$supplier_idsupp=$data['supplier_idsupp']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$rcv_date=$data['rcv_date']; 
		$rcv_bon=$data['rcv_bon']; 
		$rcv_titip=$data['rcv_titip']; 
		$rcv_desc=$data['rcv_desc']; 
		$due_date=$data['due_date']; 
		$paid_date=$data['paid_date']; 
		$faktur=$data['faktur']; 
		$rcv_bayar=$data['rcv_bayar']; 
		$rcv_status=$data['rcv_status']; 
		$rcv_diskon=$data['rcv_diskon']; 
		$rcv_totprice=$data['rcv_totprice']; 
		$rcv_totdiskon=$data['rcv_totdiskon']; 
		$rcv_totppn=$data['rcv_totppn']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data receivehdrsektor"; 
?> 
 <table> 
<tr><td class="right">idreceivehdr</td><td><input type="text" id="idreceivehdr" name="idreceivehdr" size="10" <? echo readonly;?> value="<? echo $idreceivehdr;?>" /></td> 
</tr> 
<tr> 
<td class="right">supplier_idsupp</td> 
<td><input type="text" id="supplier_idsupp" name="supplier_idsupp" size="30" maxlength="25" value="<? echo $supplier_idsupp;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">sektor_idsektor</td> 
<td><input type="text" id="sektor_idsektor" name="sektor_idsektor" size="30" maxlength="25" value="<? echo $sektor_idsektor;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_date</td> 
<td><input type="text" id="rcv_date" name="rcv_date" size="30" maxlength="25" value="<? echo $rcv_date;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_bon</td> 
<td><input type="text" id="rcv_bon" name="rcv_bon" size="30" maxlength="25" value="<? echo $rcv_bon;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_titip</td> 
<td><input type="text" id="rcv_titip" name="rcv_titip" size="30" maxlength="25" value="<? echo $rcv_titip;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_desc</td> 
<td><input type="text" id="rcv_desc" name="rcv_desc" size="30" maxlength="25" value="<? echo $rcv_desc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">due_date</td> 
<td><input type="text" id="due_date" name="due_date" size="30" maxlength="25" value="<? echo $due_date;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">paid_date</td> 
<td><input type="text" id="paid_date" name="paid_date" size="30" maxlength="25" value="<? echo $paid_date;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">faktur</td> 
<td><input type="text" id="faktur" name="faktur" size="30" maxlength="25" value="<? echo $faktur;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_bayar</td> 
<td><input type="text" id="rcv_bayar" name="rcv_bayar" size="30" maxlength="25" value="<? echo $rcv_bayar;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_status</td> 
<td><input type="text" id="rcv_status" name="rcv_status" size="30" maxlength="25" value="<? echo $rcv_status;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_diskon</td> 
<td><input type="text" id="rcv_diskon" name="rcv_diskon" size="30" maxlength="25" value="<? echo $rcv_diskon;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_totprice</td> 
<td><input type="text" id="rcv_totprice" name="rcv_totprice" size="30" maxlength="25" value="<? echo $rcv_totprice;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_totdiskon</td> 
<td><input type="text" id="rcv_totdiskon" name="rcv_totdiskon" size="30" maxlength="25" value="<? echo $rcv_totdiskon;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">rcv_totppn</td> 
<td><input type="text" id="rcv_totppn" name="rcv_totppn" size="30" maxlength="25" value="<? echo $rcv_totppn;?>" readonly /></td> 
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
