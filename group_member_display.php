 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data group_member sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "group_id"){ 
    dataString = 'starting='+page+'&group_id='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "member_id"){ 
    dataString = 'starting='+page+'&member_id='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"group_member_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data group_member, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "group_id"){ 
      dataString = 'group_id='+ cari;  
   } 
   else if (combo == "member_id"){ 
      dataString = 'member_id='+ cari; 
    } 
 
  $.ajax({ 
    url: "group_member_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#group_member tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#group_member tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data group_member ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("group_member_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data group_member berhasil di hapus!"); 
					} 
					else{ 
						alert("data group_member gagal di hapus!"); 
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
  $sql = "select * from group_member where group_id like '%$group_id%' order by group_id"; 
} 
else if (isset($_GET['member_id']) and !empty($_GET['member_id'])){ 
 $member_id = $_GET['member_id']; 
  $sql = "select * from group_member where member_id like '%$member_id%' order by member_id"; 
} 
else{ 
  $sql = "select * from group_member"; 
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
	 
<p class="judul">Daftar group_member </p> 
  <table id="group_member"   style="min-width:500px;"> 
  <tr> 
 <th>group_id</th>
<th>member_id</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data group_member 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['group_id'];?></td>
<td><? echo $row['member_id'];?></td>
 
        <td width="150px"> 
         <a href="group_member_detail.php?action=detail&id=<? echo $row['idgroup_member'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="group_member_form.php?action=update&id=<? echo $row['idgroup_member'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="group_member_process.php?action=delete&id=<? echo $row['idgroup_member'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
