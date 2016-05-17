 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idstockloc"){ 
    dataString = 'starting='+page+'&idstockloc='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "stocklocname"){ 
    dataString = 'starting='+page+'&stocklocname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"stockloc_display.php", 
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
   
	  if (combo == "idstockloc"){ 
      dataString = 'idstockloc='+ cari;  
   } 
   else if (combo == "stocklocname"){ 
      dataString = 'stocklocname='+ cari; 
    } 
 
  $.ajax({ 
    url: "stockloc_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#stockloc tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#stockloc tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data stockloc ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("stockloc_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data stockloc berhasil di hapus!"); 
					} 
					else{ 
						alert("data stockloc gagal di hapus!"); 
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
 
if (isset($_GET['idstockloc']) and !empty($_GET['idstockloc'])){ 
 $idstockloc = $_GET['idstockloc']; 
  $sql = "select * from stockloc where idstockloc like '%$idstockloc%' order by idstockloc"; 
} 
else if (isset($_GET['stocklocname']) and !empty($_GET['stocklocname'])){ 
 $stocklocname = $_GET['stocklocname']; 
  $sql = "select * from stockloc where stocklocname like '%$stocklocname%' order by stocklocname"; 
} 
else{ 
  $sql = "select * from stockloc"; 
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
	 
  <table id="stockloc"> 
  <tr> 
 <th>idstockloc</th>
<th>stocklocname</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idstockloc'];?></td>
<td><? echo $row['stocklocname'];?></td>
 
        <td><a href="stockloc_form.php?action=update&id=<? echo $row['idstockloc'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idstockloc'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
