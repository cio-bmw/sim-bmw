 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data tipe_materialbudget sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination1(page){ 
  var cari = $("input#idtipe").val(); 
  

   dataString = 'starting='+page+'&idtipe='+cari+'&random='+Math.random(); 
 
   
  $.ajax({ 
    url:"tipe_materialbudget_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data tipe_materialbudget, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idtipe").val(); 

      dataString = 'idtipe='+ cari; 
   
  $.ajax({ 
    url: "tipe_materialbudget_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#tipe_materialbudget tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#tipe_materialbudget tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageEntry").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageEntry").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data tipe_materialbudget ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("tipe_materialbudget_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data tipe_materialbudget berhasil di hapus!"); 
					} 
					else{ 
						alert("data tipe_materialbudget gagal di hapus!"); 
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
 
$tipe_idtipe = $_GET['idtipe']; 
$sql = "select * from tipe_materialbudget a, product b  where a.product_idproduct = b.idproduct and tipe_idtipe = '$tipe_idtipe' order by productname"; 

 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="tipe_materialbudget" width="500px"> 
<tr><td colspan=5>Budget Material </td></tr>  
 <tr> 
<th>No Id</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>Budget</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data tipe_materialbudget 
		if(mysql_num_rows($result)!=0){ $no=1;
  		while($row = mysql_fetch_array($result)){
  		$product = productinfo($row['product_idproduct']);
$productname = $product['productname'];		
  			
  			 ?>		 
       <tr> 
 <td><? echo $no;?></td>
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $productname?></td>
<td class="right"><? echo $row['qty'];?></td>
 
        <td width="120px"><a href="tipe_materialbudget_form.php?action=update&id=<? echo $row['idbudget'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="tipe_materialbudget_process.php?action=delete&id=<? echo $row['idbudget'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?
  $no++;  		
  		} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
