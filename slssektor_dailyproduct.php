 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data slsdtlsektor sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var vstartdate = $("input#startdate").val(); 
  var venddate = $("input#enddate").val(); 
  var vsektor = $("select#idsektor").val(); 
  var vdsp = $("select#dsp").val(); 
  
    
    
    dataString = 'starting='+page+'&dsp='+vdsp+'&sektor='+vsektor+'&startdate='+vstartdate+'&enddate='+venddate+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"slssektor_dailyproduct.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data slsdtlsektor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vstartdate = $("input#startdate").val(); 
  var venddate = $("input#enddate").val(); 
   var vsektor = $("select#idsektor").val(); 
   
	
      dataString = 'sektor='+vsektor+'&startdate='+vstartdate+'&enddate='+venddate;
 
 
  $.ajax({ 
    url: "slssektor_dailyproduct.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#slsdtlsektor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#slsdtlsektor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   

$("#btncetak").click(function(){ 
     var vstart = $("input#startdate").val();
     var vend = $("input#enddate").val();
     var vidsektor = $("select#idsektor").val();
     
     
     window.open('slssektor_dailyproductpdf.php?startdate='+vstart+'&enddate='+vend+'&idsektor='+vidsektor,'_blank');

	});
});	
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
$idsektor = $_GET['sektor'];
$dsp = $_GET['dsp'];

if ($idsektor == '%') {
$sql="SELECT product_idproduct,sum(qty) qty,sum(sales_price * qty) jumlah FROM slsdtlsektor a, slshdrsektor b  
where a.slshdrsektor_idslshdr = b.idslshdr and  
b.sls_date between '$startdate' and '$enddate'  group by product_idproduct ";
	} else {

$sql="SELECT product_idproduct,sum(qty) qty,sum(sales_price * qty) jumlah FROM slsdtlsektor a, slshdrsektor b  
where a.slshdrsektor_idslshdr = b.idslshdr and b.sektor_idsektor='$idsektor' and 
b.sls_date between '$startdate' and '$enddate'  group by product_idproduct ";
}
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = $dsp;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
<p class="judul">Rekap Pengeluaran Barang <? echo $startdate;?> s/d <? echo $enddate; ?> &nbsp;&nbsp;
<input type="button" class="button" id="btncetak" value="Cetak Rekap">
</p>
  <table class="grid" id="slsdtlsektor"> 
  <tr> 
 <th>No</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>Jumlah</th>
<th>Harga Jual</th>
<th>Harga Beli</th>
<th>Margin</th>
<th>(%)</th>

  </tr> 
		<?php 
		//menampilkan data slsdtlsektor 
		if(mysql_num_rows($result)!=0){ $alltotal=0; $no=1;
  		while($row = mysql_fetch_array($result)){ 
$product=productinfo($row['product_idproduct']) ;
$productname=$product['productname'] ;
$cost_price = $product['costprice'];
$beli = $row['qty'] * $cost_price;		
$pct= ($row['jumlah'] - $beli)/$beli*100; 	
  	
  		?>		 
       <tr> 
 <td><? echo $no;?></td>
 <td><? echo $row['product_idproduct'];?></td>
 <td><? echo $productname;?></td>
<td class="right"><? echo $row['qty'];?></td>
<td class="right"><? echo nf($row['jumlah']);?></td>
<td class="right"><? echo nf($beli);?></td>
<td class="right"><? echo nf($row['jumlah']-$beli);?></td>
<td class="right"><? echo nf($pct);?></td>

    </tr>
        
  		<?

$alltotal = $alltotal + $row['jumlah']; 
$alltotal1 = $alltotal1 + $beli; 
$alltotal2 = $alltotal2 + $row['jumlah']-$beli;

$no++;		
  		} //end while 
  				
  		?>
  		
  		<tr><td colspan="4">Total Nilai Pengeluaran Barang</td><td class="right"><? echo nf($alltotal);?> </td>
  		<td class="right"><? echo nf($alltotal1);?> </td><td class="right"><? echo nf($alltotal2);?> </td>
 
  		</tr>
		 <tr id="nav"><td colspan="8"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="8"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
row['jumlah']