<?  
require_once ('login.php'); 
		$str="select * from pl where idpl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpl=$data['idpl']; 
		$plname=$data['plname']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data pl"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/plhdr.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
  <table  class="header" ><tr> 
  <td> 
   <form id="plhdr" method="POST" action="" name="plhdr">  
  Cari Data : <select id="pilihcari">  
      <option value="idplhdr">idplhdr</option> 
      <option value="plhdrname">plhdrname</option> 
      <option value="plhdrseq">plhdrseq</option> 
      <option value="pl_idpl">pl_idpl</option> 
      <option value="plhdrsdk">plhdrsdk</option> 
      <option value="semua">Semua</option> 
  </select>
  <input type="text" name="fieldcari" id="fieldcari" value="%" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
  </form> 
  </td> </tr></table>
</div> 
<div>
 <table> 
<tr><td class="right">Kode</td><td><input type="text" id="idpl" name="idpl" size="10" <? echo readonly;?> value="<? echo $idpl;?>" /></td> 
<td class="right">Nama Template</td> 
<td><input type="text" id="plname" name="plname" size="30" maxlength="25" value="<? echo $plname;?>" readonly /></td> 
</tr> 
</table> 
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
