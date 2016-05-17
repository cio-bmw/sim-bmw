<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/emp.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
  <table  class="header" ><tr> 
  <td> 
   <form id="emp" method="POST" action="" name="emp">  
  Cari Data : <select id="pilihcari">  
      <option value="idemp">idemp</option> 
      <option value="empasswd">empasswd</option> 
      <option value="empname">empname</option> 
      <option value="empphone">empphone</option> 
      <option value="gp">gp</option> 
      <option value="gs">gs</option> 
      <option value="mkt">mkt</option> 
      <option value="tch">tch</option> 
      <option value="acc">acc</option> 
      <option value="kpr">kpr</option> 
      <option value="adm">adm</option> 
      <option value="semua">Semua</option> 
  </select>
  <input type="text" name="fieldcari" id="fieldcari" value="%" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
  </form> 
  </td> </tr></table>
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
