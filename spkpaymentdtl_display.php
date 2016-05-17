 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data spkpaymentdtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var dataString; 
	  var vsektor = $("select#idsektor").val();
	  var vstartdate = $("input#startdate").val(); 
     var venddate = $("input#enddate").val(); 
     var vdsp = $("select#dsp").val(); 

    dataString = 'starting='+page+'&sektor='+vsektor+'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"spkpaymentdtl_display.php", 
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
	  var vsektor = $("select#idsektor").val();
	  var vstartdate = $("input#startdate").val(); 
     var venddate = $("input#enddate").val(); 
     var vdsp = $("select#dsp").val();
     
      dataString = 'sektor='+vsektor+'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp;
 
  
  $.ajax({ 
    url: "spkpaymentdtl_display.php", //file tempat pemrosesan permintaan (request) 
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
$idsektor = $_GET['sektor'];
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
$dsp = $_GET['dsp'];


if  ($idsektor=='%') {
 $sql = "select * from spkpaymentdtl a,spkpaymenthdr b, unitspk c  where a.spkpaymenthdr_idspkpaymenthdr = b.idspkpaymenthdr and
 unitspk_idunitspk = c.idunitspk  and b.paydate between '$startdate' and '$enddate' "; 
} else {
$sql = "select * from spkpaymentdtl a,spkpaymenthdr b, unitspk c,unit d  where a.spkpaymenthdr_idspkpaymenthdr = b.idspkpaymenthdr and
 unitspk_idunitspk = c.idunitspk  and c.unit_idunit = d.idunit and d.sektor_idsektor = '$idsektor'  and b.paydate between '$startdate' and '$enddate' ";  
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
	 <p class="judul">Daftar SPK Yang DiBayar</p> 
  <table id="spkpaymentdtl"> 
  <tr> 
 <th>No</th>
<th>No SPK</th>
<th>Kategori SPK</th>
<th>Sektor</th>

<th>Unit/Kavling</th>

<th>Jumlah</th>


  </tr> 
		<?php 
		//menampilkan data spkpaymentdtl 
		if(mysql_num_rows($result)!=0){ $no=$starting+1; $total=0;
  		while($row = mysql_fetch_array($result)){ 
      $unitspk = unitspkinfo($row['unitspk_idunitspk']);  	

      $unit = unitinfo($unitspk['unit_idunit']);
      $kavling = $unit['kavling'];  	
  
     $idsektor = $unit['sektor_idsektor'];
      $sektor= sektorinfo($idsektor);
      $sektorname = $sektor['sektorname'];
                   
      
      
      $spkcat = spkcatinfo($unitspk['spkcat_idspkcat']);
      $category = $spkcat['category'];        				
  		
  		?>		 
       <tr> 
 <td><? echo $no;?></td>
<td><? echo $row['unitspk_idunitspk'];?></td>
<td><? echo $category;?></td>
<td><? echo $sektorname;?></td>

<td><? echo $kavling;?></td>

<td class="right"><? echo nf($row['payvalue']);?></td>
 
 
       </tr> 
  		<?  $no++;
          $total= $total+$row['payvalue'];    		
  		
  		} //end while ?> 
		 <tr><td colspan="5">Total</td><td class="right"><?php echo nf($total);?></td></tr> 
 		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
