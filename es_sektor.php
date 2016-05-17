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
$vjmlall='';
$vsp3all='';
while($row = mysql_fetch_array($result)){    
$jual  = mysql_fetch_array(mysql_query("SELECT count(*) from unit where jual='sudah' and  sektor_idsektor = '".$row['idsektor']."'"));  
$jml  = mysql_fetch_array(mysql_query("SELECT count(*) from unit where sektor_idsektor = '".$row['idsektor']."'")); 
$sp3  = mysql_fetch_array(mysql_query("SELECT count(*) from unit where sp3='sudah' and sektor_idsektor = '".$row['idsektor']."'")); 

if ($i==0) {
$vjual = $jual[0];
$vjml = $jml[0];
$vsp3 = $sp3[0];
?>
          
                      '<? echo $row['sektorname'];?>'
 
<?           
}  else {
$vjml = ','.$jml[0];
$vjual = ','.$jual[0];
$vsp3 = ','.$sp3[0];

//$isi = ','.'7';
?>	
	                    ,'<? echo $row['sektorname'];?>'
<?
}
?>
<?
$i=$i+1;     

$vjmlall = $vjmlall.''.$vjml;
$vjualall = $vjualall.''.$vjual;
$vsp3all = $vsp3all.''.$vsp3;

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
                total : '<? echo $vjmlall; ?>',
                data: [
            
               
                  <? echo $vjmlall; ?>
                ]


                },
                            
                {
                name: 'Terjual',
                total : '<? echo $vjualall; ?>',
                data: [<? echo $vjualall; ?>]
                },
              
                {
                name: 'SP3',
               total : '<? echo $vsp3all; ?>',
                data: [<? echo $vsp3all; ?>]
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
	
