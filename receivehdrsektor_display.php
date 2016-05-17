 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data receivehdrsektor sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var dataString; 
   var dataString; 
	  var vsektor = $("select#idsektor").val(); 
     var vsupp = $("select#idsupp").val();
	  var vstartdate = $("input#startdate").val(); 
     var venddate = $("input#enddate").val(); 
     var vdsp = $("select#dsp").val();
	 	 
	  dataString =  'starting='+page+'&random='+Math.random()+'&sektor='+vsektor+'&supp='+vsupp+'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp;

   
	
   
  $.ajax({ 
    url:"receivehdrsektor_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receivehdrsektor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
   var dataString; 
	  var vsektor = $("select#idsektor").val(); 
     var vsupp = $("select#idsupp").val();
	  var vstartdate = $("input#startdate").val(); 
     var venddate = $("input#enddate").val(); 
     var vdsp = $("select#dsp").val();
	 	 
	  dataString =  'sektor='+vsektor+'&supp='+vsupp+'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp;

 
  $.ajax({ 
    url: "receivehdrsektor_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receivehdrsektor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receivehdrsektor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	$("a.noaction").click(function(){ 
		alert('Data sudah di confirm tidak bisa di rubah');
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data receivehdrsektor ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("receivehdrsektor_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data receivehdrsektor berhasil di hapus!"); 
					} 
					else{ 
						alert("Data penerimaan Barang tidak bisa di hapus masih ada data detailnya!"); 
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
$idsupp = $_GET['supp']; 
$idsektor = $_GET['sektor'];
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);

if ($idsektor == '%') {
$sql = "select * from receivehdrsektor where supplier_idsupp like '%$idsupp%' and  rcv_date between '$startdate' and '$enddate' order by idreceivehdr desc"; 
} else {
$sql = "select * from receivehdrsektor where supplier_idsupp like '%$idsupp%' and sektor_Idsektor = '$idsektor' and rcv_date between '$startdate' and '$enddate' order by idreceivehdr desc"; 
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
<p class="judul">Penerimaan Barang di Sektor</p>	 
  <table class="grid" id="receivehdrsektor"> 
  <tr> 
 <th>No Dok</th>
<th>Supplier</th>
<th>Sektor</th>
<th>Tgl Terima</th>
<th>Status</th>
<th>Total Harga</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receivehdrsektor 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
$supplier = supplierinfo($row['supplier_idsupp']);
$suppname=$supplier['suppname'];

$sektor = sektorinfo($row['sektor_idsektor']);
$sektorname = $sektor['sektorname'];  			

$sql2="SELECT sum(receive_price * qty) vreceive FROM receivedtlsektor  
where receivehdrsektor_idreceivehdr ='".$row['idreceivehdr']."'";
$data2  = mysql_fetch_array(mysql_query($sql2));  
$mrcv = $data2[0];	


  			 ?>		 
       <tr> 
 <td><? echo $row['idreceivehdr'];?></td>
<td><? echo $suppname;?></td>
<td><? echo $sektorname;?></td>
<td><? echo gettanggal($row['rcv_date']);?></td>
<td><? echo $row['rcv_status'];?></td>

<td class="right"><? echo nf($mrcv);?></td>


 
        <td width=170px>
         <a href="receivedtlsektor.php?action=update&id=<? echo $row['idreceivehdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
   
          <? if ($row['rcv_status'] =="confirm") { ?>
            | <a href="receivehdrsektor_form.php?action=update&id=<? echo $row['idreceivehdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="receivehdrsektor_process.php?action=delete&id=<? echo $row['idreceivehdr'];?>" class="noaction"><input type="button" class="button" value="Delete"></a>
        <? } else { ?>
       | <a href="receivehdrsektor_form.php?action=update&id=<? echo $row['idreceivehdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="receivehdrsektor_process.php?action=delete&id=<? echo $row['idreceivehdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a>
 
          <? 
          
          } ?>  
       </td></tr> 


  		<?  
$total = $total + $mrcv;          


} //end while ?> 
  		<tr><td colspan="5">Total</td><td class="right" ><? echo nf($total); ?></td><td></td></tr>
		 <tr id="nav"><td colspan="9"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="9"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="9">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
