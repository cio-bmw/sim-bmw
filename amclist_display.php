 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data amclist sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idamclist"){ 
    dataString = 'starting='+page+'&idamclist='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "amclist"){ 
    dataString = 'starting='+page+'&amclist='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "amclistseq"){ 
    dataString = 'starting='+page+'&amclistseq='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"amclist_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data amclist, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idamclist"){ 
      dataString = 'idamclist='+ cari;  
   } 
   else if (combo == "amclist"){ 
      dataString = 'amclist='+ cari; 
    } 
   else if (combo == "amclistseq"){ 
      dataString = 'amclistseq='+ cari; 
    } 
 
  $.ajax({ 
    url: "amclist_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#amclist tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#amclist tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data amclist ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("amclist_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data amclist berhasil di hapus!"); 
					} 
					else{ 
						alert("data amclist gagal di hapus!"); 
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
 
if (isset($_GET['idamclist']) and !empty($_GET['idamclist'])){ 
 $idamclist = $_GET['idamclist']; 
  $sql = "select * from amclist where idamclist like '%$idamclist%' order by idamclist"; 
} 
else if (isset($_GET['amclist']) and !empty($_GET['amclist'])){ 
 $amclist = $_GET['amclist']; 
  $sql = "select * from amclist where amclist like '%$amclist%' order by amclist"; 
} 
else if (isset($_GET['amclistseq']) and !empty($_GET['amclistseq'])){ 
 $amclistseq = $_GET['amclistseq']; 
  $sql = "select * from amclist where amclistseq like '%$amclistseq%' order by amclistseq"; 
} 
else{ 
  $sql = "select * from amclist"; 
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
	 
<p class="judul">Daftar Check List</p> 
  <table id="amclist"> 
  <tr> 
 <th>Kode</th>
<th>Keterangan</th>
<th>Urutan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data amclist 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idamclist'];?></td>
<td><? echo $row['amclist'];?></td>
<td><? echo $row['amclistseq'];?></td>
 
        <td width="105px"> 
         <a href="amclist_detail.php?action=detail&id=<? echo $row['idamclist'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="amclist_form.php?action=update&id=<? echo $row['idamclist'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="amclist_process.php?action=delete&id=<? echo $row['idamclist'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
