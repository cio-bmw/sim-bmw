 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data rabcat sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idrabcat"){ 
    dataString = 'starting='+page+'&idrabcat='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "rabcatname"){ 
    dataString = 'starting='+page+'&rabcatname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"rabcat_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data rabcat, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idrabcat"){ 
      dataString = 'idrabcat='+ cari;  
   } 
   else if (combo == "rabcatname"){ 
      dataString = 'rabcatname='+ cari; 
    } 
 
  $.ajax({ 
    url: "rabcat_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#rabcat tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#rabcat tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data rabcat ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("rabcat_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data rabcat berhasil di hapus!"); 
					} 
					else{ 
						alert("data rabcat gagal di hapus!"); 
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
 
if (isset($_GET['idrabcat']) and !empty($_GET['idrabcat'])){ 
 $idrabcat = $_GET['idrabcat']; 
  $sql = "select * from rabcat where idrabcat like '%$idrabcat%' order by idrabcat"; 
} 
else if (isset($_GET['rabcatname']) and !empty($_GET['rabcatname'])){ 
 $rabcatname = $_GET['rabcatname']; 
  $sql = "select * from rabcat where rabcatname like '%$rabcatname%' order by rabcatname"; 
} 
else{ 
  $sql = "select * from rabcat"; 
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
	 
  <table id="rabcat"> 
  <tr> 
 <th>Kode</th>
<th>Kategori</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data rabcat 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idrabcat'];?></td>
<td><? echo $row['rabcatname'];?></td>
 
        <td><a href="rabcat_form.php?action=update&id=<? echo $row['idrabcat'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="rabcat_process.php?action=delete&id=<? echo $row['idrabcat'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
