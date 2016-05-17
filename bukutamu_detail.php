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
  <table  class="header" ><tr><td class="judul">Data Detail bukutamu &nbsp; 
 <input  class="button" type="button" value="Tampilkan" id="btntampil">
 <input  class="button" type="button" value="Tambah Detail" id="btntambah">
 <input  class="button" type="button" value="Cetak" id="btncetak">
 <input  class="button" type="button" value="Kembali ke Daftar" id="btndisplay">
  
  </td> </tr></table>
  </form><br /> 
</div> 
	<?  
		$str="select * from bukutamu where idbukutamu = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idbukutamu=$data['idbukutamu']; 
		$nama=$data['nama']; 
		$alamat=$data['alamat']; 
		$notlp=$data['notlp']; 
		$tanggal=$data['tanggal']; 
		$catatan=$data['catatan']; 
		$diterima=$data['diterima']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data bukutamu"; 
?> 
 <table> 
<tr><td class="right">idbukutamu</td><td><input type="text" id="idbukutamu" name="idbukutamu" size="10" <? echo readonly;?> value="<? echo $idbukutamu;?>" /></td> 
</tr> 
<tr> 
<td class="right">nama</td> 
<td><input type="text" id="nama" name="nama" size="30" maxlength="25" value="<? echo $nama;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">alamat</td> 
<td><input type="text" id="alamat" name="alamat" size="30" maxlength="25" value="<? echo $alamat;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">notlp</td> 
<td><input type="text" id="notlp" name="notlp" size="30" maxlength="25" value="<? echo $notlp;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">tanggal</td> 
<td><input type="text" id="tanggal" name="tanggal" size="30" maxlength="25" value="<? echo $tanggal;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">catatan</td> 
<td><input type="text" id="catatan" name="catatan" size="30" maxlength="25" value="<? echo $catatan;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">diterima</td> 
<td><input type="text" id="diterima" name="diterima" size="30" maxlength="25" value="<? echo $diterima;?>" readonly /></td> 
</tr> 
<tr> 
<td class="right">emp_idemp</td> 
<td><input type="text" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" readonly /></td> 
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
