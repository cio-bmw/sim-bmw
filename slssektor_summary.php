<? require_once ('login.php');
$idsektor = $_POST['idsektor'];
$startdate = $_POST['startdate'] ? : date('d-m-Y');
$enddate = $_POST['enddate'] ? : date('d-m-Y');
$model = $_POST['model'];

 ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/slssektor_summary.js"></script> 
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
  <form id="dailyrekap" method="POST" action="" name="dailyrekap"> 
  <table  class="header" ><tr> 
  <td class="judul">
  Tgl Awal : <input type="text" size=10 name="startdate" id="startdate" value="<? echo $startdate;?>"  onchange="this.form.submit()"  /> 
  Tgl Akhir : <input type="text" size=10 name="enddate" id="enddate" value="<? echo $enddate; ?>"  onchange="this.form.submit()" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Summary Sektor" id="btnsum">
 <input  class="button" type="button" value="Summary Barang" id="btnsumproduct">
  
  </td> </tr></table>
  </form></div> 
 
<div id="divPageData"></div> 
<div id="divLoading"></div> 
 
</body> 
</html> 
