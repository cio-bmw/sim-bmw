 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data returnhdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idreturnhdr"){ 
    dataString = 'starting='+page+'&idreturnhdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "return_date"){ 
    dataString = 'starting='+page+'&return_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "catatan"){ 
    dataString = 'starting='+page+'&catatan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektor_idsektor"){ 
    dataString = 'starting='+page+'&sektor_idsektor='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"returnhdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data returnhdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idreturnhdr"){ 
      dataString = 'idreturnhdr='+ cari;  
   } 
   else if (combo == "return_date"){ 
      dataString = 'return_date='+ cari; 
    } 
   else if (combo == "catatan"){ 
      dataString = 'catatan='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
  $.ajax({ 
    url: "returnhdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#returnhdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#returnhdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data returnhdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("returnhdr_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data returnhdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data returnhdr gagal di hapus!"); 
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
 
if (isset($_GET['idreturnhdr']) and !empty($_GET['idreturnhdr'])){ 
 $idreturnhdr = $_GET['idreturnhdr']; 
  $sql = "select * from returnhdr where idreturnhdr like '%$idreturnhdr%' order by idreturnhdr"; 
} 
else if (isset($_GET['return_date']) and !empty($_GET['return_date'])){ 
 $return_date = $_GET['return_date']; 
  $sql = "select * from returnhdr where return_date like '%$return_date%' order by return_date"; 
} 
else if (isset($_GET['catatan']) and !empty($_GET['catatan'])){ 
 $catatan = $_GET['catatan']; 
  $sql = "select * from returnhdr where catatan like '%$catatan%' order by catatan"; 
} 
else if (isset($_GET['sektor_idsektor']) and !empty($_GET['sektor_idsektor'])){ 
 $sektor_idsektor = $_GET['sektor_idsektor']; 
  $sql = "select * from returnhdr where sektor_idsektor like '%$sektor_idsektor%' order by sektor_idsektor"; 
} 
else{ 
  $sql = "select * from returnhdr"; 
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
	 
  <table class="grid" id="returnhdr"> 
  <tr> 
 <th>No Dok</th>
<th>Tanggal</th>
<th>Asal Sektor</th>
<th>Status</th>
<th>catatan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data returnhdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  		$sektor =sektorinfo($row['sektor_idsektor']);
  		$sektorname = $sektor['sektorname'];	
  			 ?>		 
       <tr> 
 <td width="75px"><? echo $row['idreturnhdr'];?></td>
<td width="100px"><? echo $row['return_date'];?></td>
<td width="150px"><? echo $sektorname;?></td>
<td width="50px"><? echo $row['return_status'];?></td>
<td><? echo $row['catatan'];?></td>
 
        <td width="180px">
        <a href="returnhdr_detail.php?action=update&id=<? echo $row['idreturnhdr'];?>"> <input type="button" class="button" value="Detail"></a>  
        <a href="returnhdr_form.php?action=update&id=<? echo $row['idreturnhdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="returnhdr_process.php?action=delete&id=<? echo $row['idreturnhdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="6"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="6"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="6">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
