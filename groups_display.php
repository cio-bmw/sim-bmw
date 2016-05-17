 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data groups sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "group_id"){ 
    dataString = 'starting='+page+'&group_id='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "group_name"){ 
    dataString = 'starting='+page+'&group_name='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"groups_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data groups, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "group_id"){ 
      dataString = 'group_id='+ cari;  
   } 
   else if (combo == "group_name"){ 
      dataString = 'group_name='+ cari; 
    } 
 
  $.ajax({ 
    url: "groups_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#groups tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#groups tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data groups ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("groups_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data groups berhasil di hapus!"); 
					} 
					else{ 
						alert("data groups gagal di hapus!"); 
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
 
if (isset($_GET['group_id']) and !empty($_GET['group_id'])){ 
 $group_id = $_GET['group_id']; 
  $sql = "select * from groups where group_id like '%$group_id%' order by group_id"; 
} 
else if (isset($_GET['group_name']) and !empty($_GET['group_name'])){ 
 $group_name = $_GET['group_name']; 
  $sql = "select * from groups where group_name like '%$group_name%' order by group_name"; 
} 
else{ 
  $sql = "select * from groups"; 
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
	 
<p class="judul">Daftar groups </p> 
  <table id="groups"   style="min-width:500px;"> 
  <tr> 
 <th>group_id</th>
<th>group_name</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data groups 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['group_id'];?></td>
<td><? echo $row['group_name'];?></td>
 
        <td width="150px"> 
         <a href="groups_detail.php?action=detail&id=<? echo $row['idgroups'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="groups_form.php?action=update&id=<? echo $row['idgroups'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="groups_process.php?action=delete&id=<? echo $row['idgroups'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
