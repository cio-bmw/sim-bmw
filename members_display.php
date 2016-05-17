 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data members sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "member_id"){ 
    dataString = 'starting='+page+'&member_id='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "hp_no"){ 
    dataString = 'starting='+page+'&hp_no='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "name"){ 
    dataString = 'starting='+page+'&name='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "address"){ 
    dataString = 'starting='+page+'&address='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "title"){ 
    dataString = 'starting='+page+'&title='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pilih"){ 
    dataString = 'starting='+page+'&pilih='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"members_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data members, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "member_id"){ 
      dataString = 'member_id='+ cari;  
   } 
   else if (combo == "hp_no"){ 
      dataString = 'hp_no='+ cari; 
    } 
   else if (combo == "name"){ 
      dataString = 'name='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "title"){ 
      dataString = 'title='+ cari; 
    } 
   else if (combo == "pilih"){ 
      dataString = 'pilih='+ cari; 
    } 
 
  $.ajax({ 
    url: "members_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#members tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#members tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data members ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("members_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data members berhasil di hapus!"); 
					} 
					else{ 
						alert("data members gagal di hapus!"); 
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
 
if (isset($_GET['member_id']) and !empty($_GET['member_id'])){ 
 $member_id = $_GET['member_id']; 
  $sql = "select * from members where member_id like '%$member_id%' order by member_id"; 
} 
else if (isset($_GET['hp_no']) and !empty($_GET['hp_no'])){ 
 $hp_no = $_GET['hp_no']; 
  $sql = "select * from members where hp_no like '%$hp_no%' order by hp_no"; 
} 
else if (isset($_GET['name']) and !empty($_GET['name'])){ 
 $name = $_GET['name']; 
  $sql = "select * from members where name like '%$name%' order by name"; 
} 
else if (isset($_GET['address']) and !empty($_GET['address'])){ 
 $address = $_GET['address']; 
  $sql = "select * from members where address like '%$address%' order by address"; 
} 
else if (isset($_GET['title']) and !empty($_GET['title'])){ 
 $title = $_GET['title']; 
  $sql = "select * from members where title like '%$title%' order by title"; 
} 
else if (isset($_GET['pilih']) and !empty($_GET['pilih'])){ 
 $pilih = $_GET['pilih']; 
  $sql = "select * from members where pilih like '%$pilih%' order by pilih"; 
} 
else{ 
  $sql = "select * from members"; 
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
	 
<p class="judul">Daftar members </p> 
  <table id="members"   style="min-width:500px;"> 
  <tr> 
 <th>member_id</th>
<th>hp_no</th>
<th>name</th>
<th>address</th>
<th>title</th>
<th>pilih</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data members 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['member_id'];?></td>
<td><? echo $row['hp_no'];?></td>
<td><? echo $row['name'];?></td>
<td><? echo $row['address'];?></td>
<td><? echo $row['title'];?></td>
<td><? echo $row['pilih'];?></td>
 
        <td width="150px"> 
         <a href="members_detail.php?action=detail&id=<? echo $row['idmembers'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="members_form.php?action=update&id=<? echo $row['idmembers'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="members_process.php?action=delete&id=<? echo $row['idmembers'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
