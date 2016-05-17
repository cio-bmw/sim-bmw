	<?  
require_once ('login.php'); 
		$str="select * from task where idtask = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtask=$data['idtask']; 
		$project_idproject=$data['project_idproject']; 
		$emp_idemp=$data['emp_idemp']; 
		$keterangan=$data['keterangan']; 
		$startdate=$data['startdate']; 
		$enddate=$data['enddate']; 
		$finishdate=$data['finishdate']; 
		$taskstatus=$data['taskstatus']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data task"; 
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/task_detail.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
 <form id="task_detail" method="POST" action="" name="task_detail"> 
  <table  class="header" ><tr><td class="judul">Data Detail task &nbsp; 
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
<tr><td class="right">idtask</td><td><input type="text" id="idtask" name="idtask" size="10" <? echo readonly;?> value="<? echo $idtask;?>" /></td> 
</tr> 
<tr> 
<td class="right">project_idproject</td> 
<td><input type="text" id="project_idproject" name="project_idproject" size="30" maxlength="25" value="<? echo $project_idproject;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">emp_idemp</td> 
<td><input type="text" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">keterangan</td> 
<td><input type="text" id="keterangan" name="keterangan" size="30" maxlength="25" value="<? echo $keterangan;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">startdate</td> 
<td><input type="text" id="startdate" name="startdate" size="30" maxlength="25" value="<? echo $startdate;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">enddate</td> 
<td><input type="text" id="enddate" name="enddate" size="30" maxlength="25" value="<? echo $enddate;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">finishdate</td> 
<td><input type="text" id="finishdate" name="finishdate" size="30" maxlength="25" value="<? echo $finishdate;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">taskstatus</td> 
<td><input type="text" id="taskstatus" name="taskstatus" size="30" maxlength="25" value="<? echo $taskstatus;?>" readonly /></td> 
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
