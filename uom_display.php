 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data uom sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "iduom"){ 
    dataString = 'starting='+page+'&iduom='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "uomname"){ 
    dataString = 'starting='+page+'&uomname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"uom_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data uom, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "iduom"){ 
      dataString = 'iduom='+ cari;  
   } 
   else if (combo == "uomname"){ 
      dataString = 'uomname='+ cari; 
    } 
 
  $.ajax({ 
    url: "uom_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#uom tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#uom tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data uom ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("uom_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data uom berhasil di hapus!"); 
					} 
					else{ 
						alert("data uom gagal di hapus!"); 
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
 
if (isset($_GET['iduom']) and !empty($_GET['iduom'])){ 
 $iduom = $_GET['iduom']; 
  $sql = "select * from uom where iduom like '%$iduom%' order by iduom"; 
} 
else if (isset($_GET['uomname']) and !empty($_GET['uomname'])){ 
 $uomname = $_GET['uomname']; 
  $sql = "select * from uom where uomname like '%$uomname%' order by uomname"; 
} 
else{ 
  $sql = "select * from uom"; 
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
	 
  <table class="minigrid" id="uom"> 
  <tr> 
 <th>Kode</th>
<th>Satuan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data uom 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td width="102px"><? echo $row['iduom'];?></td>
<td><? echo $row['uomname'];?></td>
 
        <td width="102px"><a href="uom_form.php?action=update&id=<? echo $row['iduom'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="uom_process.php?action=delete&id=<? echo $row['iduom'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
