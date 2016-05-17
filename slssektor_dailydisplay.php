 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data slshdrsektor sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var dataString; 
  var vidsektor = $("select#idsektor").val(); 
  var vstartdate = $("input#startdate").val(); 
  var venddate = $("input#enddate").val(); 
   
 dataString = 'starting='+page+'&idsektor='+vidsektor+'&startdate='+vstartdate+'&enddate='+venddate+'&random='+Math.random(); 

   
   
  $.ajax({ 
    url:"slssektor_dailydisplay.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data slshdrsektor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
   var vidsektor = $("select#idsektor").val(); 
  var vstartdate = $("input#startdate").val(); 
  var venddate = $("input#enddate").val(); 
   
 dataString = 'starting='+page+'&idsektor='+vidsektor+'&startdate='+vstartdate+'&enddate='+venddate+'&random='+Math.random(); 

 
  $.ajax({ 
    url: "slssektor_dailydisplay.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
   
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$idsektor = $_GET['idsektor'];
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
 
 

 if ($idsektor == '%') {
$sql = "select * from slshdrsektor where sls_date between '$startdate' and '$enddate' order by sls_date"; 
 	} else {
$sql = "select * from slshdrsektor where sektor_idsektor = '$idsektor' and  sls_date between '$startdate' and '$enddate' order by sls_date"; 
}
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0;  
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table class="grid" id="slshdrsektor"> 
  <tr> 
 <th>No</th>
<th>Tanggal</th>
<th>Kode</th>
<th>Nama Sektor</th>

<th>Status</th>
<th>Keterangan</th>
<th>Total</th>

  </tr> 
		<?php 
		//menampilkan data slshdrsektor 
		if(mysql_num_rows($result)!=0){ $totalall=0;
  		while($row = mysql_fetch_array($result)){
  			$sektor = sektorinfo($row['sektor_idsektor']);
  			$sektorname = $sektor['sektorname'];

$sql1 = "SELECT IFNULL(sum(qty*sales_price),0)  FROM slsdtlsektor where slshdrsektor_idslshdr ='".$row['idslshdr']."'";
$result1 = mysql_query($sql1);
$data  = mysql_fetch_array($result1);
$total = $data[0] 			
  			
  			 ?>		 
       <tr> 
 <td  width="40px"><? echo $row['idslshdr'];?></td>
<td width="50px"><? echo gettanggal($row['sls_date']);?></td>
<td  width="50px"><? echo $row['sektor_idsektor'];?></td>
<td><? echo $sektorname;?></td>

 <td  width="40px"><? echo $row['sls_status'];?></td>
<td><? echo $row['sls_desc'];?></td>
<td class="right"><? echo nf($total);?></td>

      
   </tr> 
  		<?  
$totalall = $totalall + $total;  		
  		} //end while ?> 
  		
  	 <tr><td colspan="6">Total</td><td class="right"><?php echo nf($totalall); ?></td></tr> 
			
		 <tr id="nav"><td colspan="7"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="7"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="7"><? echo $idsektor; ?> Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
