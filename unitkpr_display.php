 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unitkpr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitkpr"){ 
    dataString = 'starting='+page+'&idunitkpr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "check_date"){ 
    dataString = 'starting='+page+'&check_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unit_idunit"){ 
    dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kprclmst_idkprclmst"){ 
    dataString = 'starting='+page+'&kprclmst_idkprclmst='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"unitkpr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitkpr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitkpr"){ 
      dataString = 'idunitkpr='+ cari;  
   } 
   else if (combo == "check_date"){ 
      dataString = 'check_date='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "kprclmst_idkprclmst"){ 
      dataString = 'kprclmst_idkprclmst='+ cari; 
    } 
 
  $.ajax({ 
    url: "unitkpr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitkpr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitkpr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data unitkpr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("unitkpr_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data unitkpr berhasil di hapus!"); 
					} 
					else{ 
						alert("data unitkpr gagal di hapus!"); 
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
 
if (isset($_GET['idunitkpr']) and !empty($_GET['idunitkpr'])){ 
 $idunitkpr = $_GET['idunitkpr']; 
  $sql = "select * from unitkpr where idunitkpr like '%$idunitkpr%' order by idunitkpr"; 
} 
else if (isset($_GET['check_date']) and !empty($_GET['check_date'])){ 
 $check_date = $_GET['check_date']; 
  $sql = "select * from unitkpr where check_date like '%$check_date%' order by check_date"; 
} 
else if (isset($_GET['unit_idunit']) and !empty($_GET['unit_idunit'])){ 
 $unit_idunit = $_GET['unit_idunit']; 
  $sql = "select * from unitkpr where unit_idunit like '%$unit_idunit%' order by unit_idunit"; 
} 
else if (isset($_GET['kprclmst_idkprclmst']) and !empty($_GET['kprclmst_idkprclmst'])){ 
 $kprclmst_idkprclmst = $_GET['kprclmst_idkprclmst']; 
  $sql = "select * from unitkpr where kprclmst_idkprclmst like '%$kprclmst_idkprclmst%' order by kprclmst_idkprclmst"; 
} 
else{ 
  $sql = "select * from unitkpr"; 
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
	 
<p class="judul">Daftar unitkpr </p> 
  <table id="unitkpr"> 
  <tr> 
 <th>idunitkpr</th>
<th>check_date</th>
<th>unit_idunit</th>
<th>kprclmst_idkprclmst</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitkpr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idunitkpr'];?></td>
<td><? echo $row['check_date'];?></td>
<td><? echo $row['unit_idunit'];?></td>
<td><? echo $row['kprclmst_idkprclmst'];?></td>
 
        <td width="150px"> 
         <a href="unitkpr_detail.php?action=detail&id=<? echo $row['idunitkpr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="unitkpr_form.php?action=update&id=<? echo $row['idunitkpr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unitkpr_process.php?action=delete&id=<? echo $row['idunitkpr'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
