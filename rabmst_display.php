 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data rabmst sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idrabmst"){ 
    dataString = 'starting='+page+'&idrabmst='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "rabdesc"){ 
    dataString = 'starting='+page+'&rabdesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rabcat_idrabcat"){ 
    dataString = 'starting='+page+'&rabcat_idrabcat='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "satuan"){ 
    dataString = 'starting='+page+'&satuan='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"rabmst_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data rabmst, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idrabmst"){ 
      dataString = 'idrabmst='+ cari;  
   } 
   else if (combo == "rabdesc"){ 
      dataString = 'rabdesc='+ cari; 
    } 
   else if (combo == "rabcat_idrabcat"){ 
      dataString = 'rabcat_idrabcat='+ cari; 
    } 
   else if (combo == "satuan"){ 
      dataString = 'satuan='+ cari; 
    } 
 
  $.ajax({ 
    url: "rabmst_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#rabmst tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#rabmst tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageEntry").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageEntry").show(); 
	
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data rabmst ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("rabmst_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data rabmst berhasil di hapus!"); 
					} 
					else{ 
						alert("data rabmst gagal di hapus!"); 
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
 
if (isset($_GET['idrabmst']) and !empty($_GET['idrabmst'])){ 
 $idrabmst = $_GET['idrabmst']; 
  $sql = "select * from rabmst where idrabmst like '%$idrabmst%' order by idrabmst"; 
} 
else if (isset($_GET['rabdesc']) and !empty($_GET['rabdesc'])){ 
 $rabdesc = $_GET['rabdesc']; 
  $sql = "select * from rabmst where rabdesc like '%$rabdesc%' order by rabdesc"; 
} 
else if (isset($_GET['rabcat_idrabcat']) and !empty($_GET['rabcat_idrabcat'])){ 
 $rabcat_idrabcat = $_GET['rabcat_idrabcat']; 
  $sql = "select * from rabmst where rabcat_idrabcat like '%$rabcat_idrabcat%' order by rabcat_idrabcat"; 
} 
else if (isset($_GET['satuan']) and !empty($_GET['satuan'])){ 
 $satuan = $_GET['satuan']; 
  $sql = "select * from rabmst where satuan like '%$satuan%' order by satuan"; 
} 
else{ 
  $sql = "select * from rabmst"; 
} 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="rabmst" width=600px> 
  <tr> 
 <th>Kode</th>
<th>Keterangan</th>
<th colspan=2>Kategori</th>
<th>Satuan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data rabmst 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
      $rabcat = rabcatinfo($row['rabcat_idrabcat']);
      $rabcatname = $rabcat['rabcatname'];  		
  		?>		 
       <tr> 
 <td><? echo $row['idrabmst'];?></td>
<td><? echo $row['rabdesc'];?></td>
<td><? echo $row['rabcat_idrabcat'];?></td>
<td><? echo $rabcatname;?></td>
<td><? echo $row['satuan'];?></td>
 
        <td width="120px"><a href="rabmst_form.php?action=update&id=<? echo $row['idrabmst'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="rabmst_process.php?action=delete&id=<? echo $row['idrabmst'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
