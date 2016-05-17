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
  <table  class="header" ><tr><td class="judul">Data Detail tipe_materialbudget &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from tipe_materialbudget where idtipe_materialbudget = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idbudget=$data['idbudget']; 
		$qty=$data['qty']; 
		$tipe_idtipe=$data['tipe_idtipe']; 
		$product_idproduct=$data['product_idproduct']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data tipe_materialbudget"; 
		
		$tipe = tipeinfo($tipe_idtipe);
		$tipename = $tipe['tipename'];
?> 
<p class="judul">RAB Material Tipe <? echo $tipename; ?></p>
 <table> 
<tr><td class="right">idbudget</td><td><input type="text" id="idbudget" name="idbudget" size="10" <? echo readonly;?> value="<? echo $idbudget;?>" /></td> 
</tr> 
<tr> 
<td class="right">qty</td> 
<td><input type="text" id="qty" name="qty" size="30" maxlength="25" value="<? echo $qty;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">tipe_idtipe</td> 
<td><input type="text" id="tipe_idtipe" name="tipe_idtipe" size="30" maxlength="25" value="<? echo $tipe_idtipe;?>" readonly /></td> 
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
