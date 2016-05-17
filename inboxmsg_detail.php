<? require_once ('login.php'); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/.js"></script> 
</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch"> 
  <table  class="header" ><tr><td class="judul">Data Detail inboxmsg &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from inboxmsg where idinboxmsg = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idinboxmsg=$data['idinboxmsg']; 
		$status=$data['status']; 
		$msg=$data['msg']; 
		$inboxdate=$data['inboxdate']; 
		$emp_idempfrom=$data['emp_idempfrom']; 
		$emp_idempto=$data['emp_idempto']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data inboxmsg"; 
?> 
 <table> 
<tr><td class="right">idinboxmsg</td><td><input type="text" id="idinboxmsg" name="idinboxmsg" size="10" <? echo readonly;?> value="<? echo $idinboxmsg;?>" /></td> 
</tr> 
<tr> 
<td class="right">status</td> 
<td><input type="text" id="status" name="status" size="30" maxlength="25" value="<? echo $status;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">msg</td> 
<td><input type="text" id="msg" name="msg" size="30" maxlength="25" value="<? echo $msg;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">inboxdate</td> 
<td><input type="text" id="inboxdate" name="inboxdate" size="30" maxlength="25" value="<? echo $inboxdate;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">emp_idempfrom</td> 
<td><input type="text" id="emp_idempfrom" name="emp_idempfrom" size="30" maxlength="25" value="<? echo $emp_idempfrom;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">emp_idempto</td> 
<td><input type="text" id="emp_idempto" name="emp_idempto" size="30" maxlength="25" value="<? echo $emp_idempto;?>" readonly /></td> 
</tr> 
</table> 
</div>  
<br />  
<div id="divPageEntry"></div> <br /> 
<div id="divPageData"></div> <br /> 
<div id="divLoading"></div>  
</td> 
<td> 
 <div id="divlov"></div> <br /> 
</td> 
</tr> 
</table> 
</body> 
</html>  
