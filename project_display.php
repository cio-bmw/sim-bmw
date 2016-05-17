 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data project sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idproject"){ 
    dataString = 'starting='+page+'&idproject='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "startdate"){ 
    dataString = 'starting='+page+'&startdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Keterangan"){ 
    dataString = 'starting='+page+'&Keterangan='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"project_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data project, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idproject"){ 
      dataString = 'idproject='+ cari;  
   } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "Keterangan"){ 
      dataString = 'Keterangan='+ cari; 
    } 
 
  $.ajax({ 
    url: "project_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#project tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#project tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data project ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("project_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data project berhasil di hapus!"); 
					} 
					else{ 
						alert("data project gagal di hapus!"); 
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
 
if (isset($_GET['idproject']) and !empty($_GET['idproject'])){ 
 $idproject = $_GET['idproject']; 
  $sql = "select * from project where idproject like '%$idproject%' order by idproject"; 
} 
else if (isset($_GET['startdate']) and !empty($_GET['startdate'])){ 
 $startdate = $_GET['startdate']; 
  $sql = "select * from project where startdate like '%$startdate%' order by startdate"; 
} 
else if (isset($_GET['Keterangan']) and !empty($_GET['Keterangan'])){ 
 $Keterangan = $_GET['Keterangan']; 
  $sql = "select * from project where Keterangan like '%$Keterangan%' order by Keterangan"; 
} 
else{ 
  $sql = "select * from project"; 
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
	 
<p class="judul">Daftar project </p> 
  <table id="project" width="500px"> 
  <tr> 
 <th>idproject</th>
<th>startdate</th>
<th>Keterangan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data project 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idproject'];?></td>
<td><? echo gettanggal($row['startdate']);?></td>
<td><? echo $row['Keterangan'];?></td>
 
        <td width="170px"> 
         <a href="project_detail.php?action=detail&id=<? echo $row['idproject'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="project_form.php?action=update&id=<? echo $row['idproject'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="project_process.php?action=delete&id=<? echo $row['idproject'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
