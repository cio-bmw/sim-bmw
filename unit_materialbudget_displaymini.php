 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unit_materialbudget sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination1(page){ 
  var cari = $("input#idunit").val(); 
  

    dataString = 'starting='+page+'&idunit='+cari+'&random='+Math.random(); 
  
   
  $.ajax({ 
    url:"unit_materialbudget_displaymini.php", 
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
    url: "unit_materialbudget_displaymini.php", //file tempat pemrosesan permintaan (request) 
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
 $sql = "select * from unit_materialbudget where unit_idunit = '$unit_idunit' order by idbudget desc   "; 

 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="unit_materialbudget" width="95%"> 
  <tr> 
 <th>id</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>Harga</th>
<th>Qty</th>
<th>Total</th>
  </tr> 
		<?php 
		//menampilkan data unit_materialbudget 
		if(mysql_num_rows($result)!=0){ $no=$starting+1; $total=0;
  		while($row = mysql_fetch_array($result)){
$idproduct = $row['product_idproduct'];  			
$product = productinfo($row['product_idproduct']);
$productname = $product['productname'];	  			

$sql1 = "select IFNULL(sum(qty),0) jml from slsdtlunit a, slshdrunit b
where a.slshdrunit_idslshdr = b.idslshdr and 
b.unit_idunit = '$unit_idunit' and a.product_idproduct = '$idproduct' "; 
$data1  = mysql_fetch_array(mysql_query($sql1));  
$progress = $data1[0];	  		
//$pct = $jumlah/$total*100;

$jumlah = $row['price'] * $row['budget_qty'];


  			 ?>		 
       <tr> 
 <td><? echo $no;?></td>
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $productname;?></td>
 <td class="right"><? echo nf($row['price']);?></td>
 <td class="right"><? echo nf($row['budget_qty']);?></td>
 <td class="right"><? echo nf($jumlah);?></td>

 

       
       </tr> 
  		<?  
  		$no++;
$total =$total + $jumlah;  		
  		
  		} //end while ?> 
  		 <tr><td colspan="4">Total</td><td colspan="5"><?php $total; ?></td></tr> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
