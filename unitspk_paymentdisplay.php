 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unitspk sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var vsektor = $("select#sektor_idsektor").val(); 
  var vspkcat = $("select#idspkcat").val(); 
  var vunit = $("select#idunit").val(); 
   var vcont = $("select#idcontractor").val(); 
   var vdsp = $("select#dsp").val(); 
  var vsisa = $("input#sisa").val();
  
   
	  
  dataString = 'starting='+page+'&dsp='+vdsp+ '&sektor='+vsektor+'&spkcat='+vspkcat+'&cont='+vcont+'&sisa='+vsisa+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"unitspk_paymentdisplay.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitspk, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vsektor = $("select#sektor_idsektor").val(); 
  var vcont = $("select#idcontractor").val(); 
  var vdsp = $("select#dsp").val();
  var vsisa = $("input#sisa").val();
   
	dataString =  'dsp='+vdsp+'&sektor='+vsektor+'&cont='+vcont+'&unit='+vunit+'&sisa='+vsisa; 
   
  $.ajax({ 
    url: "unitspk_paymentdisplay.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitspk tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitspk tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	
	$("a.detail").click(function(){ 
	window.location='unitspk_detail.php?id= $row["idunitspk"]'; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data unitspk ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("unitspk_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data unitspk berhasil di hapus!"); 
					} 
					else{ 
						alert("data unitspk gagal di hapus!"); 
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
$sektor = $_GET['sektor'];
$idcontractor = $_GET['cont'];
$idunit = $_GET ['unit'];
$dsp = $_GET['dsp'];
$vsisa = $_GET['sisa'];

if ($sektor == '%') {

if ($idcontractor=='%') {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit 
and unit_idunit like '%".$idunit."%'
order by idunitspk desc "; 
}
else {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
a.contractor_idcontractor = '".$idcontractor."' 
and unit_idunit like '%".$idunit."%'
order by idunitspk desc "; 
}

} else { 

if ($idcontractor=='%') {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
b.sektor_idsektor = '$sektor' and unit_idunit like '%".$idunit."%'
order by idunitspk desc "; 


} else {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
b.sektor_idsektor = '$sektor' and a.contractor_idcontractor = '".$idcontractor."' 
and unit_idunit like '%".$idunit."%'
order by idunitspk desc "; 
}


}


 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = $dsp;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
<p class="judul">Rekap Pembayaran Surat Perintah Kerja (SPK) <? echo $vsisa; ?> </p>	 
  <table id="unitspk" class="grid">  
  <tr> 
 <th>No SPK</th>
<th>Tanggal</th>
<th>Kategori SPK</th>
<th>Sektor</th>
<th>Kavling</th> 
<th>contractor</th>
<th>Nilai SPK</th>
<th>BON</th>
<th>Sisa</th>
<th>(%)</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitspk 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
    
      $unit = unitinfo($row['unit_idunit']);
      $kavling = $unit['kavling'];  	
      
      	
      $sektor = sektorinfo($unit['sektor_idsektor']);
   	$sektorname = $sektor['sektorname'];
  
      $spkcat = spkcatinfo($row['spkcat_idspkcat']);
      $category = $spkcat['category'];      
      
      $contractor = contractorinfo($row['cont']);
      $contractorname = $contractor['contractorname'];
      
       $sql1 = "select ifnull(sum(payvalue),0) jumlah from spkpaymentdtl where unitspk_idunitspk = '".$row['idunitspk']."'"; 
      $result1 = mysql_query($sql1);
      $data1 = mysql_fetch_array($result1);
      $pembayaran = $data1[0];
      $sisa = $row['spkvalue'] - $pembayaran;      	

      if ($row['spkvalue'] != 0  ) {       
      $pct = $pembayaran/$row['spkvalue']*100;
      } else {$pct = 0; }


if ($vsisa == 'all') {
?>
 <tr> 
 <td><? echo $row['idunitspk'];?></td>
<td><? echo gettanggal($row['spkdate']);?></td>
<td><? echo $category;?></td>
<td><? echo $sektorname;?></td>
<td><? echo $kavling;?></td>
<td><? echo $contractorname;?></td>
<td class="right"><? echo nf($row['spkvalue']);?></td>
<td class="right"><? echo nf($pembayaran);?></td>
<td class="right"><? echo nf($sisa);?></td>
<td class="right"><? echo nf($pct);?></td>


 
        <td width="160px">
                <a href="unitspk_rekappaymentdetail.php?action=update&id=<? echo $row['idunitspk'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>  
        <a href="unitspk_form.php?action=update&id=<? echo $row['idunitspk'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unitspk_process.php?action=delete&id=<? echo $row['idunitspk'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
<?   	
}	else {      

if ($sisa > 0) {
  			 ?>		 
       <tr> 
 <td><? echo $row['idunitspk'];?></td>
<td><? echo gettanggal($row['spkdate']);?></td>
<td><? echo $category;?></td>
<td><? echo $sektorname;?></td>
<td><? echo $kavling;?></td>
<td><? echo $contractorname;?></td>
<td class="right"><? echo nf($row['spkvalue']);?></td>
<td class="right"><? echo nf($pembayaran);?></td>
<td class="right"><? echo nf($sisa);?></td>
<td class="right"><? echo nf($pct);?></td>


 
        <td width="160px">
                <a href="unitspk_rekappaymentdetail.php?action=update&id=<? echo $row['idunitspk'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>  
        <a href="unitspk_form.php?action=update&id=<? echo $row['idunitspk'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unitspk_process.php?action=delete&id=<? echo $row['idunitspk'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?    

}
}       
       $totalspk = $totalspk + $row['spkvalue'];
       $totalbon = $totalbon + $pembayaran;
       $totalsisa = $totalsisa + $sisa;  		
   		
  		} //end while ?> 
  		<tr><td colspan="6">Total </td><td class="right"><? echo nf($totalspk); ?></td><td class="right"><? echo nf($totalbon); ?></td><td class="right"><? echo nf($totalsisa); ?></td></tr>
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
