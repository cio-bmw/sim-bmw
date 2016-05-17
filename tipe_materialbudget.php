<? require_once ('login.php'); 
include_once("config.php"); 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/tipe_materialbudget.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr> 
  <td>

 <input  class="button" type="button" value="Tambah" id="btntambah">
 <input  class="button" type="button" value="Copy RAB" id="btncopy">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form> 
</div> 
<div>
<?  
		$str="select * from tipe where idtipe = '$_GET[idtipe]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtipe=$data['idtipe']; 
		$tipename=$data['tipename']; 
		$ukuran=$data['ukuran']; 
		$lb=$data['lb']; 
		$lt=$data['lt']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data tipe"; 
?> 
<p class="judul">RAB Material Tipe <? echo $tipename; ?></p>
 <table class="grid"> 
<tr>
<td >Kode</td>
<td>Type RUmah</td>
<td >Ukuran</td>
<td>LB</td>
<td >LT</td>
</tr>



<tr> 
<td><input type="text" id="idtipe" name="idtipe" size="10" <? echo readonly;?> value="<? echo $idtipe;?>" /></td> 
<td><input type="text" id="tipename" name="tipename" size="30" maxlength="25" value="<? echo $tipename;?>" readonly /></td> 
<td><input type="text" id="ukuran" name="ukuran" size="30" maxlength="25" value="<? echo $ukuran;?>" readonly /></td> 
<td><input type="text" id="lb" name="lb" size="5" maxlength="25" value="<? echo $lb;?>" readonly /></td> 
<td><input type="text" id="lt" name="lt" size="5" maxlength="25" value="<? echo $lt;?>" readonly /></td> 
</tr> 
</table> 
</div><br>

 <div id="column1-wrap">
    <div id="divPageEntry"></div> <br>
    <div id="divPageData"></div> 
 </div> 
    <div id="divLOV"></div>

<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
