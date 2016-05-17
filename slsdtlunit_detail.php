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
  <table  class="header" ><tr><td class="judul">Data Detail slsdtlunit &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from slsdtlunit where idslsdtlunit = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslsdtl=$data['idslsdtl']; 
		$cost_price=$data['cost_price']; 
		$qty=$data['qty']; 
		$sales_price=$data['sales_price']; 
		$slshdrunit_idslshdr=$data['slshdrunit_idslshdr']; 
		$product_idproduct=$data['product_idproduct']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data slsdtlunit"; 
?> 
 <table> 
<tr><td class="right">idslsdtl</td><td><input type="text" id="idslsdtl" name="idslsdtl" size="10" <? echo readonly;?> value="<? echo $idslsdtl;?>" /></td> 
</tr> 
<tr> 
<td class="right">cost_price</td> 
<td><input type="text" id="cost_price" name="cost_price" size="30" maxlength="25" value="<? echo $cost_price;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">qty</td> 
<td><input type="text" id="qty" name="qty" size="30" maxlength="25" value="<? echo $qty;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">sales_price</td> 
<td><input type="text" id="sales_price" name="sales_price" size="30" maxlength="25" value="<? echo $sales_price;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">slshdrunit_idslshdr</td> 
<td><input type="text" id="slshdrunit_idslshdr" name="slshdrunit_idslshdr" size="30" maxlength="25" value="<? echo $slshdrunit_idslshdr;?>" readonly /></td> 
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
