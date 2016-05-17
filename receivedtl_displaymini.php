 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data receivedtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination1(page){ 
  var cari = $("input#idreceivehdr").val(); 
 
	
    dataString = 'starting='+page+'&id='+cari+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"receivedtl_displaymini.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receivedtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idreceivehdr").val(); 
  
  dataString = 'id ='+ cari; 
   
  $.ajax({ 
    url: "receivedtl_displaymini.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receivedtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receivedtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data receivedtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("receivedtl_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data receivedtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data receivedtl gagal di hapus!"); 
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
$id=$_GET['id'];

$sql = "select * from receivedtl where receivehdr_idreceivehdr = '$id'";  
//$sql = "select * from receivedtl"; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class1($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 <p class="judul">Daftar Barang Yang Di terima</p>
  <table width="495px" id="receivedtl"> 
  <tr> 
 <th>No</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>Jumlah</th>
<th>Harga</th>
<th>Total</th>
 </tr> 
		<?php 
		//menampilkan data receivedtl 
		if(mysql_num_rows($result)!=0){ $no =1; $alltotal = 0;
  		while($row = mysql_fetch_array($result)){
     $product = productinfo($row['product_idproduct']);
     $productname=$product['productname'];  		
     $total = $row['qty']	*$row['receive_price'];
  			 ?>		 
       <tr> 
 <td><? echo $no;?></td>
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $productname;?></td>

<td class="right"><? echo $row['qty'];?></td>
<td class="right"><? echo nf($row['receive_price']);?></td>
<td class="right"><? echo nf($total);?></td>


      
       </td></tr> 
  		<? $no++;
      $alltotal = $alltotal + $total ;  		
  		} 	//end while ?> 
  		
  		<tr><td class="right" colspan=5>Total</td><td class="right"><? echo nf($alltotal); ?></td></tr>
  		
  	
		 <tr id="nav"><td colspan="7"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="7"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="7">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
