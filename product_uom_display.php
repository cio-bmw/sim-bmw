 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "qty_uom"){ 
    dataString = 'starting='+page+'&qty_uom='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "harga_uom"){ 
    dataString = 'starting='+page+'&harga_uom='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "uom_iduom"){ 
    dataString = 'starting='+page+'&uom_iduom='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "product_idproduct"){ 
    dataString = 'starting='+page+'&product_idproduct='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"product_uom_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pelanggan, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "qty_uom"){ 
      dataString = 'qty_uom='+ cari;  
   } 
   else if (combo == "harga_uom"){ 
      dataString = 'harga_uom='+ cari; 
    } 
   else if (combo == "uom_iduom"){ 
      dataString = 'uom_iduom='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
 
  $.ajax({ 
    url: "product_uom_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#product_uom tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#product_uom tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data product_uom ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("product_uom_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data product_uom berhasil di hapus!"); 
					} 
					else{ 
						alert("data product_uom gagal di hapus!"); 
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
include_once('pagination_class.php'); 
 
if (isset($_GET['qty_uom']) and !empty($_GET['qty_uom'])){ 
 $qty_uom = $_GET['qty_uom']; 
  $sql = "select * from product_uom where qty_uom like '%$qty_uom%' order by qty_uom"; 
} 
else if (isset($_GET['harga_uom']) and !empty($_GET['harga_uom'])){ 
 $harga_uom = $_GET['harga_uom']; 
  $sql = "select * from product_uom where harga_uom like '%$harga_uom%' order by harga_uom"; 
} 
else if (isset($_GET['uom_iduom']) and !empty($_GET['uom_iduom'])){ 
 $uom_iduom = $_GET['uom_iduom']; 
  $sql = "select * from product_uom where uom_iduom like '%$uom_iduom%' order by uom_iduom"; 
} 
else if (isset($_GET['product_idproduct']) and !empty($_GET['product_idproduct'])){ 
 $product_idproduct = $_GET['product_idproduct']; 
  $sql = "select * from product_uom where product_idproduct like '%$product_idproduct%' order by product_idproduct"; 
} 
else{ 
  $sql = "select * from product_uom"; 
} 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="product_uom"> 
  <tr> 
 <th>qty_uom</th>
<th>harga_uom</th>
<th>uom_iduom</th>
<th>product_idproduct</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['qty_uom'];?></td>
<td><? echo $row['harga_uom'];?></td>
<td><? echo $row['uom_iduom'];?></td>
<td><? echo $row['product_idproduct'];?></td>
 
        <td><a href="product_uom_form.php?action=update&id=<? echo $row['idproduct_uom'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idproduct_uom'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
