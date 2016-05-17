<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/unitclbangun.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
   <form id="unitclbangun" method="POST" action="" name="unitclbangun">  
  <table  class="header" ><tr> 
  <td>unitclbangun <select id="pilihcari">  
      <option value="idunitclbangun">idunitclbangun</option> 
      <option value="clstatus">clstatus</option> 
      <option value="clbangun_idclbangun">clbangun_idclbangun</option> 
      <option value="unit_idunit">unit_idunit</option> 
      <option value="bobotpct">bobotpct</option> 
      <option value="unitspk_idunitspk">unitspk_idunitspk</option> 
      <option value="workdays">workdays</option> 
      <option value="semua">Semua</option> 
  </select>
  <input type="text" name="fieldcari" id="fieldcari" value="%" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
  
  </td> </tr></table>
  </form><br /> 
</div> 
 
<div id="column1-wrap"> 
<div id="divPageEntry"></div><br> 
<div id="divPageData"></div> 
</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
 
</body> 
</html> 
