<? require_once ('login.php'); 
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$dsp = $_POST['dsp'];

if ($startdate =='') {
$startdate = date('d-m-Y');
} else {
$startdate = $_POST['startdate'];
}
if ($enddate =='') {
$enddate = date('d-m-Y');
} else {
$enddate = $_POST['enddate'];
}
if ($dsp =='') {
	$dsp = 15;
} else {	
$dsp = $_POST['dsp'];
}
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/historypayment.js"></script> 
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
  <table  class="header" ><tr> 
  <td> 
   <form id="historypayment" method="POST" action="" name="historypayment">  
  Cari Data : <select id="pilihcari">  
      <option value="idhistorypayment">idhistorypayment</option> 
      <option value="pay_date">pay_date</option> 
      <option value="pay_value">pay_value</option> 
      <option value="pay_name">pay_name</option> 
      <option value="pay_note">pay_note</option> 
      <option value="unitmstpayment_idpayment">unitmstpayment_idpayment</option> 
      <option value="unithistory_idunithistory">unithistory_idunithistory</option> 
      <option value="semua">Semua</option> 
  </select>
  <input type="text" name="fieldcari" id="fieldcari" value="%" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
   <input  class="button" type="button" value="Cetak" id="btncetak">
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
