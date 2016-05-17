 <html>
	<head>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	var chart1; // globally available
 $(document).ready(function() {
 var container_chartCorrectiveAction = new Highcharts.Chart({
        chart: {
                renderTo: 'container_chartCorrectiveAction',

                        width: 450,
                        height: 300,
            type: 'column'

                    },
                    title: {
                        text: 'On Hand Stock Value'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: [''],
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
                            text: 'Rupiah',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return ''+ this.series.name +': '+ this.y +' Rupiah';
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        },
                        series: {
                            pointWidth:100,
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
                      total: '<? echo nf($vjual); ?>',
                      data: [<?php echo $vjual; ?>]
                  },
                  
                  {
                      name: '<?php echo 'Nilai Pembelian Stok'; ?>',
                      total: '<? echo nf($vbeli); ?>',
                      data: [<?php echo $vbeli; ?>]
                  },
                  {
                      name: '<?php echo 'Nilai Batas Minimum Stock'; ?>',
                      total: '<? echo nf($vlimit); ?>',
                      data: [<?php echo $vlimit; ?>]
                  },
                  
                 
            ]
                });


        var container_chartAtaFleetAvg = new Highcharts.Chart({
        chart: {
                renderTo: 'container_chartAtaFleetAvg',

                        type: 'column',
                        height: 300,
                         width: 450

                    },
                    title: {
                        text: 'Nilai Penjualan vs Penerimaan Barang'
                    },
                    subtitle: {
                        text: 'Bulan <? echo $bulanini;?>'
                    },
                    xAxis: {
                        categories: [''],
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
                            text: 'Rupiah',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return ''+ this.series.name +': '+ this.y +' Rupiah';
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        },
                        series: {
                            pointWidth:100,
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
                    
<?
$sql1="SELECT sum(sales_price * qty) vsales FROM slsdtlsektor a, slshdrsektor b 
where b.idslshdr = a.slshdrsektor_idslshdr 
and date_format(sls_date,'%m-%Y') = '$bulanini'";
$data1  = mysql_fetch_array(mysql_query($sql1));  
$msales = $data1[0];	


$sql2="SELECT sum(receive_price * qty) vreceive FROM receivedtl a, receivehdr b 
where b.idreceivehdr = a.receivehdr_idreceivehdr 
and date_format(rcv_date,'%m-%Y') = '$bulanini'";
$data2  = mysql_fetch_array(mysql_query($sql2));  
$mrcv = $data2[0];	
?>                    
                    
                    series: [
                    
                    
                    {
                name: 'Total Penjualan',
               total: '<? echo nf($msales); ?>',
                data: [<? echo $msales; ?>]
                },
                
                {
                name: 'Total Pembelian',
                total: '<? echo nf($mrcv); ?>',
                data: [<? echo $mrcv; ?>]
                }                
                ]
                });
                
                
                //////////
                var container3 = new Highcharts.Chart({
        chart: {
                renderTo: 'container3',

                        type: 'column',
                        height: 400,
                        width : 1000
                          
                    },
                    title: {
                        text: 'Penjualan Barang Ke Sektor'
                    },
                    subtitle: {
                        text: 'Bulan <? echo $bulanini;?>'
                    },
                    xAxis: {
                        categories: [],
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
                            text: 'Rupiah',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return ''+ this.series.name +': '+ this.y +' Rupiah';
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
                     
<?                    
$sql = "select * from sektor"; 
$result = mysql_query($sql); 
while($row = mysql_fetch_array($result)){
	
$sqlc="SELECT sum(sales_price * qty) vsales FROM slsdtlsektor a, slshdrsektor b 
where b.idslshdr = a.slshdrsektor_idslshdr and sls_status='confirm' 
and date_format(sls_date,'%m-%Y') = '$bulanini' 
and sektor_idsektor = '$row[idsektor]'";	
$datac  = mysql_fetch_array(mysql_query($sqlc));  
$vsales = $datac[0];		
	



$datac  = mysql_fetch_array(mysql_query($sqlc));  
$vsales = $datac[0];	
?>                    
                    
                    
               
                    
                {
                name: '<? echo $row['sektorname'];?>',
                total: '<? echo nf($vsales); ?>',
                data: [<? echo $vsales; ?>]
                },
  <? } ?>                
                            
                {
                name: '',
                data: [0]
                }
              
                
                ]
                
                  
                
                });
              
                
                
     });
                     </script>
	</head>
	<body>
<p><img src="images/logo.png" alt="" ></p>	
		
		<div id="column1-wrap">
  <div id="container_chartCorrectiveAction"></div> 
  
  </div> 
    <div id="container_chartAtaFleetAvg">LOV</div>
<div id="clear"></div>
 <div id="container3"></div> 
		
		
     	</body>
</html>
	
