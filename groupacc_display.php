 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data groupacc sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idgroupacc"){ 
    dataString = 'starting='+page+'&idgroupacc='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "groupname"){ 
    dataString = 'starting='+page+'&groupname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"groupacc_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data groupacc, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idgroupacc"){ 
      dataString = 'idgroupacc='+ cari;  
   } 
   else if (combo == "groupname"){ 
      dataString = 'groupname='+ cari; 
    } 
 
  $.ajax({ 
    url: "groupacc_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#groupacc tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#groupacc tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data groupacc ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("groupacc_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data groupacc berhasil di hapus!"); 
					} 
					else{ 
						alert("data groupacc gagal di hapus!"); 
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
 
if (isset($_GET['idgroupacc']) and !empty($_GET['idgroupacc'])){ 
 $idgroupacc = $_GET['idgroupacc']; 
  $sql = "select * from groupacc where idgroupacc like '%$idgroupacc%' order by idgroupacc"; 
} 
else if (isset($_GET['groupname']) and !empty($_GET['groupname'])){ 
 $groupname = $_GET['groupname']; 
  $sql = "select * from groupacc where groupname like '%$groupname%' order by groupname"; 
} 
else{ 
  $sql = "select * from groupacc"; 
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
	 
<p class="judul">Daftar Group Account</p> 
  <table id="groupacc"> 
  <tr> 
 <th>id</th>
<th>Group Account</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data groupacc 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idgroupacc'];?></td>
<td><? echo $row['groupname'];?></td>
 
        <td width="100px"> 
       <a href="groupacc_form.php?action=update&id=<? echo $row['idgroupacc'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="groupacc_process.php?action=delete&id=<? echo $row['idgroupacc'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
