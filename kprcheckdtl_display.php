 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data kprcheckdtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idkprcheckdtl"){ 
    dataString = 'starting='+page+'&idkprcheckdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "startdate"){ 
    dataString = 'starting='+page+'&startdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "enddate"){ 
    dataString = 'starting='+page+'&enddate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kprclmst_idkprclmst"){ 
    dataString = 'starting='+page+'&kprclmst_idkprclmst='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kprcheckhdr_idkprcheckhdr"){ 
    dataString = 'starting='+page+'&kprcheckhdr_idkprcheckhdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"kprcheckdtl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data kprcheckdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idkprcheckdtl"){ 
      dataString = 'idkprcheckdtl='+ cari;  
   } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "enddate"){ 
      dataString = 'enddate='+ cari; 
    } 
   else if (combo == "kprclmst_idkprclmst"){ 
      dataString = 'kprclmst_idkprclmst='+ cari; 
    } 
   else if (combo == "kprcheckhdr_idkprcheckhdr"){ 
      dataString = 'kprcheckhdr_idkprcheckhdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "kprcheckdtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#kprcheckdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#kprcheckdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data kprcheckdtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("kprcheckdtl_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data kprcheckdtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data kprcheckdtl gagal di hapus!"); 
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
 
if (isset($_GET['idkprcheckdtl']) and !empty($_GET['idkprcheckdtl'])){ 
 $idkprcheckdtl = $_GET['idkprcheckdtl']; 
  $sql = "select * from kprcheckdtl where idkprcheckdtl like '%$idkprcheckdtl%' order by idkprcheckdtl"; 
} 
else if (isset($_GET['startdate']) and !empty($_GET['startdate'])){ 
 $startdate = $_GET['startdate']; 
  $sql = "select * from kprcheckdtl where startdate like '%$startdate%' order by startdate"; 
} 
else if (isset($_GET['enddate']) and !empty($_GET['enddate'])){ 
 $enddate = $_GET['enddate']; 
  $sql = "select * from kprcheckdtl where enddate like '%$enddate%' order by enddate"; 
} 
else if (isset($_GET['kprclmst_idkprclmst']) and !empty($_GET['kprclmst_idkprclmst'])){ 
 $kprclmst_idkprclmst = $_GET['kprclmst_idkprclmst']; 
  $sql = "select * from kprcheckdtl where kprclmst_idkprclmst like '%$kprclmst_idkprclmst%' order by kprclmst_idkprclmst"; 
} 
else if (isset($_GET['kprcheckhdr_idkprcheckhdr']) and !empty($_GET['kprcheckhdr_idkprcheckhdr'])){ 
 $kprcheckhdr_idkprcheckhdr = $_GET['kprcheckhdr_idkprcheckhdr']; 
  $sql = "select * from kprcheckdtl where kprcheckhdr_idkprcheckhdr like '%$kprcheckhdr_idkprcheckhdr%' order by kprcheckhdr_idkprcheckhdr"; 
} 
else{ 
  $sql = "select * from kprcheckdtl"; 
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
	 
<p class="judul">Daftar kprcheckdtl </p> 
  <table id="kprcheckdtl"> 
  <tr> 
 <th>idkprcheckdtl</th>
<th>startdate</th>
<th>enddate</th>
<th>kprclmst_idkprclmst</th>
<th>kprcheckhdr_idkprcheckhdr</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data kprcheckdtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idkprcheckdtl'];?></td>
<td><? echo $row['startdate'];?></td>
<td><? echo $row['enddate'];?></td>
<td><? echo $row['kprclmst_idkprclmst'];?></td>
<td><? echo $row['kprcheckhdr_idkprcheckhdr'];?></td>
 
        <td width="175px"> 
         <a href="kprcheckdtl_detail.php?action=detail&id=<? echo $row['idkprcheckdtl'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="kprcheckdtl_form.php?action=update&id=<? echo $row['idkprcheckdtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="kprcheckdtl_process.php?action=delete&id=<? echo $row['idkprcheckdtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
