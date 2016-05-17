 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data category sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcat"){ 
    dataString = 'starting='+page+'&idcat='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "catname"){ 
    dataString = 'starting='+page+'&catname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "margin"){ 
    dataString = 'starting='+page+'&margin='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"category_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data category, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcat"){ 
      dataString = 'idcat='+ cari;  
   } 
   else if (combo == "catname"){ 
      dataString = 'catname='+ cari; 
    } 
   else if (combo == "margin"){ 
      dataString = 'margin='+ cari; 
    } 
 
  $.ajax({ 
    url: "category_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#category tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#category tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data category ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("category_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data category berhasil di hapus!"); 
					} 
					else{ 
						alert("data category gagal di hapus!"); 
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
 
if (isset($_GET['idcat']) and !empty($_GET['idcat'])){ 
 $idcat = $_GET['idcat']; 
  $sql = "select * from category where idcat like '%$idcat%' order by idcat"; 
} 
else if (isset($_GET['catname']) and !empty($_GET['catname'])){ 
 $catname = $_GET['catname']; 
  $sql = "select * from category where catname like '%$catname%' order by catname"; 
} 
else if (isset($_GET['margin']) and !empty($_GET['margin'])){ 
 $margin = $_GET['margin']; 
  $sql = "select * from category where margin like '%$margin%' order by margin"; 
} 
else{ 
  $sql = "select * from category"; 
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
	 
  <table id="category" class="minigrid"> 
  <tr> 
 <th>Kode</th>
<th>Kategori</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data category 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td width="102px"><? echo $row['idcat'];?></td>
<td><? echo $row['catname'];?></td>
 
        <td width="102px"><a href="category_form.php?action=update&id=<? echo $row['idcat'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="category_process.php?action=delete&id=<? echo $row['idcat'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
