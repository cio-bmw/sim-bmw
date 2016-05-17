 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data slsdtlsektor sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
    var myvar = getURLParameter('id');
     var param = 'id=' +  myvar;
   
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
   else if (combo == "slshdrsektor_idslshdr"){ 
    dataString = 'starting='+page+'&slshdrsektor_idslshdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"slsdtlsektor_display.php", 
    data: param, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data slsdtlsektor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
    var myvar = getURLParameter('id');
     var param = 'id=' +  myvar;
   
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
   else if (combo == "slshdrsektor_idslshdr"){ 
      dataString = 'slshdrsektor_idslshdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "slsdtlsektor_display.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: param, 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#slsdtlsektor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#slsdtlsektor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	
		$("a.noaction").click(function(){ 
		alert('Data sudah di confirm tidak bisa di rubah');
		return false; 
	}); 
	
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data slsdtlsektor ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("slsdtlsektor_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data slsdtlsektor berhasil di hapus!"); 
					} 
					else{ 
						alert("Data tidak bisa di hapus ! masih ada data detail nya!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 
	 
}); 

function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
} 
  
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$id = $_GET['id']; 
$sql = "select * from slsdtlsektor where slshdrsektor_idslshdr = '$id'";

$check=mysql_fetch_array(mysql_query("select sls_status from slshdrsektor where idslshdr = '$id'"));
$status = $check[0];
 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 

  <table class="grid" id="slsdtlsektor"> 
  <tr> 
 <th>No</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>Jumlah</th>
<th>Harga</th>
<th>Total</th>

<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data slsdtlsektor 
		if(mysql_num_rows($result)!=0){ $alltotal=0; $no=1;
  		while($row = mysql_fetch_array($result)){ 
$product=productinfo($row['product_idproduct']) ;
$productname=$product['productname'] ;
$total = $row['qty'] * $row['sales_price'];		
  		?>		 
       <tr> 
 <td><? echo $no;?></td>
 <td><? echo $row['product_idproduct'];?></td>
 <td><? echo $productname;?></td>
<td class="right"><? echo $row['qty'];?></td>
<td class="right"><? echo nf($row['sales_price']);?></td>
<td class="right"><? echo nf($total);?></td>

        <td width="120px">
        <? if ($status == 'open') { ?>        
        <a href="slsdtlsektor_form.php?action=update&id=<? echo $row['idslsdtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="slsdtlsektor_process.php?action=delete&id=<? echo $row['idslsdtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a>
             <? } else { ?>
              <a href="slsdtlsektor_form.php?action=update&id=<? echo $row['idslsdtl'];?>" class="noaction"> <input type="button" class="button" value="Edit"></a>   
       | <a href="slsdtlsektor_process.php?action=delete&id=<? echo $row['idslsdtl'];?>" class="noaction"><input type="button" class="button" value="Delete"></a>
      
             
                   <? } ?> 
       
       </td></tr>
        
  		<?
$alltotal = $alltotal + $total;  $no++;		
  		} //end while 
  				
  		?>
  		
  		<tr><td colspan="5">Total Nilai Pengeluaran Barang</td><td class="right"><? echo nf($alltotal);?> </td>
  		</tr>
		 <tr id="nav"><td colspan="8"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="8"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
