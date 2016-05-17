	<?  
require_once ('login.php'); 
		$str="select * from taskreplay where idtaskreplay = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtaskreplay=$data['idtaskreplay']; 
		$taskreplay=$data['taskreplay']; 
		$filename=$data['filename']; 
		$taskreplaydate=$data['taskreplaydate']; 
		$task_idtask=$data['task_idtask']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data taskreplay"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/taskreplay_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="taskreplay_detail" method="POST" action="" name="taskreplay_detail"> 
  <table  class="header" ><tr><td class="judul">Data Detail taskreplay &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <? if($sls_status=='confirm') { ?>
 <input type="button" class="button" id="btnreopen" name="btnreopen" value="Batalkan Konfirmasi"> 
<? }  else { ?> 
 <input class="button" type="button"  name="btnconfirm" value="Konfirmasi" id="btnconfirm" />

  <? } ?>
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btnlist">
   <input  class="button" type="button" value="Kembali Ke Menu" id="btnexit">
  </td> </tr></table>
  </form> 
</div> 
 <table> 
<tr><td class="right">idtaskreplay</td><td><input type="text" id="idtaskreplay" name="idtaskreplay" size="10" <? echo readonly;?> value="<? echo $idtaskreplay;?>" /></td> 
</tr> 
<tr> 
<td class="right">taskreplay</td> 
<td><input type="text" id="taskreplay" name="taskreplay" size="30" maxlength="25" value="<? echo $taskreplay;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">filename</td> 
<td><input type="text" id="filename" name="filename" size="30" maxlength="25" value="<? echo $filename;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">taskreplaydate</td> 
<td><input type="text" id="taskreplaydate" name="taskreplaydate" size="30" maxlength="25" value="<? echo $taskreplaydate;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">task_idtask</td> 
<td><input type="text" id="task_idtask" name="task_idtask" size="30" maxlength="25" value="<? echo $task_idtask;?>" readonly /></td> 
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
