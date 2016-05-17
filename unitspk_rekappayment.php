<? require_once ('login.php');

$sektor_idsektor = $_POST['sektor_idsektor'];
$idcontractor = $_POST['idcontractor'];
$idunit = $_POST['idunit'];
$dsp = $_POST['dsp'] ? : 25;
$sisa = $_POST['sisa'];
$startdate = $_POST['startdate'] ? : date('d-m-Y');
$enddate = $_POST['enddate'] ? : date('d-m-Y');



$duedate = $_POST['duedate'] ? : date('d-m-Y');
$paydate = $_POST['paydate'] ? : date('d-m-Y');
 ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/unitspk_rekappayment.js"></script> 

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
  <form id="unitar" method="POST" action="" name="unitar"> 
  <table  class="header" ><tr> 
  <td>
  Sektor :
  <select id="sektor_idsektor" name="sektor_idsektor" onchange="this.form.submit()">
 echo "<option value="%" >Semua</option>"; 
  <? createsektoroption($sektor_idsektor);?>
  </select>
  Unit/Kavling
 <select id="idunit" name="idunit" onchange="this.form.submit()" >
 <option value="%" >Semua</option> 
  <? createunitoption($sektor_idsektor,$idunit);?>
  </select>
  Kontraktor :
  <select id="idcontractor" name="idcontractor" onchange="this.form.submit()">
  <? createcontractoroption($idcontractor);?>
  </select>
   
 Show : <select id="dsp" name="dsp" onchange="this.form.submit()">
  <? createdspoption($dsp);?>
  </select>
  
 Sisa : <select id="sisa" name="sisa" onchange="this.form.submit()">
<? 
  echo "<option value=\"all\""; if($sisa == 'all') echo "selected"; echo "> Semua</option>";
  echo "<option value=\"ada\""; if($sisa == 'ada') echo "selected"; echo "> Sisa >0</option>";
?>
	    </select>
 
    
  <input class="button" type="button"  id="btncetak"   value="Cetak Rekap" />
  
  </td> </tr></table>
  </form>
</div>  
<div id="column1-wrap" style="width:550px;">
  <div id="divPageEntry"></div> 
   <div id="divPageData"></div> 
 </div> 
    <div id="divLOV" style="width:450px;" ></div>
<div id="clear"></div><br>

 
</body> 
</html> 