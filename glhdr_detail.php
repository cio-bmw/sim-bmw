	<?  
require_once ('login.php'); 
		$str="select * from glhdr where idglhdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idglhdr=$data['idglhdr']; 
		$gl_date=$data['gl_date']; 
		$gl_desc=$data['gl_desc']; 
		$gl_refno=$data['gl_refno']; 
		$gl_status=$data['gl_status']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data glhdr"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/glhdr_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
  <form id="glhdr_detail" method="POST" action="" name="glhdr_detail"> 
  <table  class="header" ><tr><td class="judul">Data Detail glhdr &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
  <input  class="button" type="button" value="Posting" id="btnconfirm">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
  </td> </tr></table>
  </form> 
</div> 
 <table> 
<tr><td class="right">No Dok</td><td><input type="text" id="idglhdr" name="idglhdr" size="10" <? echo readonly;?> value="<? echo $idglhdr;?>" /></td> 
<td class="right">Tanggal</td> 
<td><input type="text" id="gl_date" name="gl_date" size="10" maxlength="25" value="<? echo $gl_date;?>" readonly />
Status : 
<input type="text" id="gl_status" name="gl_status" size="10" maxlength="25" value="<? echo $gl_status;?>" readonly />
</td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="gl_desc" name="gl_desc" size="30" maxlength="25" value="<? echo $gl_desc;?>" readonly /></td> 
<td class="right">No Ref</td> 
<td><input type="text" id="gl_refno" name="gl_refno" size="30" maxlength="25" value="<? echo $gl_refno;?>" readonly /></td> 
</tr> 
</table> 
</div>  
<div id="column1-wrap">
<div id="divPageEntry" style="width:500px;"></div>
<div id="divPageData"></div> 
</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
</body> 
</html>  
