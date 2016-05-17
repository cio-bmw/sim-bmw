 <script type="text/javascript">  
function pagination(page){ 
  var dataString; 
  var vduedate = $("input#duedate").val(); 
  var vsektor = $("select#sektor_idsektor").val(); 
   
  dataString = 'starting='+page+'&sektor='+vsektor+'&duedate='+vduedate; 
   
  $.ajax({ 
    url:"unitar_accdisplay.php", 
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
  var vduedate = $("input#duedate").val(); 
  var vsektor = $("select#sektor_idsektor").val(); 
   
   dataString = 'starting='+page+'&sektor='+vsektor+'&duedate='+vduedate; 
 
  $.ajax({ 
    url: "unitar_accdisplay.php", //file tempat pemrosesan permintaan (request) 
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
	
	$("#btnaddar").click(function(){ 
	   page="unitar_accdisplay.php?idunit=301"; 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 

		page1="unitar_form.php?idunit="+ vidunit; 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show(); 
		
		page2="unitmstpayment_lov.php?idunitx="+ vidunit;
		$("#divLOV").load(page2); 
		$("#divLOV").show(); 

		return false; 
	}); 
	  
	
}); 

 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
 
$sektor = $_GET['sektor']; 
$duedate = settanggal($_GET['duedate']);

if ($sektor=='%') {
$sql = "select * from unitar a, unit b where a.unit_idunit = b.idunit 
and a.duedate < '$duedate' "; 
} else {
$sql = "select * from unitar a, unit b where a.unit_idunit = b.idunit 
and b.sektor_idsektor = '$sektor' and a.duedate < '$duedate' "; 
} 

 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?>
	 
  <table  class="grid" id="unitar"> 
<tr><td colspan=10>Piutang customer <? echo $sektor.$duedate; ?>
</td> </tr>  
  
  <tr> 
 <th>Unit</th>
   <th>Sektor</th>
  <th>Kavling</th>
 <th>Kode</th>
  <th>Keterangan</th>
 <th>value</th>
<th>createdate</th>
<th>duedate</th>
<th>paydate</th>
<th>Dok Pembayaran</th>
  </tr> 
		<?php 
		//menampilkan data unitar 
		if(mysql_num_rows($result)!=0){ 
		$no=1;
  		while($row = mysql_fetch_array($result)){ 
  		$unit = unitinfo($row['unit_idunit']);
  		$kavling = $unit['kavling'];
  		$sektor = $unit['sektor_idsektor'];
  		
  		$payment=unitmstpaymentinfo($row['unitmstpayment_idpayment']);
	   $paymentdesc = $payment['paymentdesc'];
   		
  		?>		 
       <tr> 
 <td><? echo $row['unit_idunit'];?></td>
  <td><? echo $sektor;?></td>
 <td><? echo $kavling;?></td>
 
 <td><? echo $row['unitmstpayment_idpayment'];?></td>
 <td><? echo $paymentdesc;?></td>

<td class="right"><? echo nf($row['value']);?></td>

<td><? echo gettanggal($row['createdate']);?></td>
<td><? echo gettanggal($row['duedate']);?></td>
<td><? echo gettanggal($row['paydate']);?></td>


<td><? echo $row['custpayhdr_idcustpayhdr'];?></td>
 
      
       </tr> 
  		<? $no++;} //end while ?> 
		 <tr id="nav"><td colspan="10"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="10"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
	</form>
