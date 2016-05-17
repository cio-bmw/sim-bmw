<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
        <title>10 different example of jQuery datepicker</title>
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" language="javascript" src="js/ddsmoothmenu.js"></script>
		<link rel="stylesheet" rev="stylesheet" href="css/style.css" />		
		<link rel="stylesheet" rev="stylesheet" href="css/ddsmoothmenu.css" />		
		<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=calender]').datepicker();		
				jQuery('input[name=calender1]').datepicker({changeYear:true, changeMonth:true, showMonthAfterYear:true});		
				jQuery('input[name=calender2]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025"});
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
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<a href="http://www.sourcecodemart.com/"><img src="/images/scm.png" alt="sourcecodemart a web techincal blog" title="sourcecodemart a web techincal blog" /></a>
				</div> 				
			</div>
			<div class="ddsmoothmenu" id="navbar">
				<ul>
					<li><a href="http://www.sourcecodemart.com/">Home</a></li>
					<li><a href="http://demo.sourcecodemart.com/">All Demos</a></li>
					<li><a href="http://www.sourcecodemart.com/about/">About</a></li>
					<li><a href="http://www.sourcecodemart.com/contact/">Contact</a></li>					
				</ul>
			</div>
			<div style="clear:both"></div>
			<div id="content">
				<div class="posttitle clear">
					<div class="post"><a href="http://www.sourcecodemart.com/10-different-example-of-jquery-datepicker/"><h1>10 different example of jQuery datepicker</h1></a></div>
				</div>
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Header -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-3906234050616676"
     data-ad-slot="9689924331"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
				<div class="leftbar">
					<br />
					<br />
					<a class="button" href="http://www.sourcecodemart.com/10-different-example-of-jquery-datepicker/">
						<< Back to Article
					</a>
					<br />
					<br />					
					<h2>Simple Datepicker:</h2>
					<input type="text" name="calender" value="" />
					<h2>Datepicker with change year and month:</h2>
					<input type="text" name="calender1" value="" />
					<h2>Datepicker with custom year range:</h2>
					<input type="text" name="calender2" value="" />
					<h2>Datepicker with different date formats: (yyyy-mm-dd)</h2> 					
					<input type="text" name="calender3" value="" />
					<h2>Set first day of week:</h2>
					<input type="text" name="calender4" value="" />			
					<h2>Disabled Previous Days:</h2>	
					<input type="text" name="calender5" value="" />
					<h2>Disabled Next Days:</h2>	
					<input type="text" name="calender6" value="" />
					<h2>Disabled any week Days:</h2>
					<input type="text" name="calender7" value="" />
					<h2>Enabled only selected Days:</h2>
					<input type="text" name="calender8" value="" />
					<h2>Disabled only selected Days:</h2>
					<input type="text" name="calender9" value="" />
					<h2>Enabled custom date range:</h2>
					<input type="text" name="calender10" value="" />
				</div>
				<div class="rightbar">
				
			</div>			
			<div id="footer">
				<div style="float:left;width:50%">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- sidebar -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-3906234050616676"
     data-ad-slot="8106956333"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<div style="float:left;width:40%">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- sidebar -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-3906234050616676"
     data-ad-slot="8106956333"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
			</div>
		</div>		
	</body>
</html>