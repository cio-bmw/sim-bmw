 <script type="text/javascript">  

function pagination1(page){ 
 var vunit = $("input#unit_idunit").val(); 
     dataString = 'starting='+page+'&id='+vunit+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"slshdrunit_dailyproduct.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data slsdtlunit, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 

   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#slsdtlunit tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#slsdtlunit tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageEntry").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageEntry").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data slsdtlunit ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						//loadData(); 
						 var cari = getURLParameter('id');
  	  
		page="slsdtlunit_form.php"; 
		$("#divPageEntry").load(page); 
		$("#divPageEntry").show(); 
		
		page1="slsdtlunit_display.php?id="+cari; 
		$("#divPageData").load(page1); 
		$("#divPageData").show(); 

		page2="sektorstok_lov.php?id="+$("input#idslshdr").val(); 
		$("#divlov").load(page2); 
		$("#divlov").show(); 

						
						
						
            alert("Data slsdtlunit berhasil di hapus!"); 
					} 
					else{ 
						alert("data slsdtlunit gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 
 $("#btncetak").click(function(){ 
     var cari = $("input#unit_idunit").val();
     window.location='slsdtlunit_pdfrekap.php?id='+cari;

	});	 
	 
	 
}); 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']); 
 
$idunit = $_GET['id']; 
$sql = "select sum(qty) qty,product_idproduct,unit_idunit from slsdtlunit a, slshdrunit b, product c 
where a.product_idproduct = c.idproduct and a.slshdrunit_idslshdr = b.idslshdr 
and b.sls_date between '$startdate' and '$enddate' group by product_idproduct order by productname"; 

$unit = unitinfo($idunit);
$kavling = $unit['kavling'];
$idsektor = $unit['sektor_idsektor'];

$sektor = sektorinfo($idsektor);
$sektorname= $sektor['sektorname'];

 
 //$sql = "select * from slsdtlunit"; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
<p class="judul">Rekap Pengeluaran Barang VS Penerimaan Barang Di Gudang</p>
   
<table class="grid">
<tr><td colspan="5">Sektor : Sektor <? echo $sektorname;?> &nbsp;&nbsp;&nbsp; Kavling :  <? echo $kavling; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input  class="button" type="button" value="Cetak Progress" id="btncetak"> </td></tr>
<input type="hidden" id="unit_idunit" name="unit_idunit" value="<? echo $idunit ?>">

</table>

  <table  id="slsdtlunit"> 
  <tr> 
  <th>No</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>Pengeluaran</th>
<th>Penerimaan</th>
<th>Selisih</th>
  </tr> 
		<?php 
		//menampilkan data slsdtlunit 
		if(mysql_num_rows($result)!=0){  $no=$starting+1;
  		while($row = mysql_fetch_array($result)){
      $idproduct = 	$row['product_idproduct'];
  		$product = productinfo($row['product_idproduct']);
  		$productname = $product['productname'];	
      $unit_idunit = $row['unit_idunit'];


   $sqlb = "SELECT sum(qty) qtysls FROM slsdtlsektor where product_idproduct ='$idproduct' ";  
   $resultb = mysql_query($sqlb);  
   $datab  = mysql_fetch_array($resultb);  
   $slsqty = $datab[0];	   		
   
    $selisih = $slsqty - $row['qty'];
  	


			 ?>		 
       <tr> 
 <td><? echo $no;?></td>
 <td><? echo $row['product_idproduct'];?></td>
 <td><? echo $productname;?></td>
<td class="right"><? echo nf($row['qty']);?></td>
<td class="right"><? echo nf($slsqty);?></td>
<td class="right"><? echo nf($selisih);?></td>

       </tr> 
  		<? $no++; 
         $totalp = $totalp + $row['harga'];   		
         $totalb = $totalb + $hargab;   		
         
  		 } //end while ?> 
	 
		 <tr id="nav"><td colspan="7"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="7"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="7">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
