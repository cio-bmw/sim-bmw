<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/txndaily.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <table  class="header" ><tr> 
  <td> 
   <form id="txndaily" method="POST" action="" name="txndaily">  
  Cari Data : <select id="pilihcari">  
      <option value="idtxndaily">No Dok</option> 
      <option value="txndate">Tanggal</option> 
      <option value="txndesc">Keterangan</option> 
   
      <option value="semua">Semua</option> 
  </select>
  <input type="text" name="fieldcari" id="fieldcari" size="10"  value="%" /> 
 
Pos : <select id="idtxnpos"  name="idtxnpos">
<? createtxnposoption($idtxnpos); ?>
</select>  
Alokasi : <select id="idtxnalokasi"  name="idtxnalokasi">
<? createtxnalokasioption($idtxnalokasi); ?>
</select>  
  
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
