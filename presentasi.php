<? 
session_start();
require_once ('config.php'); ?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/antrianpoli.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/presentasi.js"></script> 
<script type="text/javascript">
$(document).ready(function(){ 

var myTimer = setInterval(refresh_display, 5000);
var myTimer1 = setInterval(refresh_all, 1200000);
var myTimer2 = setInterval(refresh_text, 60000);

function refresh_text(){ 
page9="antrian_runningtext.php"; 
		$("#footer").load(page9); 
		$("#footer").show(); 
}


function refresh_all(){ 
var vdisplay6 ='#tengahatas';
var vdisplay7 ='#tengahtengah';
var vdisplay8 ='#tengahbawah';

page6="antrian_slideatas.php"; 
		$(vdisplay6).load(page6); 
		$(vdisplay6).show(); 

 page7="antrian_video.php"; 
		$(vdisplay7).load(page7); 
		$(vdisplay7).show(); 
		
page8="antrian_slide.php"; 
		$(vdisplay8).load(page8); 
		$(vdisplay8).show(); 		
 
}

function refresh_display(){ 
//alert('mau rfresh nih');


var vdisplay1 ='#'+$("input#display1").val(); 
var vdisplay2 ='#'+$("input#display2").val(); 
var vdisplay3 ='#'+$("input#display3").val(); 
var vdisplay4 ='#'+$("input#display4").val(); 
var vdisplay5 ='#'+$("input#display5").val(); 
//var vdisplay6 ='#'+$("input#display6").val(); 




		page1="antrian_display1.php?poli="+$("input#poli1").val()+"&display="+$("input#display1").val(); 
		$(vdisplay1).load(page1); 
		$(vdisplay1).show(); 
   
 	page2="antrian_display2.php?poli="+$("input#poli2").val()+"&display="+$("input#display2").val(); 
		$(vdisplay2).load(page2); 
		$(vdisplay2).show(); 
   
   page3="antrian_display3.php?poli="+$("input#poli3").val()+"&display="+$("input#display3").val(); 
		$(vdisplay3).load(page3); 
		$(vdisplay3).show(); 
   
   page4="antrian_display4.php?poli="+$("input#poli4").val()+"&display="+$("input#display4").val(); 
		$(vdisplay4).load(page4); 
		$(vdisplay4).show(); 
   
   page5="antrian_display5.php?poli="+$("input#poli5").val()+"&display="+$("input#display5").val(); 
		$(vdisplay5).load(page5); 
		$(vdisplay5).show(); 
   
 
   
		return false; 
	} 
	
}); 	

</script>

</head> 
<body> 
<div id="divSearch"> 
 <form id="formSearch"> 
   <? 
 
  $result = mysql_query (" select * from poli");
       $i=1;
  		while($row = mysql_fetch_array($result)){
  
  		$poli = $row['poli_id'];
  		$display = $row['display'];
      
    echo ' <input  type="hidden" id="poli'.$i.'"     value="' .$poli.'" >';
    echo ' <input  type="hidden" id="display'.$i.'"     value="' .$display.'" >';
 	
 	$i=$i+1;		
  	}
  
 
   ?>
  
  
  </form> 
</div> 




<table width="100%">
<tr><td colspan=3  bgcolor="#356AA6" align="center">
<div id="header"><H1><font color="#ffffff">Selamat Datang Di Perumahan BMW</font>
       </H1></div>   
 </td></tr> 

<tr><td width="20%">    
     <div id="kiriatas"></div>
    <div id="kiritengah"></div>
     <div id="kiribawah"></div>
    
    </td><td align="center" width="60%" bgcolor="#000000">
     <div id="tengahatas"  style="text-align:center;"></div>
     <div id="tengahtengah" style="text-align:center;"></div>
    <div id="tengahbawah" style="text-align:center;"></div>
    
    </td><td width="20%">
    <div id="kananatas"></div>
    <div id="kanantengah"></div>      
    <div id="kananbawah"></div>           
    </td></tr>       
    
<tr><td colspan=3 bgcolor="#356AA6">
<div id="footer"></div>   
 </td></tr>    
 </table>      
 </div><br>

</body> 
</html> 
