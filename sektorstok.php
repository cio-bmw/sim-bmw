<? require_once ('login.php');
$sektor = $_POST['sektor']; ?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/sektorstok.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch" method="POST" action="" name="unit"> 
  <table  class="header" ><tr> 
  <td>Sektor :
  <select id="sektor" name="sektor" >
  <? createsektoroption($sektor);?>
  </select>Nama Barang :
  <input type="text" name="fieldcari" id="fieldcari" value="%" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
  
  </td> </tr></table>
  </form><br /> 
</div>  
<div id="column1-wrap" style="width:550px;">
  <div id="divPageEntry"></div> 
   <div id="divPageData"></div> 
 </div> 
    <div id="divLOV" style="width:450px;" ></div>
<div id="clear"></div><br>

 
</body> 
</html> 

