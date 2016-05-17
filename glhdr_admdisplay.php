 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data glhdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idglhdr"){ 
    dataString = 'starting='+page+'&idglhdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "gl_date"){ 
    dataString = 'starting='+page+'&gl_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "gl_desc"){ 
    dataString = 'starting='+page+'&gl_desc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "gl_refno"){ 
    dataString = 'starting='+page+'&gl_refno='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"glhdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data glhdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idglhdr"){ 
      dataString = 'idglhdr='+ cari;  
   } 
   else if (combo == "gl_date"){ 
      dataString = 'gl_date='+ cari; 
    } 
   else if (combo == "gl_desc"){ 
      dataString = 'gl_desc='+ cari; 
    } 
   else if (combo == "gl_refno"){ 
      dataString = 'gl_refno='+ cari; 
    } 
 
  $.ajax({ 
    url: "glhdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#glhdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#glhdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		return false; 
	}); 
	 
	$("a.detail").click(function(){ 
		window.location=$(this).attr("href"); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data glhdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("glhdr_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data glhdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data glhdr gagal di hapus!"); 
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
$comp = $_GET['comp'];
$start = settanggal($_GET['start']);
$end = settanggal($_GET['end']);
$dsp = $_GET['dsp'];

if ($comp=='%') { 
$sql = "select * from glhdr where gl_date between '$start' and '$end' order by idglhdr desc"; 
} else {
$sql = "select * from glhdr where company_idcompany = '$comp' and gl_date between '$start' and '$end' order by idglhdr desc"; 
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
	 
<p class="judul">Daftar Journal</p> 
  <table id="glhdr"> 
  <tr> 
  
<th>No Dok</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>No Ref</th>
<th>Unit</th>
<th>Status</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data glhdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  			$companyx=companyinfo($row['company_idcompany']);
  		$company = $companyx['company'];

	
  			
  			 ?>		 
       <tr> 
 <td><? echo $row['idglhdr'];?></td>
<td><? echo gettanggal($row['gl_date']);?></td>
<td><? echo $row['gl_desc'];?></td>
<td><? echo $row['gl_refno'];?></td>
<td><? echo $company;?></td>
<td><? echo $row['gl_status'];?></td>
 
        <td width="155px"> 
         <a href="glhdr_detail.php?action=detail&id=<? echo $row['idglhdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="glhdr_form.php?action=update&id=<? echo $row['idglhdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="glhdr_process.php?action=delete&id=<? echo $row['idglhdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
