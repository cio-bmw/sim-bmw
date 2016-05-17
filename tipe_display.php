 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data tipe sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtipe"){ 
    dataString = 'starting='+page+'&idtipe='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "tipename"){ 
    dataString = 'starting='+page+'&tipename='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "ukuran"){ 
    dataString = 'starting='+page+'&ukuran='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "lb"){ 
    dataString = 'starting='+page+'&lb='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "lt"){ 
    dataString = 'starting='+page+'&lt='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"tipe_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data tipe, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtipe"){ 
      dataString = 'idtipe='+ cari;  
   } 
   else if (combo == "tipename"){ 
      dataString = 'tipename='+ cari; 
    } 
   else if (combo == "ukuran"){ 
      dataString = 'ukuran='+ cari; 
    } 
   else if (combo == "lb"){ 
      dataString = 'lb='+ cari; 
    } 
   else if (combo == "lt"){ 
      dataString = 'lt='+ cari; 
    } 
 
  $.ajax({ 
    url: "tipe_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#tipe tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#tipe tr:odd:not(#nav):not(#total)').addClass('odd'); 
  
  $("a.detail").click(function(){ 
  window.location='tipe_detail.php';
  }); 
	 
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data tipe ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("tipe_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data tipe berhasil di hapus!"); 
					} 
					else{ 
						alert("data tipe gagal di hapus!"); 
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
 
if (isset($_GET['idtipe']) and !empty($_GET['idtipe'])){ 
 $idtipe = $_GET['idtipe']; 
  $sql = "select * from tipe where idtipe like '%$idtipe%' order by idtipe"; 
} 
else if (isset($_GET['tipename']) and !empty($_GET['tipename'])){ 
 $tipename = $_GET['tipename']; 
  $sql = "select * from tipe where tipename like '%$tipename%' order by tipename"; 
} 
else if (isset($_GET['ukuran']) and !empty($_GET['ukuran'])){ 
 $ukuran = $_GET['ukuran']; 
  $sql = "select * from tipe where ukuran like '%$ukuran%' order by ukuran"; 
} 
else if (isset($_GET['lb']) and !empty($_GET['lb'])){ 
 $lb = $_GET['lb']; 
  $sql = "select * from tipe where lb like '%$lb%' order by lb"; 
} 
else if (isset($_GET['lt']) and !empty($_GET['lt'])){ 
 $lt = $_GET['lt']; 
  $sql = "select * from tipe where lt like '%$lt%' order by lt"; 
} 
else{ 
  $sql = "select * from tipe"; 
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
	 
  <table id="tipe"> 
  <tr> 
 <th>idtipe</th>
<th>tipename</th>
<th>ukuran</th>
<th>lb</th>
<th>lt</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data tipe 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtipe'];?></td>
<td><? echo $row['tipename'];?></td>
<td><? echo $row['ukuran'];?></td>
<td><? echo $row['lb'];?></td>
<td><? echo $row['lt'];?></td>
 
        
        <td>
       <a href="tipe_materialbudget.php?idtipe=<? echo $row['idtipe'];?>" class="detail"> <input type="button" class="button" value="RAB Tipe"></a>   
       |<a href="tipe_form.php?action=update&id=<? echo $row['idtipe'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="tipe_process.php?action=delete&id=<? echo $row['idtipe'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
