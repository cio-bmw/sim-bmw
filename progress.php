<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/progress.js"></script> 
</head> 
<body> 
<table class="white">
<tr><td class="white"><img src="images/logo.png"></td></tr>
<tr><td class="judul">Data progress</td></tr>
</table>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table><tr> 
  <td>Cari Berdasarkan</td><td><select id="pilihcari">  
      <option value="idprogress">idprogress</option> 
      <option value="progressname">progressname</option> 
      <option value="semua">Semua</option> 
  </select></td> 
  <td id="kolompilih"><input type="text" name="fieldcari" id="fieldcari" value="%" /></td><td> 
  <input   class="button" type="submit" value="Tampilkan" />
 <input type="button" value="Tambah" id="btntambah">
   <input   class="button" type="button" value="Kembali Ke Menu" id="btnexit">
  </td> </tr></table>
  </form><br /> 
</div> 
 
<div id="divPageData"></div> 
<div id="divLoading"></div> 
 
</body> 
</html> 
