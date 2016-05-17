<?  
  include_once("config.php"); 
    $tipe_idtipe = $_GET['idtipe'];
?> 
<script type="text/javascript"> 
 $("#btnlovtipe").click(function(){ 
		pagelov="tipeimport_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 
	
	$("#btnimportbudget").click(function(){ 
	    window.open("tipe_materialbudget_impprocess.php?idtipeto="+$("input#idtipe").val()+"&idtipefrom="+$("input#idtipefrom").val(),"_blank"); 
 	page="tipe_materialbudget_display.php?idtipe="+$("input#idtiped").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		
   
		//return false;
	}); 
 </script> 
 
<? 
    $sql = "SELECT count(*) jumlah from tipe_materialbudget where tipe_idtipe = '$tipe_idtipe'";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $checkdata = $data[0];
  
if ($checkdata > 0 ) {
echo "<script> alert('Data RAB sudah ada tidak bisa Import RAB'); </script>";		
	
} else {  	  
 ?>
<form method="post" name="tipe_materialbudget_impform" action="" id="tipe_materialbudget_impform">  
<table width=500px> 
<tr><th colspan="2"><b>Import RAB Unit Dari Master Type</b></th></tr> 
<tr> 
<td class="right">Type </td> 
<td>
<input type="hidden" id="unit_idunit" name="unit_idunit" size="8" maxlength="25" value="<? echo $unit_idunit;?>" />
<input type="text" id="idtipefrom" name="idtipefrom" size="8" maxlength="25" value="<? echo $idtipefrom;?>" />
<input type="button" class="button" id="btnlovtipe" value="...">
<input type="text" id="tipenamefrom" name="tipenamefrom" size="20" maxlength="45" value="<? echo $tipename;?>" />
<input class="button" type="button" id="btnimportbudget" value="Import RAB Type">
</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
<?}?>
