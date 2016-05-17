 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unitamclist sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitamclist"){ 
    dataString = 'starting='+page+'&idunitamclist='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "clstatus"){ 
    dataString = 'starting='+page+'&clstatus='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unit_idunit"){ 
    dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "amclist_idamclist"){ 
    dataString = 'starting='+page+'&amclist_idamclist='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"unitamclist_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitamclist, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitamclist"){ 
      dataString = 'idunitamclist='+ cari;  
   } 
   else if (combo == "clstatus"){ 
      dataString = 'clstatus='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "amclist_idamclist"){ 
      dataString = 'amclist_idamclist='+ cari; 
    } 
 
  $.ajax({ 
    url: "unitamclist_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitamclist tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitamclist tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data unitamclist ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("unitamclist_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data unitamclist berhasil di hapus!"); 
					} 
					else{ 
						alert("data unitamclist gagal di hapus!"); 
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
 
if (isset($_GET['idunitamclist']) and !empty($_GET['idunitamclist'])){ 
 $idunitamclist = $_GET['idunitamclist']; 
  $sql = "select * from unitamclist where idunitamclist like '%$idunitamclist%' order by idunitamclist"; 
} 
else if (isset($_GET['clstatus']) and !empty($_GET['clstatus'])){ 
 $clstatus = $_GET['clstatus']; 
  $sql = "select * from unitamclist where clstatus like '%$clstatus%' order by clstatus"; 
} 
else if (isset($_GET['unit_idunit']) and !empty($_GET['unit_idunit'])){ 
 $unit_idunit = $_GET['unit_idunit']; 
  $sql = "select * from unitamclist where unit_idunit like '%$unit_idunit%' order by unit_idunit"; 
} 
else if (isset($_GET['amclist_idamclist']) and !empty($_GET['amclist_idamclist'])){ 
 $amclist_idamclist = $_GET['amclist_idamclist']; 
  $sql = "select * from unitamclist where amclist_idamclist like '%$amclist_idamclist%' order by amclist_idamclist"; 
} 
else{ 
  $sql = "select * from unitamclist"; 
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
	 
<p class="judul">Daftar unitamclist </p> 
  <table id="unitamclist"> 
  <tr> 
 <th>idunitamclist</th>
<th>clstatus</th>
<th>unit_idunit</th>
<th>amclist_idamclist</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitamclist 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idunitamclist'];?></td>
<td><? echo $row['clstatus'];?></td>
<td><? echo $row['unit_idunit'];?></td>
<td><? echo $row['amclist_idamclist'];?></td>
 
        <td width="105px"> 
         <a href="unitamclist_detail.php?action=detail&id=<? echo $row['idunitamclist'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="unitamclist_form.php?action=update&id=<? echo $row['idunitamclist'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unitamclist_process.php?action=delete&id=<? echo $row['idunitamclist'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
