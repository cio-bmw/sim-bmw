 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data spkcat sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idspkcat"){ 
    dataString = 'starting='+page+'&idspkcat='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "category"){ 
    dataString = 'starting='+page+'&category='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "spkdesc1"){ 
    dataString = 'starting='+page+'&spkdesc1='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "spkdesc2"){ 
    dataString = 'starting='+page+'&spkdesc2='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"spkcat_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data spkcat, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idspkcat"){ 
      dataString = 'idspkcat='+ cari;  
   } 
   else if (combo == "category"){ 
      dataString = 'category='+ cari; 
    } 
   else if (combo == "spkdesc1"){ 
      dataString = 'spkdesc1='+ cari; 
    } 
   else if (combo == "spkdesc2"){ 
      dataString = 'spkdesc2='+ cari; 
    } 
 
  $.ajax({ 
    url: "spkcat_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#spkcat tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#spkcat tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data spkcat ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("spkcat_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data spkcat berhasil di hapus!"); 
					} 
					else{ 
						alert("data spkcat gagal di hapus!"); 
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
 
if (isset($_GET['idspkcat']) and !empty($_GET['idspkcat'])){ 
 $idspkcat = $_GET['idspkcat']; 
  $sql = "select * from spkcat where idspkcat like '%$idspkcat%' order by idspkcat"; 
} 
else if (isset($_GET['category']) and !empty($_GET['category'])){ 
 $category = $_GET['category']; 
  $sql = "select * from spkcat where category like '%$category%' order by category"; 
} 
else if (isset($_GET['spkdesc1']) and !empty($_GET['spkdesc1'])){ 
 $spkdesc1 = $_GET['spkdesc1']; 
  $sql = "select * from spkcat where spkdesc1 like '%$spkdesc1%' order by spkdesc1"; 
} 
else if (isset($_GET['spkdesc2']) and !empty($_GET['spkdesc2'])){ 
 $spkdesc2 = $_GET['spkdesc2']; 
  $sql = "select * from spkcat where spkdesc2 like '%$spkdesc2%' order by spkdesc2"; 
} 
else{ 
  $sql = "select * from spkcat"; 
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
	 
  <table id="spkcat"> 
  <tr> 
 <th>idspkcat</th>
<th>category</th>
<th>spkdesc1</th>
<th>spkdesc2</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data spkcat 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idspkcat'];?></td>
<td><? echo $row['category'];?></td>
<td><? echo $row['spkdesc1'];?></td>
<td><? echo $row['spkdesc2'];?></td>
 
        <td><a href="spkcat_form.php?action=update&id=<? echo $row['idspkcat'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="spkcat_process.php?action=delete&id=<? echo $row['idspkcat'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
