<? require_once ('login.php');
require_once ('config.php'); 
include "libchart/classes/libchart.php";

?>  
<div id="divSearch"> 
  <form id="formSearch"> 
  <table class="grid"><tr> 
  <td class=judul2>Executive Summary Piutang Sektor &nbsp;&nbsp; 
 
   </td> </tr></table>
  </form><br /> 
</div> 
<div id="divPageData">
<?
$bulanini = date('m-Y');

//create chart
$chart = new VerticalBarChart(980,400);
//$chart = new PieChart();
$dataSet = new XYDataSet();

$sql = "select * from sektor"; 
$result = mysql_query($sql); 
while($row = mysql_fetch_array($result)){
	
$sqlc="SELECT sum(sales_price * qty) vsales FROM slsdtlsektor a, slshdrsektor b 
where b.idslshdr = a.slshdrsektor_idslshdr and sls_status='confirm' 
and sektor_idsektor = '$row[idsektor]'";	
$datac  = mysql_fetch_array(mysql_query($sqlc));  
$vsales = $datac[0];	

$dataSet->addPoint(new Point($row['sektorname'],$vsales));
}
$chart->setDataSet($dataSet);
$chart->setTitle("Outstanding Account Receiveable Sektor");
$chart->render("chart/ar_sektor.png"); 
//end create chart


?>
<table><tr><td>
<img src="chart/ar_sektor.png">
</td></tr>
</table>
<br>
<table>
<tr><th colspan=2>Pengeluaran Barang Ke Sektor Bulan <? echo $bulanini; ?></th></tr>
<?
$sql = "select * from sektor"; 
$result = mysql_query($sql); 
while($row = mysql_fetch_array($result)){
$sqlc="SELECT sum(sales_price * qty) vsales FROM slsdtlsektor a, slshdrsektor b 
where b.idslshdr = a.slshdrsektor_idslshdr and sls_status='confirm' 
and sektor_idsektor = '$row[idsektor]'";	
$datac  = mysql_fetch_array(mysql_query($sqlc));  
$vsales = $datac[0];	
?>
<tr><td  width="250px"><? echo $row['sektorname'];?></td><td class="right"><? echo nf($vsales); ?></td></tr>
<? } ?>
</table> 

</div><br /> 
<div id="divLoading"></div>  

