<? require_once ('login.php');
$idsektor = $_POST['idsektor'];
$idspkcat = $_POST['idspkcat'];
$idunit = $_POST['idunit'];
$spkdate = $_POST['spkdate'];
$idcont = $_POST['idcont'];
$dsp = $_POST['dsp'] ? : '25';

 ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/unitspk.js"></script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=spkdate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				jQuery('input[name=paydate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
})			
</script>		
				

</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch" style="width:100%;"> 
  <form id="unitspk" method="POST" action="" name="unitspk"> 
  <table  class="header"><tr> 
  <td>
  Sektor :
  <select id="idsektor" name="idsektor" onchange="this.form.submit()" >
 <option value="%" >Semua</option> 
  <? createsektoroption($idsektor);?>
  </select>
 Unit/Kavling
 <select id="idunit" name="idunit" onchange="this.form.submit()" >
 <option value="%" >Semua</option> 
  <? createunitoption($idsektor,$idunit);?>
  </select>
 Kategory :
 <select id="idspkcat" name="idspkcat" onchange="this.form.submit()" >
  <? createspkcatoption($idspkcat);?>
  </select>    
 Kontraktor :
  <select id="idcont" name="idcont" onchange="this.form.submit()">
  <? createcontractoroption($idcont);?>
  </select>
Tanggal : <input type="text" size="10" id="spkdate" name="spkdate" value="<? echo $spkdate; ?>" >
Show :<select id="dsp" name="dsp" onchange="this.form.submit()">
  <? createdspoption($dsp); ?>
  </select> 

  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
  
  </td> </tr>
  </table>
  </form>
</div> 
 <br>
<div id="column1-wrap"> 
<div id="divPageEntry"></div> 

</div>
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divPageData"></div> 
<div id="divLoading"></div> 
 
</body> 
</html> 
