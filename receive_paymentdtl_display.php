 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data receive_paymentdtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpaymentdtl"){ 
    dataString = 'starting='+page+'&idpaymentdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pay_value"){ 
    dataString = 'starting='+page+'&pay_value='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "receivehdr_idreceivehdr"){ 
    dataString = 'starting='+page+'&receivehdr_idreceivehdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "receive_paymenthdr_idpaymenthdr"){ 
    dataString = 'starting='+page+'&receive_paymenthdr_idpaymenthdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"receive_paymentdtl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receive_paymentdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var id = $("input#idpaymenthdr").val(); 
  
  dataString = 'id='+ id;  
   
  $.ajax({ 
    url: "receive_paymentdtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receive_paymentdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receive_paymentdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		return false; 
	}); 
	 
	$("a.detail").click(function(){ 
		window.location=$(this).attr("href"); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data receive_paymentdtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("receive_paymentdtl_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data receive_paymentdtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data receive_paymentdtl gagal di hapus!"); 
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
$id = $_GET['id']; 

$sql = "select * from receive_paymentdtl where receive_paymenthdr_idpaymenthdr = '$id'"; 

 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
<p class="judul">Daftar Invoice Yang Di Bayar</p> 
  <table id="receive_paymentdtl" width="400px"> 
  <tr> 
<th>ID</th>
<th>No Dok</th>
<th>Jumlah</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receive_paymentdtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
<td><? echo $row['idpaymentdtl'];?></td>
<td><? echo $row['receivehdr_idreceivehdr'];?></td>
<td class="right"><? echo nf($row['pay_value']);?></td>
 
        <td width="105px"> 
       <a href="receive_paymentdtl_form.php?action=update&id=<? echo $row['idreceive_paymentdtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="receive_paymentdtl_process.php?action=delete&id=<? echo $row['idreceive_paymentdtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?  
$jumlah = $jumlah + $row['pay_value'] ; 		
  		
  		 } //end while ?> 
       <tr><td colspan="2">Jumlah</td><td class="right"><? echo nf($jumlah); ?></td><td></td></tr>     		
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
