 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data soptype sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsoptype"){ 
    dataString = 'starting='+page+'&idsoptype='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "soptype"){ 
    dataString = 'starting='+page+'&soptype='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"soptype_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data soptype, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsoptype"){ 
      dataString = 'idsoptype='+ cari;  
   } 
   else if (combo == "soptype"){ 
      dataString = 'soptype='+ cari; 
    } 
 
  $.ajax({ 
    url: "soptype_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#soptype tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#soptype tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data soptype ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("soptype_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data soptype berhasil di hapus!"); 
					} 
					else{ 
						alert("data soptype gagal di hapus!"); 
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
 
if (isset($_GET['idsoptype']) and !empty($_GET['idsoptype'])){ 
 $idsoptype = $_GET['idsoptype']; 
  $sql = "select * from soptype where idsoptype like '%$idsoptype%' order by idsoptype"; 
} 
else if (isset($_GET['soptype']) and !empty($_GET['soptype'])){ 
 $soptype = $_GET['soptype']; 
  $sql = "select * from soptype where soptype like '%$soptype%' order by soptype"; 
} 
else{ 
  $sql = "select * from soptype"; 
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
	 
<p class="judul">Daftar soptype </p> 
  <table id="soptype"> 
  <tr> 
 <th>idsoptype</th>
<th>soptype</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data soptype 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idsoptype'];?></td>
<td><? echo $row['soptype'];?></td>
 
        <td width="150px"> 
         <a href="soptype_detail.php?action=detail&id=<? echo $row['idsoptype'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="soptype_form.php?action=update&id=<? echo $row['idsoptype'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="soptype_process.php?action=delete&id=<? echo $row['idsoptype'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
