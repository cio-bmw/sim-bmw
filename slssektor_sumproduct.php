<? require_once ('login.php');
$idsektor = $_POST['idsektor'];
$startdate = $_POST['startdate'] ? : date('d-m-Y');
$enddate = $_POST['enddate'] ? : date('d-m-Y');
$model = $_POST['model'];
$dsp = $_POST['dsp'] ? : 15;

 ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>technosoft Indonesia</title> 
<link rel="stylesheet" type="text/css" href="css/style-page.css" /> 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> 
<script type="text/javascript" src="js/slssektor_sumproduct.js"></script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=calender]').datepicker();		
				jQuery('input[name=calender1]').datepicker({changeYear:true, changeMonth:true, showMonthAfterYear:true});		
				jQuery('input[name=startdate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				jQuery('input[name=enddate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				
				
				jQuery('input[name=calender3]').datepicker({dateFormat: "yy-mm-dd"});						
				jQuery('input[name=calender4]').datepicker({firstDay: 1});						
				jQuery('input[name=calender5]').datepicker({minDate: 0});	
				jQuery('input[name=calender6]').datepicker({maxDate: 0});
				jQuery('input[name=calender7]').datepicker({
					 beforeShowDay : function(date){
				     	if(date.getDay() == 0 || date.getDay() == 6)
				        	return [0];
				       	else
				            return [1];
				    }			
				});	
				var enabledDays = ['7-10-2013','7-15-2013','7-20-2013','7-25-2013'];
				function enableAll(date) {
					var m = date.getMonth() + 1, d = date.getDate(), y = date.getFullYear();
					for (var i = 0; i < enabledDays.length; i++) {
						if($.inArray(m + '-' + d + '-' + y,enabledDays) != -1) {
							return [1];
						}
					}
					return [0];
				}
				jQuery('input[name=calender8]').datepicker({
					beforeShowDay: enableAll,
					changeYear: true,
					changeMonth: true
				});
				function disabledAll(date) {
					var m = date.getMonth() + 1, d = date.getDate(), y = date.getFullYear();
					for (var i = 0; i < enabledDays.length; i++) {
						if($.inArray(m + '-' + d + '-' + y,enabledDays) != -1) {
							return [0];
						}
					}
					return [1];
				}
				jQuery('input[name=calender9]').datepicker({
					beforeShowDay : disabledAll
				});
				var today = new Date();
				jQuery('input[name=calender10]').datepicker({
					minDate: new Date(2013, 7, 10),
					maxDate: new Date(today.getFullYear(), today.getMonth()+1, today.getDate())
				});
			})			
		</script>		
		<style>
			#page{
				margin:20px;
			}
			label{display:block;width:25%;font-weight:bold;padding:5px;}			
			h2{
				font-size:22px;
				font-weight:bold;
				margin-top:10px;
				margin-bottom:10px;
			}
			input[type=text]{
				padding:3px;
				border:1px solid #333;
			}
		</style>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-38362750-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>		
		

</head> 
<body> 
<? include_once "header.php"; ?>
<div id="divSearch"> 
  <form id="dailyrekap" method="POST" action="" name="dailyrekap"> 
  <table  class="header" ><tr> 
  <td class="judul">Sektor :   
  <select id="idsektor" name="idsektor">
    echo "<option value="%" >Semua</option>"; 
  <? createsektoroption($idsektor); ?>  

  </select>
  Tgl Awal : <input type="text" size=10 name="startdate" id="startdate" value="<? echo $startdate; ?>" /> 
  Tgl Akhir : <input type="text" size=10 name="enddate" id="enddate" value="<? echo $enddate; ?>" /> 
   Show :<select id="dsp" name="dsp" onchange="this.form.submit()">
  <? createdspoption($dsp); ?>
  </select> 

  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Sum Sektor" id="btnsum">
 <input  class="button" type="button" value="Sum Barang" id="btnsumproduct">
   <input  class="button" type="button" value="Menu" id="btnexit">
  </td> </tr></table>
  </form></div> 
 
<div id="divPageData"></div> 
<div id="divLoading"></div> 
 
</body> 
</html> 
