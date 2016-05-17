 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data taskreplay sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtaskreplay"){ 
    dataString = 'starting='+page+'&idtaskreplay='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "taskreplay"){ 
    dataString = 'starting='+page+'&taskreplay='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "filename"){ 
    dataString = 'starting='+page+'&filename='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "taskreplaydate"){ 
    dataString = 'starting='+page+'&taskreplaydate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "task_idtask"){ 
    dataString = 'starting='+page+'&task_idtask='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"taskreplay_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data taskreplay, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtaskreplay"){ 
      dataString = 'idtaskreplay='+ cari;  
   } 
   else if (combo == "taskreplay"){ 
      dataString = 'taskreplay='+ cari; 
    } 
   else if (combo == "filename"){ 
      dataString = 'filename='+ cari; 
    } 
   else if (combo == "taskreplaydate"){ 
      dataString = 'taskreplaydate='+ cari; 
    } 
   else if (combo == "task_idtask"){ 
      dataString = 'task_idtask='+ cari; 
    } 
 
  $.ajax({ 
    url: "taskreplay_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#taskreplay tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#taskreplay tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data taskreplay ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("taskreplay_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data taskreplay berhasil di hapus!"); 
					} 
					else{ 
						alert("data taskreplay gagal di hapus!"); 
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
 
if (isset($_GET['idtaskreplay']) and !empty($_GET['idtaskreplay'])){ 
 $idtaskreplay = $_GET['idtaskreplay']; 
  $sql = "select * from taskreplay where idtaskreplay like '%$idtaskreplay%' order by idtaskreplay"; 
} 
else if (isset($_GET['taskreplay']) and !empty($_GET['taskreplay'])){ 
 $taskreplay = $_GET['taskreplay']; 
  $sql = "select * from taskreplay where taskreplay like '%$taskreplay%' order by taskreplay"; 
} 
else if (isset($_GET['filename']) and !empty($_GET['filename'])){ 
 $filename = $_GET['filename']; 
  $sql = "select * from taskreplay where filename like '%$filename%' order by filename"; 
} 
else if (isset($_GET['taskreplaydate']) and !empty($_GET['taskreplaydate'])){ 
 $taskreplaydate = $_GET['taskreplaydate']; 
  $sql = "select * from taskreplay where taskreplaydate like '%$taskreplaydate%' order by taskreplaydate"; 
} 
else if (isset($_GET['task_idtask']) and !empty($_GET['task_idtask'])){ 
 $task_idtask = $_GET['task_idtask']; 
  $sql = "select * from taskreplay where task_idtask like '%$task_idtask%' order by task_idtask"; 
} 
else{ 
  $sql = "select * from taskreplay"; 
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
	 
<p class="judul">Daftar taskreplay </p> 
  <table id="taskreplay"> 
  <tr> 
 <th>idtaskreplay</th>
<th>taskreplay</th>
<th>filename</th>
<th>taskreplaydate</th>
<th>task_idtask</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data taskreplay 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtaskreplay'];?></td>
<td><? echo $row['taskreplay'];?></td>
<td><? echo $row['filename'];?></td>
<td><? echo $row['taskreplaydate'];?></td>
<td><? echo $row['task_idtask'];?></td>
 
        <td width="150px"> 
         <a href="taskreplay_detail.php?action=detail&id=<? echo $row['idtaskreplay'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="taskreplay_form.php?action=update&id=<? echo $row['idtaskreplay'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="taskreplay_process.php?action=delete&id=<? echo $row['idtaskreplay'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
