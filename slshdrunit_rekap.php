<? require_once ('login.php'); 
$idsektor = $_POST['idsektor'];
$fieldcari =  $_POST['fieldcari'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/slshdrunit_rekap.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
   <form id="unit" method="POST" action="" name="unit"> 
  <table  class="header" ><tr> 
  <td>Sektor : <select id="idsektor" name="idsektor" onchange="this.form.submit()" >
 echo "<option value="%" >Semua</option>"; 
  <? createsektoroption($idsektor);?>
  </select>
   Kavling :   
  <input type="text" name="fieldcari" id="fieldcari" value="<? echo $fieldcari; ?>" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">

<input  class="button" type="button" value="Kembali Ke Menu" id="btnexit">
  </td> </tr></table>
  </form><br /> 
</div> 
<div id="column1-wrap">
    <div id="divPageData"></div> 
 </div> 
    <div id="divLOV"></div>

<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 