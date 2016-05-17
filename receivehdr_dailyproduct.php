<script type="text/javascript">  

$("#btncetak").click(function(){ 
     var vstart = $("input#startdate").val();
     var vend = $("input#enddate").val();
     var vsupp = $("select#idsupp").val();
     
     
     window.open('receivehdr_rekapproductpdf.php?idsupp='+vsupp+'&startdate='+vstart+'&enddate='+vend,'_blank');

	});
		 
</script>

<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
$idsupplier = $_GET['idsupp'];

$sql="SELECT product_idproduct,sum(qty) qty,sum(receive_price * qty) jumlah FROM receivedtl a, receivehdr b  
where a.receivehdr_idreceivehdr = b.idreceivehdr and 
supplier_idsupp like '%$idsupplier%' and 
b.rcv_date between '$startdate' and '$enddate'  group by product_idproduct 
order by qty desc";

$result = mysql_query($sql); 
?> 
<p class="judul">Rekap Nilai Penerimaan Barang Per Barang
<input type="button" class="button" id="btncetak" value="Cetak Rekap"></p>
<table id="receivehdr"> 

<tr> 
<th>Kode</th>
<th>Nama Barang</th>
<th>Jumlah</th>
<th>Nilai Beli (Rp)</th>
<th>Nilai Jual (Rp)</th>
<th>Margin (Rp)</th>
<th>Margin (%)</th>


  </tr> 
		<?php 
		//menampilkan data receivehdr 
		if(mysql_num_rows($result)!=0){ $alltotal =0; $alltotal1 =0; $alltotal2 =0;
  		while($row = mysql_fetch_array($result)){
  			$product = productinfo($row['product_idproduct']);
  			$productname = $product['productname'];
  			$jual = $product['salesprice'];
  			$vjual = $jual * $row['qty'];
  			$vmargin = $vjual - $row['jumlah'];
 ?>		 
 <tr> 
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $productname;?></td> 
<td class="right"><? echo $row['qty'];?></td>
<td class="right"><? echo nf($row['jumlah']);?></td>
<td class="right"><? echo nf($vjual);?></td>
<td class="right"><? echo nf($vmargin);?></td>
<td class="right"><? echo nf($vmargin/$row['jumlah']*100);?></td>


 </tr> 
  		<?  
 		$alltotal = $alltotal + $row['jumlah'];
 		$alltotal1 = $alltotal1 + $vjual;
 		$alltotal2 = $alltotal2 + $vmargin;
 		
  		} //end while ?> 
  		 <tr id="nav"><td colspan=3>Total</td>
  		 <td class="right"><? echo nf($alltotal);?></td>
  		 <td class="right"><? echo nf($alltotal1);?></td>
  		 <td class="right"><? echo nf($alltotal2);?></td>
  		 
  		 </tr> 
    <?}else{?> 
   <tr><td align="center" colspan="10">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
