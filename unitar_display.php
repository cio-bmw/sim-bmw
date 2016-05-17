 <script type="text/javascript">  
function pagination(page){ 
  var cari = $('input#idunit').val(); 
   var vdsp = $("select#dsp").val(); 

   
  dataString = 'starting='+page+'&idunit='+cari+'&dsp='+vdsp+'&random='+Math.random(); 

  $.ajax({ 
    url:"unitar_display.php", 
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
    url: "unitar_display.php", //file tempat pemrosesan permintaan (request) 
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
   
$("a.bayar").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	});    
   
$("a.sdhbayar").click(function(){ 
alert('Tagihan Sudah Di bayar ');
return false; 
});    
      
   
   
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
$dsp = $_GET['dsp']; 
$unit_idunit = $_GET['idunit']; 
$sql = "select * from unitar where unit_idunit ='$unit_idunit' order by duedate"; 

//echo $sql;
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = $dsp;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?>
<p class="judul">Daftar Piutang Customer</p>	 
 <table  class="grid" id="unitar"> 
<form id="ar">

</td> </tr>  
  
  <tr> 
 <th>No</th>
 <th>Kode</th>
  <th>Keterangan</th>
 <th>Jumlah</th>
<th>Jatuh Tempo</th>
<th>Di Bayar</th>
<th>Nama Kwitansi</th>
<th>No Dok</th>
<th>Jumlah</th>
<th>Catatan</th>
<th>Transfer</th>


<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitar 
		if(mysql_num_rows($result)!=0){ 
		$no=$starting+1; $total=0; 
  		while($row = mysql_fetch_array($result)){ 
  	$payment=unitmstpaymentinfo($row['unitmstpayment_idpayment']);
	$paymentdesc = $payment['paymentdesc'];
   		
   $unitarpayment = unitarpaymentinfo($row['idunitar']);
   $paydate = $unitarpayment['pay_date'];
   $payname = $unitarpayment['pay_name'];
   $paydoc = $unitarpayment['idunitarpayment'];
   $payvalue = $unitarpayment['pay_value'];
   
	$catatan = $unitarpayment['pay_note'];
$transfer = $unitarpayment['transfer'];
	
   
   		
  		?>		 
       <tr> 
 <td><? echo $no;?></td>
 <td><? echo $row['unitmstpayment_idpayment'];?></td>
 <td><? echo $paymentdesc;?></td>

<td class="right"><? echo nf($row['value']);?></td>
<td><? echo gettanggal($row['duedate']);?></td>
<td><? echo gettanggal($paydate);?></td>
<td><? echo $payname;?></td>
<td><? echo $paydoc;?></td>
<td class="right" ><? echo nf($payvalue);?></td>
<td class="right" ><? echo $catatan;?></td>
<td class="right" ><? echo $transfer;?></td>
        <td width="170px">
 <? if ($paydoc =='') { ?>         
        <a href="unitarpayment_form.php?idunit=<? echo $row['unit_idunit'];?>&id=<? echo $row['idunitar'];?>" class="bayar"> 
        <input type="button" class="button" value="Bayar"></a>   
       | <a href="unitar_form.php?action=update&id=<? echo $row['idunitar'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unitar_process.php?action=delete&id=<? echo $row['idunitar'];?>" class="delete"><input type="button" class="button" value="Delete"></a>
        
        
<?  } else { ?>
        <a href="unitarpayment_form.php?idunit=<? echo $row['unit_idunit'];?>&id=<? echo $row['idunitar'];?>" class="sdhbayar"> 
        <input type="button" class="button" value="Bayar"></a>   
       | <a href="unitar_form.php?action=update&id=<? echo $row['idunitar'];?>" class="sdhbayar"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unitar_process.php?action=delete&id=<? echo $row['idunitar'];?>" class="sdhbayar"><input type="button" class="button" value="Delete"></a>

<? } ?>
  
       
       </td></tr> 
  		<? $no++;
      $total = $total + $row['value'];		
      $totalbayar = $totalbayar + $payvalue;
  		}
      $sisa = $total - $totalbayar;  		
  		
  		 //end while ?> 
  		
		 <tr><td colspan="2"></td><td>Total</td><td class="right"><?php echo nf($total); ?></td><td class="right" colspan="4">Total Bayar</td><td class="right"><? echo nf($totalbayar); ?></td><td></td></tr> 
 		
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?><td colspan="3" class="right">Sisa Piutang</td><td class="right"><? echo nf($sisa); ?></td><td></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="8">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
	</form>
