<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/rabsektor.js"></script> 
</head> 
<body> 
<table class="white">
<tr><td class="white"><img src="images/logo.png"></td></tr>
<tr><td class="judul">Data rabsektor</td></tr>
</table>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table><tr> 
  <<td class="judul2">Data Unit    &nbsp;&nbsp;&nbsp;&nbsp; Pilih Sektor :
  <select id="carisektor" name="carisektor" onchange="this.form.submit()" >
 echo "<option value="%" >Semua</option>"; 
  <? createsektoroption($carisektor);?>
  </select></td> 
  <td id="kolompilih"><input type="text" name="fieldcari" id="fieldcari" value="%" /></td><td> 
  <input type="submit" value="Cari" />
 <input type="button" value="Tambah" id="btntambah">
   <input type="button" value="Exit" id="btnexit">
  </td> </tr></table>
  </form><br /> 
</div> 
 
<div id="divPageData"></div> 
<div id="divLoading"></div> 
 
</body> 
</html> 
