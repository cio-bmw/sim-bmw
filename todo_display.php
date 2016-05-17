 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data todo sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtodo"){ 
    dataString = 'starting='+page+'&idtodo='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "todo"){ 
    dataString = 'starting='+page+'&todo='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "startdate"){ 
    dataString = 'starting='+page+'&startdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "enddate"){ 
    dataString = 'starting='+page+'&enddate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "todostatus"){ 
    dataString = 'starting='+page+'&todostatus='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"todo_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data todo, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtodo"){ 
      dataString = 'idtodo='+ cari;  
   } 
   else if (combo == "todo"){ 
      dataString = 'todo='+ cari; 
    } 
   else if (combo == "startdate"){ 
      dataString = 'startdate='+ cari; 
    } 
   else if (combo == "enddate"){ 
      dataString = 'enddate='+ cari; 
    } 
   else if (combo == "todostatus"){ 
      dataString = 'todostatus='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
  $.ajax({ 
    url: "todo_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#todo tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#todo tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data todo ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("todo_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data todo berhasil di hapus!"); 
					} 
					else{ 
						alert("data todo gagal di hapus!"); 
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
 
if (isset($_GET['idtodo']) and !empty($_GET['idtodo'])){ 
 $idtodo = $_GET['idtodo']; 
  $sql = "select * from todo where idtodo like '%$idtodo%' order by idtodo"; 
} 
else if (isset($_GET['todo']) and !empty($_GET['todo'])){ 
 $todo = $_GET['todo']; 
  $sql = "select * from todo where todo like '%$todo%' order by todo"; 
} 
else if (isset($_GET['startdate']) and !empty($_GET['startdate'])){ 
 $startdate = $_GET['startdate']; 
  $sql = "select * from todo where startdate like '%$startdate%' order by startdate"; 
} 
else if (isset($_GET['enddate']) and !empty($_GET['enddate'])){ 
 $enddate = $_GET['enddate']; 
  $sql = "select * from todo where enddate like '%$enddate%' order by enddate"; 
} 
else if (isset($_GET['todostatus']) and !empty($_GET['todostatus'])){ 
 $todostatus = $_GET['todostatus']; 
  $sql = "select * from todo where todostatus like '%$todostatus%' order by todostatus"; 
} 
else if (isset($_GET['emp_idemp']) and !empty($_GET['emp_idemp'])){ 
 $emp_idemp = $_GET['emp_idemp']; 
  $sql = "select * from todo where emp_idemp like '%$emp_idemp%' order by emp_idemp"; 
} 
else{ 
  $sql = "select * from todo"; 
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
	 
<p class="judul">Daftar todo </p> 
  <table id="todo"> 
  <tr> 
 <th>No</th>
<th>todo</th>
<th>startdate</th>
<th>enddate</th>
<th>todostatus</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data todo 
		if(mysql_num_rows($result)!=0){ $no=1;
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $no;?></td>
<td><? echo $row['todo'];?></td>
<td><? echo gettanggal($row['startdate']);?></td>
<td><? echo gettanggal($row['enddate']);?></td>
<td><? echo $row['todostatus'];?></td>
 
        <td width="150px"> 
       <a href="todo_form.php?action=update&id=<? echo $row['idtodo'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="todo_process.php?action=delete&id=<? echo $row['idtodo'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<? 
$no++;  		
  		} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
