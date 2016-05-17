 <script type="text/javascript">  
function pagination(page){ 
  var dataString; 
  var vduedate = $("input#duedate").val(); 
  var vsektor = $("select#sektor_idsektor").val(); 
  var vdsp = $("select#dsp").val(); 

   
  dataString = 'starting='+page+'&sektor='+vsektor+'&duedate='+vduedate+'&dsp='+vdsp; 
   
  $.ajax({ 
    url:"unitar_rekapdisplay.php", 
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
  var vdsp = $("select#dsp").val(); 

   
   dataString = 'starting='+page+'&sektor='+vsektor+'&duedate='+vduedate+'&dsp='+vdsp; 
 
  $.ajax({ 
    url: "unitar_rekapdisplay.php", //file tempat pemrosesan permintaan (request) 
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
	   page="unitar_rekapdisplay.php?idunit=301"; 
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
 $total = 0;
$sektor = $_GET['sektor']; 
$duedate = settanggal($_GET['duedate']);
$dsp = $_GET['dsp'];

if ($sektor=='%') {
$sql = "select unit_idunit, sum(value) jumlah from unitar a, unit b where a.unit_idunit = b.idunit 
and a.duedate < '$duedate' group by unit_idunit"; 
} else {
$sql = "select unit_idunit, sum(value) jumlah from unitar a, unit b where a.unit_idunit = b.idunit 
and b.sektor_idsektor = '$sektor' and a.duedate < '$duedate' group by unit_idunit "; 
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
<p class="judul">Daftar Piutang Jatuh Tempo</p>	 
  <table  class="grid" id="unitar"> 
 
  <tr> 
   <th>Sektor</th>
 <th>Kavling</th>
  <th>Owner</th>
 <th>Total Piutang</th>
  <th>Total Bayar</th>
    <th>Sisa</th>
  </tr> 
		<?php 
		//menampilkan data unitar 
		if(mysql_num_rows($result)!=0){ 
		$no=1; 
  		while($row = mysql_fetch_array($result)){ 
  		$unit = unitinfo($row['unit_idunit']);
  		$kavling = $unit['kavling'];
  		$owner = $unit['owner'];
  		$sektor = $unit['sektor_idsektor'];
  		$idunit = $row['unit_idunit'];
  		
  	
$sektorinfo =sektorinfo($sektor);
$sektorname = $sektorinfo['sektorname']; 


      $sql2 = "select sum(pay_value) bayar from unitarpayment where unit_idunit = '$idunit'";
       $result2 = mysql_query($sql2);  
      $data  = mysql_fetch_array($result2);  
       $bayar = $data[0];	 
   		
$sisa = $row['jumlah']-$bayar;
   		
  		?>		 
       <tr> 
 <td><? echo $sektorname;?></td>
   <td><? echo $kavling;?></td>
   <td><? echo $owner;?></td>
  <td class="right"><? echo nf($row['jumlah']);?></td>
 <td class="right"><? echo nf($bayar);?></td>
 <td class="right"><? echo nf($sisa);?></td>
    
       </tr> 
  		<? $no++;
  		$total = $total + $row['jumlah'];
  		$totbayar = $totbayar + $bayar;
  		$totsisa = $totsisa +$sisa;
  		} //end while ?> 
  		
  		<tr><td colspan="3">Total</td><td class="right"><? echo nf($total); ?></td><td class="right"><? echo nf($totbayar); ?></td><td class="right"><? echo nf($totsisa); ?></td></tr>
			 <tr id="nav"><td colspan="10"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="10"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
	</form>
