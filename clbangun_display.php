 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data clbangun sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
   var vspkcat = $("select#idspkcat").val(); 
   

    dataString = 'starting='+page+'&spkcat='+vspkcat+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"clbangun_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data clbangun, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
 var vspkcat = $("select#idspkcat").val(); 
 
 dataString = 'spkcat='+ vspkcat; 
 
  $.ajax({ 
    url: "clbangun_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#clbangun tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#clbangun tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data clbangun ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("clbangun_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data clbangun berhasil di hapus!"); 
					} 
					else{ 
						alert("data clbangun gagal di hapus!"); 
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
 
 $spkcat_idspkcat = $_GET['spkcat']; 
 $sql = "select * from clbangun where spkcat_idspkcat like '%$spkcat_idspkcat%' order by spkcat_idspkcat"; 

 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 	<p class="judul">Master Check List Progres SPK</p> 
  <table id="clbangun" class="grid"> 
  <tr> 
 <th>ID</th>
 <th>Kategori</th>
<th>Keterangan</th>
<th>(%)</th>
<th>workdays</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data clbangun 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
      $spkcat = spkcatinfo($row['spkcat_idspkcat']);
      $category = $spkcat['category'];  		  		
  		?>		 
       <tr> 
 <td><? echo $row['idclbangun'];?></td>
 <td><? echo $category;?></td>
<td><? echo $row['clbangundesc'];?></td>
<td class="right"><? echo $row['bobotpct'];?></td>
<td  class="right"><? echo $row['workdays'];?></td>
 
        <td width="105px"><a href="clbangun_form.php?action=update&id=<? echo $row['idclbangun'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="clbangun_process.php?action=delete&id=<? echo $row['idclbangun'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
