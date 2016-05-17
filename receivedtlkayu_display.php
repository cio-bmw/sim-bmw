 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data receivedtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#idreceivehdr").val(); 
 
	
    dataString = 'starting='+page+'&id='+cari+'&random='+Math.random(); 
   
   
  $.ajax({ 
    url:"receivedtlkayu_display.php", 
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
    url: "receivedtlkayu_display.php", //file tempat pemrosesan permintaan (request) 
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
	$("a.noaction").click(function(){ 
		alert('Data sudah di confirm tidak bisa di rubah');
		return false; 
	}); 
	
	 
	$("a.delete").click(function(){ 
var myvar = getURLParameter('id');
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data Penerimaan Kayu ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("receivedtlkayu_form.php"); 
						$("#divFormEntry").hide();
						page2="receivedtlkayu_display.php?id="+myvar;
		            $("#divPageData").load(page2); 
	             	$("#divPageData").show(); 
						 
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
 function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
} 
  
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$id=$_GET['id'];

$sql = "select * from receivedtlkayu where receivehdr_idreceivehdr = '$id'";  
//$sql = "select * from receivedtl"; 

$check=mysql_fetch_array(mysql_query("select rcv_status from receivehdrkayu where idreceivehdr = '$id'"));
$status = $check[0];
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	<p class="judul">Daftar Barang yang Di Terima</p> 
  <table class="grid" id="receivedtl"> 
  <tr> 
 <th>No</th>
<th>Kode</th>
<th>Nama Barang</th>
<th>Jumlah</th>
<th>Harga</th>
<th>Total</th>
<th>aksi</th>
 </tr> 
		<?php 
		//menampilkan data receivedtl 
		if(mysql_num_rows($result)!=0){ $no =1; $alltotal = 0;
  		while($row = mysql_fetch_array($result)){
     $product = productkayuinfo($row['product_idproduct']);
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


 
        <td width="120px">
       <? if ($status == 'open') { ?>
        <a href="receivedtlkayu_form.php?action=update&id=<? echo $row['idreceivedtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="receivedtlkayu_process.php?action=delete&id=<? echo $row['idreceivedtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a>
       <? } else { ?>
        <a href="receivedtlkayu_form.php?action=update&id=<? echo $row['idreceivedtl'];?>" class="noaction"> <input type="button" class="button" value="Edit"></a>   
       | <a href="receivedtlkayu_process.php?action=delete&id=<? echo $row['idreceivedtl'];?>" class="noaction"><input type="button" class="button" value="Delete"></a>
       	
        <? } ?>
       
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
