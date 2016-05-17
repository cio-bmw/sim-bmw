 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data spkpaymenthdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
var dataString; 
	  var vdsp = $("select#dsp").val();
	  var idcont = $("select#idcontractor").val();
	  var vstartdate = $("input#startdate").val(); 
     var venddate = $("input#enddate").val(); 
   
      dataString = 'starting='+page+'&idcontractor='+ idcont +'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp;
     
   $.ajax({ 
     url: "spkpaymenthdr_display.php", 
     type: "GET", 
     data: dataString, 
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
 		} 
   }); 
 } 
 
// fungsi untuk me-load tampilan list data spkpaymenthdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vdsp = $("select#dsp").val();
    var idcont = $("select#idcontractor").val();
	  var vstartdate = $("input#startdate").val(); 
     var venddate = $("input#enddate").val(); 
   
      dataString = 'idcontractor='+ idcont +'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp;
   
 
  $.ajax({ 
    url: "spkpaymenthdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#spkpaymenthdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#spkpaymenthdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		return false; 
	}); 
	 
	$("a.detail").click(function(){ 
	window.location='spkpaymenthdr_detail.php?id= $row["idspkpaymenthdr"]'; 
	}); 

	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data spkpaymenthdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("spkpaymenthdr_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data spkpaymenthdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data spkpaymenthdr gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 
	
$("#btncetak").click(function(){	
		window.open("spkpaymenthdr_pdf.php?cont="+$("select#idcontractor").val()+"&start="+$("input#startdate").val()+"&end="+$("input#enddate").val(), "_blank");

});

$("#btncetakrekap").click(function(){	
		window.open("spkpaymenthdr_pdfrekap.php?cont="+$("select#idcontractor").val()+"&start="+$("input#startdate").val()+"&end="+$("input#enddate").val(), "_blank");

});
	 
}); 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$idcontractor = $_GET['idcontractor'];
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
$dsp = $_GET['dsp'];

if ($idcontractor == '%') { 
$sql = "select * from spkpaymenthdr where paydate between '$startdate' and '$enddate' order by idspkpaymenthdr "; 
} else {
$sql = "select * from spkpaymenthdr where contractor_idcontractor = '$idcontractor' and paydate between '$startdate' and '$enddate' order by idspkpaymenthdr "; 
}	

if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = $_GET['dsp'];//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
<p class="judul">Data Pembayaran Kontraktor 
<input type="button" class="button" id="btncetak" value="Cetak Data Pembayaran" >
<input type="button" class="button" id="btncetakrekap" value="Cetak Rekap Pembayaran" >

</p>	 

  <table id="spkpaymenthdr"> 
  <tr> 
 <th>No</th>
 <th>No Dok</th>
<th>Tanggal</th>
<th>Contractor</th>
<th>Jumlah</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data spkpaymenthdr 
		if(mysql_num_rows($result)!=0){ $no=1;
  		while($row = mysql_fetch_array($result)){
      $contractor = contractorinfo($row['contractor_idcontractor']);  			
      $contractorname = $contractor['contractorname'];    			
      
      $sql1 = "select sum(payvalue) jumlah from spkpaymentdtl where spkpaymenthdr_idspkpaymenthdr = '".$row['idspkpaymenthdr']."'"; 
      $result1 = mysql_query($sql1);
     $data1 = mysql_fetch_array($result1);
      $jumlah = $data1[0];
  			
  			 ?>		 
       <tr> 
 <td><? echo $no;?></td>
 <td><? echo $row['idspkpaymenthdr'];?></td>
<td><? echo gettanggal($row['paydate']);?></td>
<td><? echo $contractorname;?></td>
 <td class="right"><? echo nf($jumlah);?></td>

        <td width="160px">
        <a href="spkpaymenthdr_detail.php?action=detail&id=<? echo $row['idspkpaymenthdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
        <a href="spkpaymenthdr_form.php?action=update&id=<? echo $row['idspkpaymenthdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="spkpaymenthdr_process.php?action=delete&id=<? echo $row['idspkpaymenthdr'];?>" class="delete"><input type="button" class="button" value="Delete"> </a>
       
       </td></tr> 
  		<?    
$totjumlah = $totjumlah + $jumlah; 		
$no++;  		
  		} //end while ?> 
  		<tr><td colspan="4">Jumlah</td><td><? echo nf($totjumlah);  ?></td></tr>
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
