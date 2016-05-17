 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data doccat sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "iddoccat"){ 
    dataString = 'starting='+page+'&iddoccat='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "doccatname"){ 
    dataString = 'starting='+page+'&doccatname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"doccat_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data doccat, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "iddoccat"){ 
      dataString = 'iddoccat='+ cari;  
   } 
   else if (combo == "doccatname"){ 
      dataString = 'doccatname='+ cari; 
    } 
 
  $.ajax({ 
    url: "doccat_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#doccat tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#doccat tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data doccat ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("doccat_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data doccat berhasil di hapus!"); 
					} 
					else{ 
						alert("data doccat gagal di hapus!"); 
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
 
if (isset($_GET['iddoccat']) and !empty($_GET['iddoccat'])){ 
 $iddoccat = $_GET['iddoccat']; 
  $sql = "select * from doccat where iddoccat like '%$iddoccat%' order by iddoccat"; 
} 
else if (isset($_GET['doccatname']) and !empty($_GET['doccatname'])){ 
 $doccatname = $_GET['doccatname']; 
  $sql = "select * from doccat where doccatname like '%$doccatname%' order by doccatname"; 
} 
else{ 
  $sql = "select * from doccat"; 
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
	 
  <table id="doccat"> 
  <tr> 
 <th>Kode</th>
<th>Kategori</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data doccat 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['iddoccat'];?></td>
<td><? echo $row['doccatname'];?></td>
 
        <td><a href="doccat_form.php?action=update&id=<? echo $row['iddoccat'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="doccat_process.php?action=delete&id=<? echo $row['iddoccat'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
