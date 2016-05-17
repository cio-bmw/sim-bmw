 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data bukutamu sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idbukutamu"){ 
    dataString = 'starting='+page+'&idbukutamu='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "nama"){ 
    dataString = 'starting='+page+'&nama='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "alamat"){ 
    dataString = 'starting='+page+'&alamat='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "notlp"){ 
    dataString = 'starting='+page+'&notlp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "tanggal"){ 
    dataString = 'starting='+page+'&tanggal='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "catatan"){ 
    dataString = 'starting='+page+'&catatan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "diterima"){ 
    dataString = 'starting='+page+'&diterima='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"bukutamu_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data bukutamu, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idbukutamu"){ 
      dataString = 'idbukutamu='+ cari;  
   } 
   else if (combo == "nama"){ 
      dataString = 'nama='+ cari; 
    } 
   else if (combo == "alamat"){ 
      dataString = 'alamat='+ cari; 
    } 
   else if (combo == "notlp"){ 
      dataString = 'notlp='+ cari; 
    } 
   else if (combo == "tanggal"){ 
      dataString = 'tanggal='+ cari; 
    } 
   else if (combo == "catatan"){ 
      dataString = 'catatan='+ cari; 
    } 
   else if (combo == "diterima"){ 
      dataString = 'diterima='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
  $.ajax({ 
    url: "bukutamu_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#bukutamu tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#bukutamu tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data bukutamu ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("bukutamu_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data bukutamu berhasil di hapus!"); 
					} 
					else{ 
						alert("data bukutamu gagal di hapus!"); 
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
 
if (isset($_GET['idbukutamu']) and !empty($_GET['idbukutamu'])){ 
 $idbukutamu = $_GET['idbukutamu']; 
  $sql = "select * from bukutamu where idbukutamu like '%$idbukutamu%' order by idbukutamu"; 
} 
else if (isset($_GET['nama']) and !empty($_GET['nama'])){ 
 $nama = $_GET['nama']; 
  $sql = "select * from bukutamu where nama like '%$nama%' order by nama"; 
} 
else if (isset($_GET['alamat']) and !empty($_GET['alamat'])){ 
 $alamat = $_GET['alamat']; 
  $sql = "select * from bukutamu where alamat like '%$alamat%' order by alamat"; 
} 
else if (isset($_GET['notlp']) and !empty($_GET['notlp'])){ 
 $notlp = $_GET['notlp']; 
  $sql = "select * from bukutamu where notlp like '%$notlp%' order by notlp"; 
} 
else if (isset($_GET['tanggal']) and !empty($_GET['tanggal'])){ 
 $tanggal = $_GET['tanggal']; 
  $sql = "select * from bukutamu where tanggal like '%$tanggal%' order by tanggal"; 
} 
else if (isset($_GET['catatan']) and !empty($_GET['catatan'])){ 
 $catatan = $_GET['catatan']; 
  $sql = "select * from bukutamu where catatan like '%$catatan%' order by catatan"; 
} 
else if (isset($_GET['diterima']) and !empty($_GET['diterima'])){ 
 $diterima = $_GET['diterima']; 
  $sql = "select * from bukutamu where diterima like '%$diterima%' order by diterima"; 
} 
else if (isset($_GET['emp_idemp']) and !empty($_GET['emp_idemp'])){ 
 $emp_idemp = $_GET['emp_idemp']; 
  $sql = "select * from bukutamu where emp_idemp like '%$emp_idemp%' order by emp_idemp"; 
} 
else{ 
  $sql = "select * from bukutamu"; 
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
	 
  <table class="grid" id="bukutamu"> 
  <tr> 
 <th>No</th>
<th>Nama</th>
<th>Alamat</th>
<th>No tlp</th>
<th>Tanggal</th>
<th>Catatan</th>
<th>Diterima</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data bukutamu 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idbukutamu'];?></td>
<td><? echo $row['nama'];?></td>
<td><? echo $row['alamat'];?></td>
<td><? echo $row['notlp'];?></td>
<td><? echo $row['tanggal'];?></td>
<td><? echo $row['catatan'];?></td>
<td><? echo $row['diterima'];?></td>
 
        <td width="110px"><a href="bukutamu_form.php?action=update&id=<? echo $row['idbukutamu'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="bukutamu_process.php?action=delete&id=<? echo $row['idbukutamu'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
