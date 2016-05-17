 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data returndtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination1(page){ 
  var cari = $("input#idreturnhdr").val(); 
  
    dataString = 'starting='+page+'&returnhdr_idreturnhdr='+cari+'&random='+Math.random(); 
     
  $.ajax({ 
    url:"returndtl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data returndtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idreturnhdr").val(); 
 
      dataString = 'returnhdr_idreturnhdr='+ cari; 
   
 
  $.ajax({ 
    url: "returndtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#returndtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#returndtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data returndtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("returndtl_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data returndtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data returndtl gagal di hapus!"); 
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
  
 $returnhdr_idreturnhdr = $_GET['returnhdr_idreturnhdr']; 
 $sql = "select * from returndtl where returnhdr_idreturnhdr ='$returnhdr_idreturnhdr' "; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="returndtl" width="98%"> 
  <tr> 
 <th>No</th>
 <th>Nama Barang</th>
<th>Qty</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data returndtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  				$product = productinfo($row['product_idproduct']);
  		$productname = $product['productname'];	 ?>		 
       <tr> 
 <td><? echo $row['idreturndtl'];?></td>
 <td><? echo $productname;?></td>
<td><? echo $row['qty'];?></td>
 
        <td width="110px"><a href="returndtl_form.php?action=update&id=<? echo $row['idreturndtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="returndtl_process.php?action=delete&id=<? echo $row['idreturndtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
