 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unitstatus sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitstatus"){ 
    dataString = 'starting='+page+'&idunitstatus='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "unitstatusname"){ 
    dataString = 'starting='+page+'&unitstatusname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"unitstatus_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitstatus, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunitstatus"){ 
      dataString = 'idunitstatus='+ cari;  
   } 
   else if (combo == "unitstatusname"){ 
      dataString = 'unitstatusname='+ cari; 
    } 
 
  $.ajax({ 
    url: "unitstatus_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitstatus tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitstatus tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data unitstatus ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("unitstatus_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data unitstatus berhasil di hapus!"); 
					} 
					else{ 
						alert("data unitstatus gagal di hapus!"); 
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
 
if (isset($_GET['idunitstatus']) and !empty($_GET['idunitstatus'])){ 
 $idunitstatus = $_GET['idunitstatus']; 
  $sql = "select * from unitstatus where idunitstatus like '%$idunitstatus%' order by idunitstatus"; 
} 
else if (isset($_GET['unitstatusname']) and !empty($_GET['unitstatusname'])){ 
 $unitstatusname = $_GET['unitstatusname']; 
  $sql = "select * from unitstatus where unitstatusname like '%$unitstatusname%' order by unitstatusname"; 
} 
else{ 
  $sql = "select * from unitstatus"; 
} 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="unitstatus"> 
  <tr> 
 <th>idunitstatus</th>
<th>unitstatusname</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitstatus 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idunitstatus'];?></td>
<td><? echo $row['unitstatusname'];?></td>
 
        <td><a href="unitstatus_form.php?action=update&id=<? echo $row['idunitstatus'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unitstatus_process.php?action=delete&id=<? echo $row['idunitstatus'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
