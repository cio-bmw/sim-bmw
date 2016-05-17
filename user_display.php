 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "username"){ 
    dataString = 'starting='+page+'&username='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "passwd"){ 
    dataString = 'starting='+page+'&passwd='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "usr_lvl"){ 
    dataString = 'starting='+page+'&usr_lvl='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"user_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pelanggan, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "username"){ 
      dataString = 'username='+ cari;  
   } 
   else if (combo == "passwd"){ 
      dataString = 'passwd='+ cari; 
    } 
   else if (combo == "usr_lvl"){ 
      dataString = 'usr_lvl='+ cari; 
    } 
 
  $.ajax({ 
    url: "user_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#user tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#user tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data user ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("user_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data user berhasil di hapus!"); 
					} 
					else{ 
						alert("data user gagal di hapus!"); 
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
 
if (isset($_GET['username']) and !empty($_GET['username'])){ 
 $username = $_GET['username']; 
  $sql = "select * from user where username like '%$username%' order by username"; 
} 
else if (isset($_GET['passwd']) and !empty($_GET['passwd'])){ 
 $passwd = $_GET['passwd']; 
  $sql = "select * from user where passwd like '%$passwd%' order by passwd"; 
} 
else if (isset($_GET['usr_lvl']) and !empty($_GET['usr_lvl'])){ 
 $usr_lvl = $_GET['usr_lvl']; 
  $sql = "select * from user where usr_lvl like '%$usr_lvl%' order by usr_lvl"; 
} 
else{ 
  $sql = "select * from user"; 
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
	 
  <table id="user"> 
  <tr> 
 <th>username</th>
<th>passwd</th>
<th>usr_lvl</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['username'];?></td>
<td><? echo $row['passwd'];?></td>
<td><? echo $row['usr_lvl'];?></td>
 
        <td><a href="user_form.php?action=update&id=<? echo $row['iduser'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['iduser'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
