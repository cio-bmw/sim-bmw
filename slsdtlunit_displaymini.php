 <script type="text/javascript">  

function pagination1(page){ 
 var vidslshdr = $("input#idslshdr").val(); 
     dataString = 'starting='+page+'&id='+vidslshdr+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"slsdtlunit_displaymini.php", 
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
	 
}); 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class1.php'); 
 
 $slshdrunit_idslshdr = $_GET['id']; 
  $sql = "select * from slsdtlunit a, product b where  a.product_idproduct = b.idproduct and  slshdrunit_idslshdr like '%$slshdrunit_idslshdr%' order by idslsdtl"; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 20;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table width="490px" id="slsdtlunit"> 
  <tr> 
<th colspan=2>Nama Barang</th>
<th>Harga</th>
<th>qty</th>
<th>Jumlah</th>
  </tr> 
		<?php 
		//menampilkan data slsdtlunit 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  		$product = productinfo($row['product_idproduct']);
  		$productname = $product['productname'];
  		$jumlah=$row['sales_price'] * $row['qty'];	
  			 ?>		 
       <tr> 
 <td><? echo $row['product_idproduct'];?></td>
 <td><? echo $productname;?></td>
 <td class="right"><? echo nf($row['sales_price']);?></td>
 <td class="right"><? echo nf($row['qty']);?></td>
<td class="right"><? echo nf($jumlah);?></td>
 
       
       </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
