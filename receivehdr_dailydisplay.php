 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data receivehdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
 var dataString; 
  var vidsupp = $("select#idsupp").val(); 
  var vstartdate = $("input#startdate").val(); 
  var venddate = $("input#enddate").val(); 
  var vdsp = $("select#dsp").val();
	 
   
 dataString = 'starting='+page+'&idsupp='+vidsupp+'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp+'&random='+Math.random(); 

   
  $.ajax({ 
    url:"receivehdr_dailydisplay.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receivehdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vidsupp = $("select#idsupp").val(); 
  var vstartdate = $("input#startdate").val(); 
  var venddate = $("input#enddate").val(); 
    var vdsp = $("select#dsp").val();
	 
   
 dataString = 'idsupp='+vidsupp+'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp;

   
  $.ajax({ 
    url: "receivehdr_dailydisplay.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receivehdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receivehdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
	
   $("a.process").click(function(){ 
		window.location='receivedtl.php?id= $row["idreceivehdr"]'; 
	}); 	 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data receivehdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("receivehdr_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data receivehdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data receivehdr gagal di hapus!"); 
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
$idsupp = $_GET['idsupp'];
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
$dsp = $_GET['dsp'];

$sql = "select * from receivehdr where supplier_idsupp like '%$idsupp%' and rcv_date between '$startdate' and '$enddate' order by supplier_idsupp,idreceivehdr"; 

//echo $sql; 
//$sql = "select * from receivehdr where supplier_idsupp like '%$idsupp%'"; 
  
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = $dsp;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="receivehdr"> 
  <tr> 
 <th>No Dok </th>
<th>Kode</th>
<th>Nama Supplier</th>

<th>Tgl Terima</th>
<th>Jatuh Tempo</th>
<th>Faktur</th>

<th>Keterangan</th>
<th>Status</th>
<th>Total Harga</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receivehdr 
		if(mysql_num_rows($result)!=0){ $alltotal =0;
  		while($row = mysql_fetch_array($result)){
$supplier = supplierinfo($row['supplier_idsupp']) ; 

$sql2="SELECT sum(receive_price * qty) vreceive FROM receivedtl  
where receivehdr_idreceivehdr ='".$row['idreceivehdr']."'";
$data2  = mysql_fetch_array(mysql_query($sql2));  
$mrcv = $data2[0];	

			
 ?>		 
 <tr> 
 <td><? echo $row['idreceivehdr'];?></td>
<td><? echo $row['supplier_idsupp'];?></td>
<td><? echo $supplier['suppname'];?></td>

<td><? echo gettanggal($row['rcv_date']);?></td>
<td><? echo gettanggal($row['due_date']);?></td>
<td><? echo $row['faktur'];?></td>
<td><? echo $row['rcv_desc'];?></td>
<td><? echo $row['rcv_status'];?></td>
<td class="right"><? echo nf($mrcv);?></td>
 
        <td>
           <a href="receivedtl.php?action=detail&id=<? echo $row['idreceivehdr'];?>" class="process"> <input type="button" class="button" value="Detail"></a>   
        <? if ($row['rcv_status'] =="open") { ?>     
           | <a href="receivehdr_form.php?action=update&id=<? echo $row['idreceivehdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="receivehdr_process.php?action=delete&id=<? echo $row['idreceivehdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a>
          <? } else { ?>
                | <a href="receivehdr_form.php?action=update&id=<? echo $row['idreceivehdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="receivehdr_process.php?action=delete&id=<? echo $row['idreceivehdr'];?>" class="noaction"><input type="button" class="button" value="Delete"></a>
         <? } ?>  
        </td></tr> 
  		<?  
$alltotal = $alltotal + $mrcv;  		
  		
  		} //end while ?> 
		 <tr id="nav"><td colspan="8"><?php echo $obj->anchors; ?></td><td class="right"><? echo nf($alltotal);?></td></tr> 
	   <tr id="total"><td colspan="10"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="10">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
