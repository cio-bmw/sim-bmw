<? require_once ('login.php');
$idcompany = $_POST['idcompany'];
 ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/accbudget.js"></script> 
<script type="text/javascript">
function loadlovacc(){
page1="accbudget_lovacc.php?comp="+$("select#idcompany").val()+"&grup="+$("select#idgroupacc").val(); 
		$("#divLOV").load(page1); 
		$("#divLOV").show(); 
		return false; 
   
}  
</script>
</head> 
<body> 
<? include_once "header.php"; ?>  
<div id="divSearch"> 
  <table  class="header" ><tr> 
  <td> 
   <form id="accbudget" method="POST" action="" name="accbudget">  
 Unit :
	 <? if ($level=='staff') { ?>
      	<select id="idcompany" name="idcompany"  disabled >
 				<? createcompanyoption($idcompany); ?>   
	   	</select>     	
   <?  	
	 } else { ?>
      	<select id="idcompany" name="idcompany" onchange="this.form.submit()"  >
      	   <option value="%">Semua</option>
 				<? createcompanyoption($idcompany); ?>   
	   	</select>     	

    <? } ?>
   
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
  </form> 
  </td> </tr></table>
</div> 
 
<div id="column1-wrap"> 
<div id="divPageEntry" style="width:500px;"></div>
<div id="divPageData"></div> 
</div>
<div id="divLOVHDR" hidden>
Group Account :
<select id="idgroupacc" name="idgroupacc"  onchange="loadlovacc()">
<option value="%">Semua</option>
<? creategroupaccoption($idgroupacc); ?>
</select>
</div> 
<div id="divLOV"></div> 
<div id="clear"></div> 
<div id="divLoading"></div> 
 
</body> 
</html> 
