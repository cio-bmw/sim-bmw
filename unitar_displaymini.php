 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unitar sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#idunit").val(); 
 dataString = 'starting='+page+'&idunit='+cari+'&random='+Math.random(); 
 
  $.ajax({ 
    url:"unitar_displaymini.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitar, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idunit").val(); 
   
 dataString = 'idunit='+ cari;  
  
  $.ajax({ 
    url: "unitar_displaymini.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitar tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitar tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data unitar ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("unitar_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data unitar berhasil di hapus!"); 
					} 
					else{ 
						alert("data unitar gagal di hapus!"); 
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

$unit_idunit = $_GET['idunit']; 
$sql = "select * from unitar where unit_idunit = '$unit_idunit' order by unitmstpayment_idpayment "; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?>
	 
  <table id="unitar" width="95%"> 
<tr><td colspan=5>
Piutang customer
</td></tr>  
  
  <tr> 
 <th>No</th>
<th>Keterangan</th>
<th>created</th>
<th>duedate</th>
<th>Jumlah</th>
</tr> 
		<?php 
		//menampilkan data unitar 
		if(mysql_num_rows($result)!=0){ $no=1;
  		while($row = mysql_fetch_array($result)){
		 $payment=unitmstpaymentinfo($row['unitmstpayment_idpayment']);
	$paymentdesc = $payment['paymentdesc'];
   			
  			
  			 ?>		 
          
       <tr> 
<td><? echo $no;?></td>
<td><? echo $paymentdesc;?></td>
<td><? echo gettanggal($row['createdate']);?></td>
<td><? echo gettanggal($row['duedate']);?></td>
<td class="right"><? echo nf($row['value']);?></td>
 
       </tr> 
  		<? $no++;  } //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
	</form>
