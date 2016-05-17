 <script type="text/javascript">  

function pagination1(page){ 
 var vunit = $("input#unit_idunit").val(); 
     dataString = 'starting='+page+'&id='+vunit+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"slsdtlunit_rekap.php", 
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
 
$idunit = $_GET['id']; 
$sql = "select sum(qty) qty, sum(qty*sales_price) harga, product_idproduct,unit_idunit from slsdtlunit a, slshdrunit b, product c where a.product_idproduct = c.idproduct and 
a.slshdrunit_idslshdr = b.idslshdr and  b.unit_idunit = '$idunit' group by product_idproduct order by productname"; 

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
 
$recpage = 100;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
<p class="judul">Rekap Pengeluaran Barang</p>
   
<table class="grid">
<tr><td colspan="5">Sektor : Sektor <? echo $sektorname;?> &nbsp;&nbsp;&nbsp; Kavling :  <? echo $kavling; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input  class="button" type="button" value="Cetak Progress" id="btncetak"> </td></tr>
<input type="hidden" id="unit_idunit" name="unit_idunit" value="<? echo $idunit ?>">

</table>

  <table  id="slsdtlunit"> 
  <tr> 
  <th>No</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>QTY Progres</th>
<th>QTY Budget</th> 
<th>Total Harga</th>

<th>Total Budget</th> 
  </tr> 
		<?php 
		//menampilkan data slsdtlunit 
		if(mysql_num_rows($result)!=0){  $no=$starting+1;
  		while($row = mysql_fetch_array($result)){
      $idproduct = 	$row['product_idproduct'];
  		$product = productinfo($row['product_idproduct']);
  		$productname = $product['productname'];	
      $unit_idunit = $row['unit_idunit'];

       $resultb=mysql_query("select IFNULL(budget_qty,0) qty, sum(price*budget_qty) hargab  from unit_materialbudget where product_idproduct = '$idproduct' and unit_idunit='$unit_idunit'" );
       $datab  = mysql_fetch_array($resultb);  
       $budgetqty=$datab[0];
       $hargab=$datab[1];
       




			 ?>		 
       <tr> 
 <td><? echo $no;?></td>
 <td><? echo $row['product_idproduct'];?></td>
 <td><? echo $productname;?></td>
<td class="right"><? echo nf($row['qty']);?></td>
<td class="right"><? echo nf($budgetqty);?></td>
<td class="right"><? echo nf($row['harga']);?></td>

<td class="right"><? echo nf($hargab);?></td>


       </tr> 
  		<? $no++; 
         $totalp = $totalp + $row['harga'];   		
         $totalb = $totalb + $hargab;   		
         
  		 } //end while ?> 
		 <tr id="nav"><td colspan="4">Total</td><td></td><td class="right"><?php echo nf($totalp); ?></td><td class="right"><? echo nf($totalb);  ?></td></tr> 
	 
		 <tr id="nav"><td colspan="7"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="7"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="7">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
