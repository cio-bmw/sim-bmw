 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "qtystock"){ 
    dataString = 'starting='+page+'&qtystock='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "product_idproduct"){ 
    dataString = 'starting='+page+'&product_idproduct='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "stockloc_idstockloc"){ 
    dataString = 'starting='+page+'&stockloc_idstockloc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"stocklocproduct_display.php", 
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
   
	  if (combo == "qtystock"){ 
      dataString = 'qtystock='+ cari;  
   } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
   else if (combo == "stockloc_idstockloc"){ 
      dataString = 'stockloc_idstockloc='+ cari; 
    } 
 
  $.ajax({ 
    url: "stocklocproduct_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#stocklocproduct tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#stocklocproduct tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data stocklocproduct ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("stocklocproduct_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data stocklocproduct berhasil di hapus!"); 
					} 
					else{ 
						alert("data stocklocproduct gagal di hapus!"); 
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
 
if (isset($_GET['qtystock']) and !empty($_GET['qtystock'])){ 
 $qtystock = $_GET['qtystock']; 
  $sql = "select * from stocklocproduct where qtystock like '%$qtystock%' order by qtystock"; 
} 
else if (isset($_GET['product_idproduct']) and !empty($_GET['product_idproduct'])){ 
 $product_idproduct = $_GET['product_idproduct']; 
  $sql = "select * from stocklocproduct where product_idproduct like '%$product_idproduct%' order by product_idproduct"; 
} 
else if (isset($_GET['stockloc_idstockloc']) and !empty($_GET['stockloc_idstockloc'])){ 
 $stockloc_idstockloc = $_GET['stockloc_idstockloc']; 
  $sql = "select * from stocklocproduct where stockloc_idstockloc like '%$stockloc_idstockloc%' order by stockloc_idstockloc"; 
} 
else{ 
  $sql = "select * from stocklocproduct"; 
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
	 
  <table id="stocklocproduct"> 
  <tr> 
 <th>qtystock</th>
<th>product_idproduct</th>
<th>stockloc_idstockloc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['qtystock'];?></td>
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $row['stockloc_idstockloc'];?></td>
 
        <td><a href="stocklocproduct_form.php?action=update&id=<? echo $row['idstocklocproduct'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idstocklocproduct'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
