 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data tasklist sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtasklist"){ 
    dataString = 'starting='+page+'&idtasklist='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "project_idproject"){ 
    dataString = 'starting='+page+'&project_idproject='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "taskname"){ 
    dataString = 'starting='+page+'&taskname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "keterangan"){ 
    dataString = 'starting='+page+'&keterangan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "startdate"){ 
    dataString = 'starting='+page+'&startdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "enddate"){ 
    dataString = 'starting='+page+'&enddate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "finishdate"){ 
    dataString = 'starting='+page+'&finishdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "files"){ 
    dataString = 'starting='+page+'&files='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "taskstatus"){ 
    dataString = 'starting='+page+'&taskstatus='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"tasklist_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data tasklist, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtasklist"){ 
      dataString = 'idtasklist='+ cari;  
   } 
   else if (combo == "project_idproject"){ 
      dataString = 'project_idproject='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
   else if (combo == "taskname"){ 
      dataString = 'taskname='+ cari; 
    } 
   else if (combo == "keterangan"){ 
      dataString = 'keterangan='+ cari; 
    } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "enddate"){ 
      dataString = 'enddate='+ cari; 
    } 
   else if (combo == "finishdate"){ 
      dataString = 'finishdate='+ cari; 
    } 
   else if (combo == "files"){ 
      dataString = 'files='+ cari; 
    } 
   else if (combo == "taskstatus"){ 
      dataString = 'taskstatus='+ cari; 
    } 
 
  $.ajax({ 
    url: "tasklist_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#tasklist tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#tasklist tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data tasklist ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("tasklist_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data tasklist berhasil di hapus!"); 
					} 
					else{ 
						alert("data tasklist gagal di hapus!"); 
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
 
if (isset($_GET['idtasklist']) and !empty($_GET['idtasklist'])){ 
 $idtasklist = $_GET['idtasklist']; 
  $sql = "select * from tasklist where idtasklist like '%$idtasklist%' order by idtasklist"; 
} 
else if (isset($_GET['project_idproject']) and !empty($_GET['project_idproject'])){ 
 $project_idproject = $_GET['project_idproject']; 
  $sql = "select * from tasklist where project_idproject like '%$project_idproject%' order by project_idproject"; 
} 
else if (isset($_GET['emp_idemp']) and !empty($_GET['emp_idemp'])){ 
 $emp_idemp = $_GET['emp_idemp']; 
  $sql = "select * from tasklist where emp_idemp like '%$emp_idemp%' order by emp_idemp"; 
} 
else if (isset($_GET['taskname']) and !empty($_GET['taskname'])){ 
 $taskname = $_GET['taskname']; 
  $sql = "select * from tasklist where taskname like '%$taskname%' order by taskname"; 
} 
else if (isset($_GET['keterangan']) and !empty($_GET['keterangan'])){ 
 $keterangan = $_GET['keterangan']; 
  $sql = "select * from tasklist where keterangan like '%$keterangan%' order by keterangan"; 
} 
else if (isset($_GET['startdate']) and !empty($_GET['startdate'])){ 
 $startdate = $_GET['startdate']; 
  $sql = "select * from tasklist where startdate like '%$startdate%' order by startdate"; 
} 
else if (isset($_GET['enddate']) and !empty($_GET['enddate'])){ 
 $enddate = $_GET['enddate']; 
  $sql = "select * from tasklist where enddate like '%$enddate%' order by enddate"; 
} 
else if (isset($_GET['finishdate']) and !empty($_GET['finishdate'])){ 
 $finishdate = $_GET['finishdate']; 
  $sql = "select * from tasklist where finishdate like '%$finishdate%' order by finishdate"; 
} 
else if (isset($_GET['files']) and !empty($_GET['files'])){ 
 $files = $_GET['files']; 
  $sql = "select * from tasklist where files like '%$files%' order by files"; 
} 
else if (isset($_GET['taskstatus']) and !empty($_GET['taskstatus'])){ 
 $taskstatus = $_GET['taskstatus']; 
  $sql = "select * from tasklist where taskstatus like '%$taskstatus%' order by taskstatus"; 
} 
else{ 
  $sql = "select * from tasklist"; 
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
	 
<p class="judul">Daftar tasklist </p> 
  <table id="tasklist"> 
  <tr> 
 <th>idtasklist</th>
<th>project_idproject</th>
<th>emp_idemp</th>
<th>taskname</th>
<th>keterangan</th>
<th>startdate</th>
<th>enddate</th>
<th>finishdate</th>
<th>files</th>
<th>taskstatus</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data tasklist 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtasklist'];?></td>
<td><? echo $row['project_idproject'];?></td>
<td><? echo $row['emp_idemp'];?></td>
<td><? echo $row['taskname'];?></td>
<td><? echo $row['keterangan'];?></td>
<td><? echo $row['startdate'];?></td>
<td><? echo $row['enddate'];?></td>
<td><? echo $row['finishdate'];?></td>
<td><? echo $row['files'];?></td>
<td><? echo $row['taskstatus'];?></td>
 
        <td width="150px"> 
         <a href="tasklist_detail.php?action=detail&id=<? echo $row['idtasklist'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="tasklist_form.php?action=update&id=<? echo $row['idtasklist'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="tasklist_process.php?action=delete&id=<? echo $row['idtasklist'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
