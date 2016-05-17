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
  <table  class="header" ><tr><td class="judul">Data Detail receivedtlsektor &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from receivedtlsektor where idreceivedtlsektor = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreceivedtl=$data['idreceivedtl']; 
		$qty=$data['qty']; 
		$receive_price=$data['receive_price']; 
		$dtl_ppn=$data['dtl_ppn']; 
		$receive_priceppn=$data['receive_priceppn']; 
		$receive_pricedisc=$data['receive_pricedisc']; 
		$dtl_percent=$data['dtl_percent']; 
		$dtl_discount=$data['dtl_discount']; 
		$batch_no=$data['batch_no']; 
		$exp_date=$data['exp_date']; 
		$receivehdrsektor_idreceivehdr=$data['receivehdrsektor_idreceivehdr']; 
		$product_idproduct=$data['product_idproduct']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data receivedtlsektor"; 
?> 
 <table> 
<tr><td class="right">idreceivedtl</td><td><input type="text" id="idreceivedtl" name="idreceivedtl" size="10" <? echo readonly;?> value="<? echo $idreceivedtl;?>" /></td> 
</tr> 
<tr> 
<td class="right">qty</td> 
<td><input type="text" id="qty" name="qty" size="30" maxlength="25" value="<? echo $qty;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">receive_price</td> 
<td><input type="text" id="receive_price" name="receive_price" size="30" maxlength="25" value="<? echo $receive_price;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">dtl_ppn</td> 
<td><input type="text" id="dtl_ppn" name="dtl_ppn" size="30" maxlength="25" value="<? echo $dtl_ppn;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">receive_priceppn</td> 
<td><input type="text" id="receive_priceppn" name="receive_priceppn" size="30" maxlength="25" value="<? echo $receive_priceppn;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">receive_pricedisc</td> 
<td><input type="text" id="receive_pricedisc" name="receive_pricedisc" size="30" maxlength="25" value="<? echo $receive_pricedisc;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">dtl_percent</td> 
<td><input type="text" id="dtl_percent" name="dtl_percent" size="30" maxlength="25" value="<? echo $dtl_percent;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">dtl_discount</td> 
<td><input type="text" id="dtl_discount" name="dtl_discount" size="30" maxlength="25" value="<? echo $dtl_discount;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">batch_no</td> 
<td><input type="text" id="batch_no" name="batch_no" size="30" maxlength="25" value="<? echo $batch_no;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">exp_date</td> 
<td><input type="text" id="exp_date" name="exp_date" size="30" maxlength="25" value="<? echo $exp_date;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">receivehdrsektor_idreceivehdr</td> 
<td><input type="text" id="receivehdrsektor_idreceivehdr" name="receivehdrsektor_idreceivehdr" size="30" maxlength="25" value="<? echo $receivehdrsektor_idreceivehdr;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">product_idproduct</td> 
<td><input type="text" id="product_idproduct" name="product_idproduct" size="30" maxlength="25" value="<? echo $product_idproduct;?>" readonly /></td> 
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
