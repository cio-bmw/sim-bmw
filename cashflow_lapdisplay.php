 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data gldtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idgldtl"){ 
    dataString = 'starting='+page+'&idgldtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "glhdr_idglhdr"){ 
    dataString = 'starting='+page+'&glhdr_idglhdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Dvalue"){ 
    dataString = 'starting='+page+'&Dvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Kvalue"){ 
    dataString = 'starting='+page+'&Kvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "acc_idacc"){ 
    dataString = 'starting='+page+'&acc_idacc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"cashflow_lapdisplay.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data gldtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idglhdr").val(); 
  var vstartdate = $("input#startdate").val(); 
  var venddate = $("input#enddate").val(); 
	
    dataString = 'comp='+ cari+'&start='+vstartdate+'&end='+venddate; 
 
  $.ajax({ 
    url: "cashflow_lapdisplay.php", //file tempat pemrosesan permintaan (request) 
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
  $('#gldtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#gldtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
 var vstatus = $("input#gl_status").val();	
	
	if  (vstatus == 'posted') {
	alert('Data Sudah Posting tidak bisa di Edit, unposting dulu');	
	return false;
	} else {	
	
		page=$(this).attr("href"); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		return false; 
   }

	}); 
	 
	$("a.detail").click(function(){ 
		window.location=$(this).attr("href"); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
   var vstatus = $("input#gl_status").val();	
	
	if  (vstatus == 'posted') {
	alert('Data Sudah Posting tidak bisa di delete, un posting dulu');	
	return false;
	} else {
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data gldtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("gldtl_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data gldtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data gldtl gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}	
	}); 
	
	
	 
}); 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$comp = $_GET['comp'];
$glhdr_idglhdr = $_GET['id']; 
$start = settanggal($_GET['start']);
$end = settanggal($_GET['end']);


if ($comp=='%') { 
$sql = "select b.company_idcompany,gl_date,acc_idacc,dvalue,kvalue from gldtl a,glhdr b,acc c  where a.glhdr_idglhdr = b.idglhdr 
and a.acc_idacc = c.idacc and c.cfstatus = 'Y'  and gl_date between '$start' and '$end' group by acc_idacc"; 
} else {
$sql = "select b.company_idcompany,gl_date,acc_idacc,dvalue,kvalue from gldtl a,glhdr b,acc c where a.glhdr_idglhdr = b.idglhdr 
and a.acc_idacc = c.idacc and c.cfstatus = 'Y'  and gl_date between '$start' and '$end' and b.company_idcompany = '$comp' group by acc_idacc"; 
	
}	 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
<p class="judul">Laporan Arus Kas</p> 
  <table id="gldtl">  
  <tr> 
<th>Tanggal</th>
<th>No Acc</th>
<th>Keterangan</th>
<th>Unit Usaha</th>
<th>Debet</th>
<th>Kredit</th>

  </tr> 
		<?php 
		//menampilkan data gldtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
$acc=accinfo($row['acc_idacc']);
$accname = $acc['accname'];  		
$idcompany = $row['company_idcompany'];
$cpx = companyinfo($idcompany);
$company = $cpx['company'];
		
  			?>		 
       <tr> 
       
<td><? echo gettanggal($row['gl_date']);?></td>
<td><? echo $row['acc_idacc'];?></td>
<td><? echo $accname;?></td>
<td><? echo $company;?></td>
<td class="right"><? echo nf($row['dvalue']);?></td>
<td class="right"><? echo nf($row['kvalue']);?></td>
         </tr> 
<?  
$tdebet = $tdebet + $row['dvalue'];
$tkredit = $tkredit + $row['kvalue'];
	
	} //end while ?> 
<tr><td colspan="4">Total</td><td class="right"><? echo nf($tdebet); ?></td><td class="right"><? echo nf($tkredit);?> </td></tr>

		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
