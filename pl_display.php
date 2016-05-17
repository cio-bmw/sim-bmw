 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpl"){ 
    dataString = 'starting='+page+'&idpl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "plname"){ 
    dataString = 'starting='+page+'&plname='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"pl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpl"){ 
      dataString = 'idpl='+ cari;  
   } 
   else if (combo == "plname"){ 
      dataString = 'plname='+ cari; 
    } 
 
  $.ajax({ 
    url: "pl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#pl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#pl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data pl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("pl_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data pl berhasil di hapus!"); 
					} 
					else{ 
						alert("data pl gagal di hapus!"); 
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
 
if (isset($_GET['idpl']) and !empty($_GET['idpl'])){ 
 $idpl = $_GET['idpl']; 
  $sql = "select * from pl where idpl like '%$idpl%' order by idpl"; 
} 
else if (isset($_GET['plname']) and !empty($_GET['plname'])){ 
 $plname = $_GET['plname']; 
  $sql = "select * from pl where plname like '%$plname%' order by plname"; 
} 
else{ 
  $sql = "select * from pl"; 
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
	 
<p class="judul">Daftar pl </p> 
  <table id="pl"> 
  <tr> 
 <th>idpl</th>
<th>plname</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idpl'];?></td>
<td><? echo $row['plname'];?></td>
 
        <td width="175px"> 
         <a href="plhdr.php?action=detail&id=<? echo $row['idpl'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="pl_form.php?action=update&id=<? echo $row['idpl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="pl_process.php?action=delete&id=<? echo $row['idpl'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
