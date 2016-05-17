<? require_once ('login.php');
$idsektor = $_POST['idsektor'];
$startdate = $_POST['startdate'] ? : date('d-m-Y');
$enddate = $_POST['enddate'] ? : date('d-m-Y');
$dsp = $_POST['dsp'] ? : 15;



 ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/slshdrsektor.js"></script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>

		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=startdate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				jQuery('input[name=enddate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				})			
		</script>		

</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="formSearch" method="POST" action=""> 
  <table  class="header" ><tr> 
  <td class="judul">
 Sektor :  
  <select id="idsektor" name="idsektor" onchange="this.form.submit()">
    echo "<option value="%" >Semua</option>"; 
  <? createsektoroption($idsektor); ?>  
  </select>  
     Start : <input type="text" size=8 name="startdate" id="startdate" value="<? echo $startdate; ?>" onchange="this.form.submit()"/> 
  End : <input type="text" size=8 name="enddate" id="enddate" value="<? echo $enddate; ?>" onchange="this.form.submit()" /> 
 Show :<select id="dsp" name="dsp" onchange="this.form.submit()">
  <? createdspoption($dsp); ?>
  </select> 
  
  
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
 <input  class="button" type="button" value="Cetak Daftar Pengiriman" id="btncetak">

  </td> </tr></table>
  </form> 
</div> 
<div id="column1-wrap">
    <div id="divPageData" style="width:500px;"></div> 
 </div> 
    <div id="divLOV"></div>

<div id="clear"></div>
 <div id="divLoading"></div> 
 
</body> 
</html> 
