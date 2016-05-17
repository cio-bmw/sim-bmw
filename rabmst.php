<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/rabmst.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div> 
  <form id="formSearch"> 
  <table  width="1000px" ><tr> 
  <td>rabmst <select id="pilihcari">  
      <option value="idrabmst">idrabmst</option> 
      <option value="rabdesc">rabdesc</option> 
      <option value="rabcat_idrabcat">rabcat_idrabcat</option> 
      <option value="satuan">satuan</option> 
      <option value="semua">Semua</option> 
  </select>
  <input type="text" name="fieldcari" id="fieldcari" value="%" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
  
  </td> </tr></table>
  </form> 
</div>  <br>
<div id="column1-wrap" style=" width:610px; ">
    <div id="divPageEntry"></div> <br>
     <div id="divPageData"></div> 
 </div> 
    <div id="divlov"></div><br>
<div id="clear"></div>

 <div id="divLoading"></div> 
 
</body> 
</html> 
