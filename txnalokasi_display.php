 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data txnalokasi sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxnalokasi"){ 
    dataString = 'starting='+page+'&idtxnalokasi='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "alokasiname"){ 
    dataString = 'starting='+page+'&alokasiname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"txnalokasi_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data txnalokasi, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxnalokasi"){ 
      dataString = 'idtxnalokasi='+ cari;  
   } 
   else if (combo == "alokasiname"){ 
      dataString = 'alokasiname='+ cari; 
    } 
 
  $.ajax({ 
    url: "txnalokasi_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#txnalokasi tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#txnalokasi tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data txnalokasi ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("txnalokasi_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data txnalokasi berhasil di hapus!"); 
					} 
					else{ 
						alert("data txnalokasi gagal di hapus!"); 
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
 
if (isset($_GET['idtxnalokasi']) and !empty($_GET['idtxnalokasi'])){ 
 $idtxnalokasi = $_GET['idtxnalokasi']; 
  $sql = "select * from txnalokasi where idtxnalokasi like '%$idtxnalokasi%' order by idtxnalokasi"; 
} 
else if (isset($_GET['alokasiname']) and !empty($_GET['alokasiname'])){ 
 $alokasiname = $_GET['alokasiname']; 
  $sql = "select * from txnalokasi where alokasiname like '%$alokasiname%' order by alokasiname"; 
} 
else{ 
  $sql = "select * from txnalokasi"; 
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
	 
<p class="judul">Daftar Alokasi Transaksi Kas </p> 
  <table id="txnalokasi"> 
  <tr> 
 <th>Kode</th>
<th>Nama Alokasi</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data txnalokasi 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtxnalokasi'];?></td>
<td><? echo $row['alokasiname'];?></td>
 
        <td width="115px"> 
        <a href="txnalokasi_form.php?action=update&id=<? echo $row['idtxnalokasi'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="txnalokasi_process.php?action=delete&id=<? echo $row['idtxnalokasi'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
