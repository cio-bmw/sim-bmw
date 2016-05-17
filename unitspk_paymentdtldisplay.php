 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data spkpaymentdtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#idspkpaymenthdr").val(); 
   

    dataString = 'starting='+page+'&id='+cari+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"unitspk_paymentdtldisplay.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data spkpaymentdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idspkpaymenthdr").val(); 
      dataString = 'id='+ cari; 
  
  $.ajax({ 
    url: "unitspk_paymentdtldisplay.php", //file tempat pemrosesan permintaan (request) 
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
  $('#spkpaymentdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#spkpaymentdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data spkpaymentdtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("spkpaymentdtl_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data spkpaymentdtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data spkpaymentdtl gagal di hapus!"); 
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
 
$idunitspk = $_GET['id']; 
 $sql = "select * from spkpaymentdtl where unitspk_idunitspk = '$idunitspk'"; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 <p class="judul">Daftar Pembayaran SPK</p> 
  <table id="spkpaymentdtl" > 
  <tr> 
 <th>No</th>
<th>No Dok</th>
<th>Tanggal</th>
<th>Jumlah</th>

  </tr> 
		<?php 
		//menampilkan data spkpaymentdtl 
		if(mysql_num_rows($result)!=0){ $no=$starting+1; $total=0;
  		while($row = mysql_fetch_array($result)){ 
      $spkpaymenthdr = spkpaymenthdrinfo($row['spkpaymenthdr_idspkpaymenthdr']);
      $tanggal = gettanggal($spkpaymenthdr['paydate']);  				
  		
  		?>		 
       <tr> 
 <td><? echo $no;?></td>
<td><? echo $row['spkpaymenthdr_idspkpaymenthdr'];?></td>
 <td><? echo $tanggal;?></td>
<td class="right"><? echo nf($row['payvalue']);?></td>
 
       
       </tr> 
  		<?  $no++;
          $total= $total+$row['payvalue'];    		
  		
  		} //end while ?> 
		 <tr><td colspan="3">Total</td><td class="right"><?php echo nf($total);?></td></tr> 
 		 <tr id="nav"><td colspan="4"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="4"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="4">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
