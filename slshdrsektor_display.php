 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data slshdrsektor sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
	 var vsektor = $("select#idsektor").val();
	  var vstartdate = $("input#startdate").val(); 
     var venddate = $("input#enddate").val(); 
       var vdsp = $("select#dsp").val();
	 
   
      dataString = 'starting='+page+'&sektor='+vsektor+'&startdate='+vstartdate+'&enddate='+venddate+'&dsp='+vdsp+'&random='+Math.random(); 
 
	   
   
  $.ajax({ 
    url:"slshdrsektor_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data slshdrsektor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idslshdr"){ 
      dataString = 'idslshdr='+ cari;  
   } 
   else if (combo == "sls_date"){ 
      dataString = 'sls_date='+ cari; 
    } 
   else if (combo == "sls_bon"){ 
      dataString = 'sls_bon='+ cari; 
    } 
   else if (combo == "sls_titip"){ 
      dataString = 'sls_titip='+ cari; 
    } 
   else if (combo == "due_date"){ 
      dataString = 'due_date='+ cari; 
    } 
   else if (combo == "sls_blj"){ 
      dataString = 'sls_blj='+ cari; 
    } 
   else if (combo == "sls_tambahan"){ 
      dataString = 'sls_tambahan='+ cari; 
    } 
   else if (combo == "sls_total"){ 
      dataString = 'sls_total='+ cari; 
    } 
   else if (combo == "sls_bayar"){ 
      dataString = 'sls_bayar='+ cari; 
    } 
   else if (combo == "sls_kembali"){ 
      dataString = 'sls_kembali='+ cari; 
    } 
   else if (combo == "sls_desc"){ 
      dataString = 'sls_desc='+ cari; 
    } 
   else if (combo == "payment_date"){ 
      dataString = 'payment_date='+ cari; 
    } 
   else if (combo == "sls_status"){ 
      dataString = 'sls_status='+ cari; 
    } 
   else if (combo == "sls_diskon"){ 
      dataString = 'sls_diskon='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
  $.ajax({ 
    url: "slshdrsektor_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#slshdrsektor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#slshdrsektor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	
	$("a.process").click(function(){ 
		window.location='slsdtlsektor.php?id= $row["idrjhdrs"]'; 
	}); 
	
	$("a.noaction").click(function(){ 
		alert('Data sudah di confirm tidak bisa di rubah');
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data Pengeluaran ke sekktor ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("slshdrsektor_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data pengeluaran ke sektor berhasil di hapus!"); 
					} 
					else{ 
						alert("Data tidak bisa di hapus ! masih ada data detail nya!!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 
	 
}); 
$("#btndetail").click(function(){ 
		window.location='slsdtlsektor.php?id= $row["idrjhdrs"]'; 
		return false; 
	}); 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 

$idsektor = $_GET['sektor'];
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
$dsp = $_GET['dsp'] ? : 15;

if ($idsektor == '%') {
$sql = "select * from slshdrsektor where sls_date between '$startdate' and '$enddate'   order by idslshdr desc"; 
} else {
$sql = "select * from slshdrsektor where sektor_idsektor = '$idsektor' and sls_date between '$startdate' and '$enddate'   order by idslshdr desc"; 
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
	   <p class="judul">Pengeluaran Barang Ke Sektor</p>
  <table class="grid" id="slshdrsektor"> 
  <tr> 
 <th>No</th>
<th>Tanggal</th>
<th>Kode</th>
<th>Nama Sektor</th>
<th>Total</th>
<th>Status</th>
<th>Keterangan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data slshdrsektor 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  			$sektor = sektorinfo($row['sektor_idsektor']);
  			$sektorname = $sektor['sektorname'];

$sql1 = "SELECT IFNULL(sum(qty*sales_price),0)  FROM slsdtlsektor where slshdrsektor_idslshdr ='".$row['idslshdr']."'";
$result1 = mysql_query($sql1);
$data  = mysql_fetch_array($result1);
$total = $data[0] 			
  			
  			 ?>		 
       <tr> 
 <td  width="40px"><? echo $row['idslshdr'];?></td>
<td width="50px"><? echo gettanggal($row['sls_date']);?></td>
<td  width="50px"><? echo $row['sektor_idsektor'];?></td>
<td><? echo $sektorname;?></td>
<td class="right"><? echo nf($total);?></td>
 <td  width="40px"><? echo $row['sls_status'];?></td>
<td><? echo $row['sls_desc'];?></td>

 
        <td width="175px">
        <a href="slsdtlsektor.php?action=detail&id=<? echo $row['idslshdr'];?>" class="process"> <input type="button" class="button" value="Detail"></a>
        
       <? if ($row['sls_status'] =="open") { ?>
       | <a href="slshdrsektor_form.php?action=update&id=<? echo $row['idslshdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="slshdrsektor_process.php?action=delete&id=<? echo $row['idslshdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a>
        <? } else { ?>
       | <a href="slshdrsektor_form.php?action=update&id=<? echo $row['idslshdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="slshdrsektor_process.php?action=delete&id=<? echo $row['idslshdr'];?>" class="noaction"><input type="button" class="button" value="Delete"></a>
     
        <? } ?>        
       
       </td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
