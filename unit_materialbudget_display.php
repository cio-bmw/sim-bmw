 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unit_materialbudget sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination1(page){ 
  var cari = $("input#idunit").val(); 
  

    dataString = 'starting='+page+'&idunit='+cari+'&random='+Math.random(); 
  
   
  $.ajax({ 
    url:"unit_materialbudget_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unit_materialbudget, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idunit").val(); 
  
      dataString = 'idunit='+ cari; 
  
  $.ajax({ 
    url: "unit_materialbudget_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unit_materialbudget tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unit_materialbudget tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageEntry").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageEntry").show(); 
	
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data unit_materialbudget ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("unit_materialbudget_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data unit_materialbudget berhasil di hapus!"); 
					} 
					else{ 
						alert("data unit_materialbudget gagal di hapus!"); 
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
 

 $unit_idunit = $_GET['idunit']; 
 $sql = "select * from unit_materialbudget a, product b where a.product_idproduct = b.idproduct and unit_idunit = '$unit_idunit' order by productname "; 

 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="unit_materialbudget" class="grid"> 
  <tr> 
 <th>id</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>Harga</th>
<th>Qty Budget</th>
<th>Qty Progress</th>
<th>Total Budget</th>
<th>Total Progress</th>

<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unit_materialbudget 
		if(mysql_num_rows($result)!=0){ $no=$starting+1; 
  		while($row = mysql_fetch_array($result)){
$idproduct = $row['product_idproduct'];  			
$product = productinfo($row['product_idproduct']);
$productname = $product['productname'];	  			

$sql1 = "select IFNULL(sum(qty),0) jml,product_idproduct from slsdtlunit a, slshdrunit b
where a.slshdrunit_idslshdr = b.idslshdr and 
b.unit_idunit = '$unit_idunit' and a.product_idproduct = '$idproduct' group by product_idproduct "; 
$data1  = mysql_fetch_array(mysql_query($sql1));  
$progress = $data1[0];	

  		
//$pct = $jumlah/$total*100;

$jumlah = $row['price'] * $row['budget_qty'];
$jumlahp = $row['price'] * $progress;

  			 ?>		 
       <tr> 
 <td><? echo $no;?></td>
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $productname;?></td>
 <td class="right"><? echo nf($row['price']);?></td>
 <td class="right"><? echo $row['budget_qty'];?></td>
<td class="right"><? echo $progress;?></td>
 <td class="right"><? echo nf($jumlah);?></td>
<td class="right"><? echo nf($jumlahp);?></td>
 

        <td width="110px"><a href="unit_materialbudget_form.php?action=update&id=<? echo $row['idbudget'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unit_materialbudget_process.php?action=delete&id=<? echo $row['idbudget'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?  
  		$no++;
$total =$total + $jumlah;  		
$totalp = $totalp + $jumlahp;
  		
  		} //end while ?> 
  		 <tr><td colspan="6">Total Halaman</td><td class="right"><?php echo nf($total); ?></td><td class="right"><? echo nf($totalp); ?></td><td></td></tr> 
		 <tr id="nav"><td colspan="9"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="9"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="9">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
