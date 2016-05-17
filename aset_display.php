 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data aset sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaset"){ 
    dataString = 'starting='+page+'&idaset='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "asetname"){ 
    dataString = 'starting='+page+'&asetname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "asetvalue"){ 
    dataString = 'starting='+page+'&asetvalue='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"aset_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data aset, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaset"){ 
      dataString = 'idaset='+ cari;  
   } 
   else if (combo == "asetname"){ 
      dataString = 'asetname='+ cari; 
    } 
   else if (combo == "asetvalue"){ 
      dataString = 'asetvalue='+ cari; 
    } 
 
  $.ajax({ 
    url: "aset_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#aset tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#aset tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data aset ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("aset_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data aset berhasil di hapus!"); 
					} 
					else{ 
						alert("data aset gagal di hapus!"); 
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
 
if (isset($_GET['idaset']) and !empty($_GET['idaset'])){ 
 $idaset = $_GET['idaset']; 
  $sql = "select * from aset where idaset like '%$idaset%' order by idaset"; 
} 
else if (isset($_GET['asetname']) and !empty($_GET['asetname'])){ 
 $asetname = $_GET['asetname']; 
  $sql = "select * from aset where asetname like '%$asetname%' order by asetname"; 
} 
else if (isset($_GET['asetvalue']) and !empty($_GET['asetvalue'])){ 
 $asetvalue = $_GET['asetvalue']; 
  $sql = "select * from aset where asetvalue like '%$asetvalue%' order by asetvalue"; 
} 
else{ 
  $sql = "select * from aset"; 
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
	 
  <table id="aset"> 
  <tr> 
 <th>idaset</th>
<th>asetname</th>
<th>asetvalue</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data aset 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idaset'];?></td>
<td><? echo $row['asetname'];?></td>
<td><? echo $row['asetvalue'];?></td>
 
        <td><a href="aset_form.php?action=update&id=<? echo $row['idaset'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="aset_process.php?action=delete&id=<? echo $row['idaset'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
