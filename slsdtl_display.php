 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idslsdtl"){ 
    dataString = 'starting='+page+'&idslsdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "cost_price"){ 
    dataString = 'starting='+page+'&cost_price='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "qty"){ 
    dataString = 'starting='+page+'&qty='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "dtl_discount"){ 
    dataString = 'starting='+page+'&dtl_discount='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sales_price"){ 
    dataString = 'starting='+page+'&sales_price='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "dtl_percent"){ 
    dataString = 'starting='+page+'&dtl_percent='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "product_idproduct"){ 
    dataString = 'starting='+page+'&product_idproduct='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "slshdr_idslshdr"){ 
    dataString = 'starting='+page+'&slshdr_idslshdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"slsdtl_display.php", 
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
   
	  if (combo == "idslsdtl"){ 
      dataString = 'idslsdtl='+ cari;  
   } 
   else if (combo == "cost_price"){ 
      dataString = 'cost_price='+ cari; 
    } 
   else if (combo == "qty"){ 
      dataString = 'qty='+ cari; 
    } 
   else if (combo == "dtl_discount"){ 
      dataString = 'dtl_discount='+ cari; 
    } 
   else if (combo == "sales_price"){ 
      dataString = 'sales_price='+ cari; 
    } 
   else if (combo == "dtl_percent"){ 
      dataString = 'dtl_percent='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
   else if (combo == "slshdr_idslshdr"){ 
      dataString = 'slshdr_idslshdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "slsdtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#slsdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#slsdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data slsdtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("slsdtl_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data slsdtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data slsdtl gagal di hapus!"); 
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
 
if (isset($_GET['idslsdtl']) and !empty($_GET['idslsdtl'])){ 
 $idslsdtl = $_GET['idslsdtl']; 
  $sql = "select * from slsdtl where idslsdtl like '%$idslsdtl%' order by idslsdtl"; 
} 
else if (isset($_GET['cost_price']) and !empty($_GET['cost_price'])){ 
 $cost_price = $_GET['cost_price']; 
  $sql = "select * from slsdtl where cost_price like '%$cost_price%' order by cost_price"; 
} 
else if (isset($_GET['qty']) and !empty($_GET['qty'])){ 
 $qty = $_GET['qty']; 
  $sql = "select * from slsdtl where qty like '%$qty%' order by qty"; 
} 
else if (isset($_GET['dtl_discount']) and !empty($_GET['dtl_discount'])){ 
 $dtl_discount = $_GET['dtl_discount']; 
  $sql = "select * from slsdtl where dtl_discount like '%$dtl_discount%' order by dtl_discount"; 
} 
else if (isset($_GET['sales_price']) and !empty($_GET['sales_price'])){ 
 $sales_price = $_GET['sales_price']; 
  $sql = "select * from slsdtl where sales_price like '%$sales_price%' order by sales_price"; 
} 
else if (isset($_GET['dtl_percent']) and !empty($_GET['dtl_percent'])){ 
 $dtl_percent = $_GET['dtl_percent']; 
  $sql = "select * from slsdtl where dtl_percent like '%$dtl_percent%' order by dtl_percent"; 
} 
else if (isset($_GET['product_idproduct']) and !empty($_GET['product_idproduct'])){ 
 $product_idproduct = $_GET['product_idproduct']; 
  $sql = "select * from slsdtl where product_idproduct like '%$product_idproduct%' order by product_idproduct"; 
} 
else if (isset($_GET['slshdr_idslshdr']) and !empty($_GET['slshdr_idslshdr'])){ 
 $slshdr_idslshdr = $_GET['slshdr_idslshdr']; 
  $sql = "select * from slsdtl where slshdr_idslshdr like '%$slshdr_idslshdr%' order by slshdr_idslshdr"; 
} 
else{ 
  $sql = "select * from slsdtl"; 
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
	 
  <table id="slsdtl"> 
  <tr> 
 <th>idslsdtl</th>
<th>cost_price</th>
<th>qty</th>
<th>dtl_discount</th>
<th>sales_price</th>
<th>dtl_percent</th>
<th>product_idproduct</th>
<th>slshdr_idslshdr</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idslsdtl'];?></td>
<td><? echo $row['cost_price'];?></td>
<td><? echo $row['qty'];?></td>
<td><? echo $row['dtl_discount'];?></td>
<td><? echo $row['sales_price'];?></td>
<td><? echo $row['dtl_percent'];?></td>
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $row['slshdr_idslshdr'];?></td>
 
        <td><a href="slsdtl_form.php?action=update&id=<? echo $row['idslsdtl'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idslsdtl'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
