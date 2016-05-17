<? require_once ('login.php'); 

$carisektor = $_POST['carisektor'];
$idcontractor = $_POST['idcontractor'];
$idkpr = $_POST['idkpr'];
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/unit_material_menu.js"></script> 


</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="unit" method="POST" action="" name="unit"> 
  <table  class="header" ><tr> 
  <td class="judul2">Data Unit    &nbsp;&nbsp;&nbsp;&nbsp; Pilih Sektor :
  <select id="carisektor" name="carisektor" onchange="this.form.submit()" >
 echo "<option value="%" >Semua</option>"; 
  <? createsektoroption($carisektor);?>
  </select>
  Kontraktor :
  <select id="idcontractor" name="idcontractor" onchange="this.form.submit()" >
  <? createcontractoroption($idcontractor);?>
  </select>
 
 <input  class="button" type="button" value="Tambah" id="btntambah">
  
  </td> </tr></table>
  </form><br /> 
</div> 
 
<div id="divPageData"></div> 
<div id="divLoading"></div> 
 
</body> 
</html> 
