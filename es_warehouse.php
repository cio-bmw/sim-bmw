<html>
	<head>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
           renderTo: 'container',
           width: 800,
            type: 'column'
         },   
         title: {
            text: 'Grafik Onhand Stock Value '
         },
         xAxis: {
            categories: ['Jenis Transaksi']
         },
         yAxis: {
            title: {
               text: 'Stock Value'
            }
         },
              series:             
            [
            <?php 
        	include('config.php');
$bulanini = date('m-Y');

$data  = mysql_fetch_array(mysql_query("SELECT sum(costprice * stock) vbeli  FROM product"));  
$vbeli = $data[0];
$data1  = mysql_fetch_array(mysql_query("SELECT sum(salesprice * stock) vjual  FROM product"));  
$vjual = $data1[0];
$data2  = mysql_fetch_array(mysql_query("SELECT sum(costprice * limitstock) vlimit FROM product"));  
$vlimit = $data2[0];	        	
?>        	
        	
        	
                             
                  
                  {
                      name: '<?php echo 'Nilai Jual Stock'; ?>',
                      data: [<?php echo $vjual; ?>],
                      pointWidth: 100
                  },
                  
                  {
                      name: '<?php echo 'Nilai Pemelian Stok'; ?>',
                      data: [<?php echo $vbeli; ?>]
                  },
                  {
                      name: '<?php echo 'Nilai Batas Minimum Stock'; ?>',
                      data: [<?php echo $vlimit; ?>]
                  },
                  
                 
            ]
      });  //batas chart1
      
      
    
      
      
      
      
      
   });	//batas akhir
</script>
	</head>
	<body>
		<div id='container'></div>	<br>
      <div id='container1'></div>	<br>
      <div id='container2'></div>	<br>
	</body>
</html>
	
