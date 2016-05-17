 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unitspk sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var vsektor = $("select#idsektor").val(); 
  var vspkcat = $("select#idspkcat").val(); 
  var vunit = $("select#idunit").val(); 
  var vdsp = $("select#dsp").val();
  
   
	  
  dataString = 'starting='+page+'&dsp='+vdsp+'&sektor='+vsektor+'&spkcat='+vspkcat+'&unit='+vunit+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"unitspk_display.php", 
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
  var vsektor = $("select#idsektor").val(); 
  var vspkcat = $("select#idspkcat").val(); 
    var vunit = $("select#idunit").val(); 
    var vtgl = $("input#spkdate").val(); 
            var vcont = $("select#idcontractor").val(); 
    var vdsp = $("select#dsp").val();
   
	dataString = 'sektor='+vsektor+'&spkcat='+vspkcat+'&unit='+vunit+'&idcont='+vcont+'&dsp='+vdsp; 
   
  $.ajax({ 
    url: "unitspk_display.php", //file tempat pemrosesan permintaan (request) 
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
	window.location=$(this).attr("href"); 
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
$idcont = $_GET['idcont'];
$sektor = $_GET['sektor'];
$spkcat = $_GET['spkcat'];
$unit = $_GET['unit'];
$tanggal = settanggal($_GET['tgl']); 
$dsp = $_GET['dsp'];


if ($idcont =='%') {

if ($_GET['tgl'] =='') {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
b.sektor_idsektor like '%".$sektor."%' and spkcat_idspkcat like '%".$spkcat."%' 
and unit_idunit like '%".$unit."%' order by idunitspk desc "; 
} else {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
b.sektor_idsektor like '%".$sektor."%' and spkcat_idspkcat like '%".$spkcat."%' 
and unit_idunit like '%".$unit."%' and spkdate ='$tanggal'  order by idunitspk desc "; 
}
} else {

if ($_GET['tgl'] =='') {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
b.sektor_idsektor like '%".$sektor."%' and spkcat_idspkcat like '%".$spkcat."%' 
and unit_idunit like '%".$unit."%' and a.contractor_idcontractor = ".$idcont." order by idunitspk desc "; 
} else {
$sql = "select *,a.contractor_idcontractor cont from unitspk a, unit b where a.unit_idunit = b.idunit and 
b.sektor_idsektor like '%".$sektor."%' and spkcat_idspkcat like '%".$spkcat."%' 
and unit_idunit like '%".$unit."%' and spkdate ='$tanggal'  and a.contractor_idcontractor = ".$idcont." order by idunitspk desc "; 
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
<p class="judul">Daftar Surat Perintah Kerja (SPK)</p>	 
  <table id="unitspk">  
  <tr> 
 <th>No SPK</th>
<th>Tanggal</th>
<th>Kategori SPK</th>
<th>Sektor</th>
<th>Kavling</th>
<th>contractor</th>
<th>Nilai</th>
<th>Bayar</th>
<th>Sisa</th>
<th>%</th>
<th>Progres(%)</th>

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
      
       $sql1 = "select sum(payvalue) jumlah from spkpaymentdtl where unitspk_idunitspk = '".$row['idunitspk']."'"; 
      $result1 = mysql_query($sql1);
      $data1 = mysql_fetch_array($result1);
      $pembayaran = $data1[0];
      $sisa = $row['spkvalue'] - $pembayaran;  
      
      if($row['spkvalue']== 0) {
      $pctspk =0;	
      } else {	    	
      $pctspk = $pembayaran/$row['spkvalue']*100;
      }
  
       $sql2 = "select sum(bobotpct*progress)/100 pct from unitclbangun where unitspk_idunitspk = '".$row['idunitspk']."'"; 
      $result2 = mysql_query($sql2);
      $data2 = mysql_fetch_array($result2);
      $pctprogress = $data2[0];
         
      
      
  			 ?>		 
       <tr> 
 <td><? echo $row['idunitspk'];?></td>
<td><? echo gettanggal($row['spkdate']);?></td>
<td><? echo $category;?></td>
<td><? echo $sektorname;?></td>
<td><? echo $kavling;?></td>
<td><? echo $contractorname;?></td>
<? if ($pctspk > 100) { ?>
<td class="right" bgcolor="#FF2200"><? echo nf($row['spkvalue']);?></td>
<td class="right" bgcolor="#FF2200"><? echo nf($pembayaran);?></td>
<td class="right" bgcolor="#FF2200"><? echo nf($sisa);?></td>
 <td class="right" bgcolor="#FF2200"><? echo nf($pctspk);?></td>

<? } else if ($pctspk == 100) { ?>
<td class="right" bgcolor="#3F79C4"><? echo nf($row['spkvalue']);?></td>
<td class="right" bgcolor="#3F79C4"><? echo nf($pembayaran);?></td>
<td class="right" bgcolor="#3F79C4"><? echo nf($sisa);?></td>
 <td class="right" bgcolor="#3F79C4"><? echo nf($pctspk);?></td>
<? } else if ($pctspk > 50 )   { ?>
<td class="right" bgcolor="yellow"><? echo nf($row['spkvalue']);?></td>
<td class="right" bgcolor="yellow"><? echo nf($pembayaran);?></td>
<td class="right" bgcolor="yellow"><? echo nf($sisa);?></td>
<td class="right" bgcolor="yellow"><? echo nf($pctspk);?></td>
<? }  else {?>
<td class="right" ><? echo nf($row['spkvalue']);?></td>
<td class="right" ><? echo nf($pembayaran);?></td>
<td class="right" ><? echo nf($sisa);?></td>
<td class="right"><? echo nf($pctspk);?></td>
<? } ?> 
 
 
 <td class="right"><? echo nf($pctprogress);?></td>
 
        <td>
        <a href="unitspk_detail.php?action=detail&id=<? echo $row['idunitspk'];?>" class="detail"> <input type="button" class="button" value="Progres"></a>  
        <a href="unitspk_form.php?action=update&id=<? echo $row['idunitspk'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unitspk_process.php?action=delete&id=<? echo $row['idunitspk'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
