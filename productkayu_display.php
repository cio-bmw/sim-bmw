 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data product sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idproduct"){ 
    dataString = 'starting='+page+'&idproduct='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "productname"){ 
    dataString = 'starting='+page+'&productname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "uom_iduom"){ 
    dataString = 'starting='+page+'&uom_iduom='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "category_idcat"){ 
    dataString = 'starting='+page+'&category_idcat='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "supplier_idsupp"){ 
    dataString = 'starting='+page+'&supplier_idsupp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "location_idlocation"){ 
    dataString = 'starting='+page+'&location_idlocation='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "salesprice"){ 
    dataString = 'starting='+page+'&salesprice='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "costprice"){ 
    dataString = 'starting='+page+'&costprice='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "stock"){ 
    dataString = 'starting='+page+'&stock='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "stockwh"){ 
    dataString = 'starting='+page+'&stockwh='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "limitstock"){ 
    dataString = 'starting='+page+'&limitstock='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "limitstockwh"){ 
    dataString = 'starting='+page+'&limitstockwh='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "status"){ 
    dataString = 'starting='+page+'&status='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "active"){ 
    dataString = 'starting='+page+'&active='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "boxqty"){ 
    dataString = 'starting='+page+'&boxqty='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"productkayu_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data product, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idproduct"){ 
      dataString = 'idproduct='+ cari;  
   } 
   else if (combo == "productname"){ 
      dataString = 'productname='+ cari; 
    } 
   else if (combo == "uom_iduom"){ 
      dataString = 'uom_iduom='+ cari; 
    } 
   else if (combo == "category_idcat"){ 
      dataString = 'category_idcat='+ cari; 
    } 
   else if (combo == "supplier_idsupp"){ 
      dataString = 'supplier_idsupp='+ cari; 
    } 
   else if (combo == "location_idlocation"){ 
      dataString = 'location_idlocation='+ cari; 
    } 
   else if (combo == "salesprice"){ 
      dataString = 'salesprice='+ cari; 
    } 
   else if (combo == "costprice"){ 
      dataString = 'costprice='+ cari; 
    } 
   else if (combo == "stock"){ 
      dataString = 'stock='+ cari; 
    } 
   else if (combo == "stockwh"){ 
      dataString = 'stockwh='+ cari; 
    } 
   else if (combo == "limitstock"){ 
      dataString = 'limitstock='+ cari; 
    } 
   else if (combo == "limitstockwh"){ 
      dataString = 'limitstockwh='+ cari; 
    } 
   else if (combo == "status"){ 
      dataString = 'status='+ cari; 
    } 
   else if (combo == "active"){ 
      dataString = 'active='+ cari; 
    } 
   else if (combo == "boxqty"){ 
      dataString = 'boxqty='+ cari; 
    } 
 
  $.ajax({ 
    url: "productkayu_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#product tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#product tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	
	$("a.detail").click(function(){ 
	page=$(this).attr("href"); 
		window.location=page;
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data product ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("productkayu_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data product berhasil di hapus!"); 
					} 
					else{ 
						alert("data product gagal di hapus!"); 
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
 
if (isset($_GET['idproduct']) and !empty($_GET['idproduct'])){ 
 $idproduct = $_GET['idproduct']; 
  $sql = "select * from productkayu where idproduct like '%$idproduct%' order by idproduct"; 
} 
else if (isset($_GET['productname']) and !empty($_GET['productname'])){ 
 $productname = $_GET['productname']; 
  $sql = "select * from productkayu where productname like '%$productname%' order by productname"; 
} 
else if (isset($_GET['uom_iduom']) and !empty($_GET['uom_iduom'])){ 
 $uom_iduom = $_GET['uom_iduom']; 
  $sql = "select * from productkayu where uom_iduom like '%$uom_iduom%' order by uom_iduom"; 
} 
else if (isset($_GET['category_idcat']) and !empty($_GET['category_idcat'])){ 
 $category_idcat = $_GET['category_idcat']; 
  $sql = "select * from productkayu where category_idcat like '%$category_idcat%' order by category_idcat"; 
} 
else if (isset($_GET['supplier_idsupp']) and !empty($_GET['supplier_idsupp'])){ 
 $supplier_idsupp = $_GET['supplier_idsupp']; 
  $sql = "select * from productkayu where supplier_idsupp like '%$supplier_idsupp%' order by supplier_idsupp"; 
} 
else if (isset($_GET['location_idlocation']) and !empty($_GET['location_idlocation'])){ 
 $location_idlocation = $_GET['location_idlocation']; 
  $sql = "select * from productkayu where location_idlocation like '%$location_idlocation%' order by location_idlocation"; 
} 
else if (isset($_GET['salesprice']) and !empty($_GET['salesprice'])){ 
 $salesprice = $_GET['salesprice']; 
  $sql = "select * from productkayu where salesprice like '%$salesprice%' order by salesprice"; 
} 
else if (isset($_GET['costprice']) and !empty($_GET['costprice'])){ 
 $costprice = $_GET['costprice']; 
  $sql = "select * from productkayu where costprice like '%$costprice%' order by costprice"; 
} 
else if (isset($_GET['stock']) and !empty($_GET['stock'])){ 
 $stock = $_GET['stock']; 
  $sql = "select * from productkayu where stock like '%$stock%' order by stock"; 
} 
else if (isset($_GET['stockwh']) and !empty($_GET['stockwh'])){ 
 $stockwh = $_GET['stockwh']; 
  $sql = "select * from productkayu where stockwh like '%$stockwh%' order by stockwh"; 
} 
else if (isset($_GET['limitstock']) and !empty($_GET['limitstock'])){ 
 $limitstock = $_GET['limitstock']; 
  $sql = "select * from productkayu where limitstock like '%$limitstock%' order by limitstock"; 
} 
else if (isset($_GET['limitstockwh']) and !empty($_GET['limitstockwh'])){ 
 $limitstockwh = $_GET['limitstockwh']; 
  $sql = "select * from productkayu where limitstockwh like '%$limitstockwh%' order by limitstockwh"; 
} 
else if (isset($_GET['status']) and !empty($_GET['status'])){ 
 $status = $_GET['status']; 
  $sql = "select * from productkayu where status like '%$status%' order by status"; 
} 
else if (isset($_GET['active']) and !empty($_GET['active'])){ 
 $active = $_GET['active']; 
  $sql = "select * from productkayu where active like '%$active%' order by active"; 
} 
else if (isset($_GET['boxqty']) and !empty($_GET['boxqty'])){ 
 $boxqty = $_GET['boxqty']; 
  $sql = "select * from productkayu where boxqty like '%$boxqty%' order by boxqty"; 
} 
else{ 
  $sql = "select * from productkayu"; 
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
	<p class="judul">Master Kayu</p> 
  <table class="grid" id="product"> 
  <tr> 
 <th>Kode</th>
<th>Nama Barang</th>
<th>Kode</th>
<th>Nama Supplier</th>

<th>Harga Jual</th>
<th>Harga Beli</th>
<th>Stock</th>
<th>Limit</th>

<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data product 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
$supplier = supplierinfo($row['supplier_idsupp']);
$suppname = $supplier['suppname'];  			
  			 ?>		 
       <tr> 
 <td><? echo $row['idproduct'];?></td>
<td><? echo $row['productname'];?></td>
<td><? echo $row['supplier_idsupp'];?></td>
<td><? echo $suppname;?></td>

<td class="right"><? echo nf($row['salesprice']);?></td>
<td class="right"><? echo nf($row['costprice']);?></td>
<td class="right"><? echo nf($row['stock']);?></td>
<td class="right"><? echo nf($row['limitstock']);?></td>

 
        <td width="180px">
       | <a href="productkayu_history.php?id=<? echo $row['idproduct'];?>" class="detail"> <input type="button" class="button" value="History"></a>  
       | <a href="productkayu_form.php?action=update&id=<? echo $row['idproduct'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="productkayu_process.php?action=delete&id=<? echo $row['idproduct'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
