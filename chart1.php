<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Demo page</title>	
		<link type="text/css" rel="stylesheet" href="css/visualize.jQuery.css"/>
		<link type="text/css" rel="stylesheet" href="css/demopage.css"/>
		<script type="text/javascript" src="js/visualize.jquery.min.js"></script>
		<!--[if IE]><script type="text/javascript" src="excanvas.compiled.js"></script><![endif]-->
		<script type="text/javascript" src="js/visualize.jQuery.js"></script>
		<script type="text/javascript">
			$(function(){
				//make some charts
				$('table').visualize({type: 'pie', pieMargin: 10, title: '2009 Total Sales by Individual'});	
		//		$('table').visualize({type: 'line'});
		//		$('table').visualize({type: 'area'});
				$('table').visualize();
			});
		</script>
	</head>
	<body>	

<table >
	<caption>2009 Employee Sales by Department</caption>
	<thead>
		<tr>
		<th>Permata</th>
		<th>Asri</th>
		<th>Asri</th>
		<th>Asri</th>
		<th>Asri</th>
			
		</tr>
	</thead>
	<tbody>
		<tr>
		 <th>sp3</th>
		 <td>90</td>
		 <td>120</td>
		 <td>50</td>
        <td>178</td>
		<td>190</td>
		</tr>
		<tr>
		 <th>Realisasi</th>
		 <td>45</td>
		 <td>12</td>
		 <td>30</td>
        <td>78</td>
		<td>90</td>
		</tr>
	
	</tbody>
</table>
	</body>
</html>