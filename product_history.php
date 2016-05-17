<? require_once ('login.php'); 
$idproduct = $_GET['id'];
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/product_history.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr> 
  <td class="judul">Kode Barang :
  <input type="text" name="idproduct" id="idproduct" value="<? echo $idproduct; ?>"/> 
  <input type="text" name="productname" id="productname" value="<? echo $productname; ?>"/> 
  
 <input  class="button" type="button" value="History Penjualan" id="btnsls">
 <input  class="button" type="button" value="History Penerimaan" id="btnrcv">
 
  
  </td> </tr></table>
  </form>
</div> <br />
<div id="column1-wrap">
  <div id="divPageEntry"></div> 
  <br>
  <div id="divPageData"></div> 
 </div> 
    <div id="divLOV"></div>
<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
