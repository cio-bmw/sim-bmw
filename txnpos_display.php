 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data txnpos sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxnpos"){ 
    dataString = 'starting='+page+'&idtxnpos='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "posname"){ 
    dataString = 'starting='+page+'&posname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"txnpos_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data txnpos, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxnpos"){ 
      dataString = 'idtxnpos='+ cari;  
   } 
   else if (combo == "posname"){ 
      dataString = 'posname='+ cari; 
    } 
 
  $.ajax({ 
    url: "txnpos_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#txnpos tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#txnpos tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data txnpos ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("txnpos_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data txnpos berhasil di hapus!"); 
					} 
					else{ 
						alert("data txnpos gagal di hapus!"); 
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
 
if (isset($_GET['idtxnpos']) and !empty($_GET['idtxnpos'])){ 
 $idtxnpos = $_GET['idtxnpos']; 
  $sql = "select * from txnpos where idtxnpos like '%$idtxnpos%' order by idtxnpos"; 
} 
else if (isset($_GET['posname']) and !empty($_GET['posname'])){ 
 $posname = $_GET['posname']; 
  $sql = "select * from txnpos where posname like '%$posname%' order by posname"; 
} 
else{ 
  $sql = "select * from txnpos"; 
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
	 
<p class="judul">Daftar Pos Transaksi Kas </p> 
  <table id="txnpos"> 
  <tr> 
 <th>Kode</th>
<th>Nama Pos</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data txnpos 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idtxnpos'];?></td>
<td><? echo $row['posname'];?></td>
 
        <td width="115px"> 
       <a href="txnpos_form.php?action=update&id=<? echo $row['idtxnpos'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="txnpos_process.php?action=delete&id=<? echo $row['idtxnpos'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
