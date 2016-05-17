 <html>
	<head>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	var chart1; // globally available
 $(document).ready(function() {
      var container3 = new Highcharts.Chart({
        chart: {
                renderTo: 'container3',

                        type: 'column',
                        height: 400,
                        width : 1000
                          
                    },
                    title: {
                        text: 'Statistik Sektor'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                    	
                    	
                        categories: [
<?                 	
include('config.php');         
$sql = "select * from sektor"; 
$result = mysql_query($sql); 
$i=0;
$vjualall ='';
while($row = mysql_fetch_array($result)){    
$jual  = mysql_fetch_array(mysql_query("SELECT count(*) from unit where sektor_idsektor = '".$row['idsektor']."'"));  

if ($i==0) {
$vjual = $jual[0];

?>
          
                      '<? echo $row['sektorname'];?>'
 
<?           
}  else {
$vjual = ','.$jual[0];

//$isi = ','.'7';
?>	
	                    ,'<? echo $row['sektorname'];?>'
<?
}
?>
<?
$i=$i+1;     

$vjualall = $vjualall.''.$vjual;
}

?>

                     
                        ],
                        title: {
                            text: ''
                        },
                        labels: {
                            style: {
                                width: '12000px'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Unit',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return ''+ this.series.name +': '+ this.y +' Unit';
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        },
                        series: {
                            pointWidth:20,
                            groupPadding: .05,
                            shadow: true
                        }
                    },
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom',
                        floating: false,
                        borderWidth: 1,
                        backgroundColor: '#FFFFFF',
                        shadow: true,
                        labelFormatter: function() {
                            return '<div class="' + this.name + '-arrow"></div><span style="font-family: \'Advent Pro\', sans-serif; font-size:12px">' + this.name +'</span><br/><span style="font-size:10px; color:#ababaa">   Total: ' + this.options.total + '</span>';
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    exporting: { 
                        enabled: true 
                    },


                 
               series: [
                {
                name: 'Jumlah Unit',
                data: [
            
               
                  <? echo $vjualall; ?>
                ]


                },
                            
                {
                name: 'Terjual',
                data: [11,12,13,14,15,16,17]
                },
              
                {
                name: 'SP3',
                data: [1,12,3,14,5,1,7]
                }
                
                ]
                
 
                 
                
                });
                
                
     });
                   

                     </script>
	</head>
	<body>
 <div id="container3"></div> 
	
     	</body>
</html>
	
