<?  
  include_once("config.php"); 
    $unit_idunit = $_GET['idunit'];
?> 
<script type="text/javascript"> 
 $("#btnlovtipe").click(function(){ 
		pagelov="tipe_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 
	
	$("#btnimportbudget").click(function(){ 
	    window.open("unit_budget_importprocess.php?idtipe="+$("input#idtipe").val()+"&idunit="+$("input#unit_idunit").val(),"_blank"); 
 	page="unit_materialbudget_display.php?idunit="+$("input#idunit").val(); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		
   
		//return false;
	}); 
 </script> 
 
<? 
    $sql = "SELECT count(*) jumlah from unit_materialbudget where unit_idunit = '$unit_idunit'";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $checkdata = $data[0];
  
if ($checkdata > 0 ) {
echo "<script> alert('Data RAB sudah ada tidak bisa Import RAB'); </script>";		
	
} else {  	  
 ?>
<form method="post" name="unit_materialbudget_form" action="" id="unit_materialbudget_form">  
<table> 
<tr><th colspan="2"><b>Import RAB Unit Dari Master Type</b></th></tr> 
<tr> 
<td class="right">Import Dari Type</td> 
<td>
<input type="hidden" id="unit_idunit" name="unit_idunit" size="8" maxlength="25" value="<? echo $unit_idunit;?>" />
<input type="text" id="idtipe" name="idtipe" size="8" maxlength="25" value="<? echo $idtipe;?>" />
<input type="button" class="button" id="btnlovtipe" value="...">
<input type="text" id="tipename" name="tipename" size="20" maxlength="45" value="<? echo $tipename;?>" />
<input class="button" type="button" id="btnimportbudget" value="Import RAB">
</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
<?}?>
