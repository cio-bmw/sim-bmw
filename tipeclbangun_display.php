 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data tipeclbangun sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtipeclbangun"){ 
    dataString = 'starting='+page+'&idtipeclbangun='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "bobotpct"){ 
    dataString = 'starting='+page+'&bobotpct='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "tipe_idtipe"){ 
    dataString = 'starting='+page+'&tipe_idtipe='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "clbangun_idclbangun"){ 
    dataString = 'starting='+page+'&clbangun_idclbangun='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"tipeclbangun_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data tipeclbangun, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtipeclbangun"){ 
      dataString = 'idtipeclbangun='+ cari;  
   } 
   else if (combo == "bobotpct"){ 
      dataString = 'bobotpct='+ cari; 
    } 
   else if (combo == "tipe_idtipe"){ 
      dataString = 'tipe_idtipe='+ cari; 
    } 
   else if (combo == "clbangun_idclbangun"){ 
      dataString = 'clbangun_idclbangun='+ cari; 
    } 
 
  $.ajax({ 
    url: "tipeclbangun_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#tipeclbangun tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#tipeclbangun tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data tipeclbangun ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("tipeclbangun_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data tipeclbangun berhasil di hapus!"); 
					} 
					else{ 
						alert("data tipeclbangun gagal di hapus!"); 
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
 
if (isset($_GET['idtipeclbangun']) and !empty($_GET['idtipeclbangun'])){ 
 $idtipeclbangun = $_GET['idtipeclbangun']; 
  $sql = "select * from tipeclbangun where idtipeclbangun like '%$idtipeclbangun%' order by idtipeclbangun"; 
} 
else if (isset($_GET['bobotpct']) and !empty($_GET['bobotpct'])){ 
 $bobotpct = $_GET['bobotpct']; 
  $sql = "select * from tipeclbangun where bobotpct like '%$bobotpct%' order by bobotpct"; 
} 
else if (isset($_GET['tipe_idtipe']) and !empty($_GET['tipe_idtipe'])){ 
 $tipe_idtipe = $_GET['tipe_idtipe']; 
  $sql = "select * from tipeclbangun where tipe_idtipe like '%$tipe_idtipe%' order by tipe_idtipe"; 
} 
else if (isset($_GET['clbangun_idclbangun']) and !empty($_GET['clbangun_idclbangun'])){ 
 $clbangun_idclbangun = $_GET['clbangun_idclbangun']; 
  $sql = "select * from tipeclbangun where clbangun_idclbangun like '%$clbangun_idclbangun%' order by clbangun_idclbangun"; 
} 
else{ 
  $sql = "select * from tipeclbangun"; 
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
	 
  <table id="tipeclbangun"> 
  <tr> 
 <th>idtipeclbangun</th>
<th>bobotpct</th>
<th>tipe_idtipe</th>
<th>clbangun_idclbangun</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data tipeclbangun 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtipeclbangun'];?></td>
<td><? echo $row['bobotpct'];?></td>
<td><? echo $row['tipe_idtipe'];?></td>
<td><? echo $row['clbangun_idclbangun'];?></td>
 
        <td><a href="tipeclbangun_form.php?action=update&id=<? echo $row['idtipeclbangun'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="tipeclbangun_process.php?action=delete&id=<? echo $row['idtipeclbangun'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
