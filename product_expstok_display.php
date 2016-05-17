 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "exp_date"){ 
    dataString = 'starting='+page+'&exp_date='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "stok"){ 
    dataString = 'starting='+page+'&stok='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "product_idproduct"){ 
    dataString = 'starting='+page+'&product_idproduct='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_date"){ 
    dataString = 'starting='+page+'&rcv_date='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"product_expstok_display.php", 
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
   
	  if (combo == "exp_date"){ 
      dataString = 'exp_date='+ cari;  
   } 
   else if (combo == "stok"){ 
      dataString = 'stok='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
   else if (combo == "rcv_date"){ 
      dataString = 'rcv_date='+ cari; 
    } 
 
  $.ajax({ 
    url: "product_expstok_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#product_expstok tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#product_expstok tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data product_expstok ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("product_expstok_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data product_expstok berhasil di hapus!"); 
					} 
					else{ 
						alert("data product_expstok gagal di hapus!"); 
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
 
if (isset($_GET['exp_date']) and !empty($_GET['exp_date'])){ 
 $exp_date = $_GET['exp_date']; 
  $sql = "select * from product_expstok where exp_date like '%$exp_date%' order by exp_date"; 
} 
else if (isset($_GET['stok']) and !empty($_GET['stok'])){ 
 $stok = $_GET['stok']; 
  $sql = "select * from product_expstok where stok like '%$stok%' order by stok"; 
} 
else if (isset($_GET['product_idproduct']) and !empty($_GET['product_idproduct'])){ 
 $product_idproduct = $_GET['product_idproduct']; 
  $sql = "select * from product_expstok where product_idproduct like '%$product_idproduct%' order by product_idproduct"; 
} 
else if (isset($_GET['rcv_date']) and !empty($_GET['rcv_date'])){ 
 $rcv_date = $_GET['rcv_date']; 
  $sql = "select * from product_expstok where rcv_date like '%$rcv_date%' order by rcv_date"; 
} 
else{ 
  $sql = "select * from product_expstok"; 
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
	 
  <table id="product_expstok"> 
  <tr> 
 <th>exp_date</th>
<th>stok</th>
<th>product_idproduct</th>
<th>rcv_date</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['exp_date'];?></td>
<td><? echo $row['stok'];?></td>
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $row['rcv_date'];?></td>
 
        <td><a href="product_expstok_form.php?action=update&id=<? echo $row['idproduct_expstok'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idproduct_expstok'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
