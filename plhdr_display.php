 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data plhdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idplhdr"){ 
    dataString = 'starting='+page+'&idplhdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "plhdrname"){ 
    dataString = 'starting='+page+'&plhdrname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "plhdrseq"){ 
    dataString = 'starting='+page+'&plhdrseq='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pl_idpl"){ 
    dataString = 'starting='+page+'&pl_idpl='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "plhdrsdk"){ 
    dataString = 'starting='+page+'&plhdrsdk='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"plhdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data plhdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idplhdr"){ 
      dataString = 'idplhdr='+ cari;  
   } 
   else if (combo == "plhdrname"){ 
      dataString = 'plhdrname='+ cari; 
    } 
   else if (combo == "plhdrseq"){ 
      dataString = 'plhdrseq='+ cari; 
    } 
   else if (combo == "pl_idpl"){ 
      dataString = 'pl_idpl='+ cari; 
    } 
   else if (combo == "plhdrsdk"){ 
      dataString = 'plhdrsdk='+ cari; 
    } 
 
  $.ajax({ 
    url: "plhdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#plhdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#plhdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data plhdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("plhdr_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data plhdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data plhdr gagal di hapus!"); 
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
 
if (isset($_GET['idplhdr']) and !empty($_GET['idplhdr'])){ 
 $idplhdr = $_GET['idplhdr']; 
  $sql = "select * from plhdr where idplhdr like '%$idplhdr%' order by idplhdr"; 
} 
else if (isset($_GET['plhdrname']) and !empty($_GET['plhdrname'])){ 
 $plhdrname = $_GET['plhdrname']; 
  $sql = "select * from plhdr where plhdrname like '%$plhdrname%' order by plhdrname"; 
} 
else if (isset($_GET['plhdrseq']) and !empty($_GET['plhdrseq'])){ 
 $plhdrseq = $_GET['plhdrseq']; 
  $sql = "select * from plhdr where plhdrseq like '%$plhdrseq%' order by plhdrseq"; 
} 
else if (isset($_GET['pl_idpl']) and !empty($_GET['pl_idpl'])){ 
 $pl_idpl = $_GET['pl_idpl']; 
  $sql = "select * from plhdr where pl_idpl like '%$pl_idpl%' order by pl_idpl"; 
} 
else if (isset($_GET['plhdrsdk']) and !empty($_GET['plhdrsdk'])){ 
 $plhdrsdk = $_GET['plhdrsdk']; 
  $sql = "select * from plhdr where plhdrsdk like '%$plhdrsdk%' order by plhdrsdk"; 
} 
else{ 
  $sql = "select * from plhdr"; 
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
	 
<p class="judul">Detail Template Laporan Rugi Laba</p> 
  <table id="plhdr"> 
  <tr> 
 <th>idplhdr</th>
<th>plhdrname</th>
<th>plhdrseq</th>
<th>pl_idpl</th>
<th>plhdrsdk</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data plhdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idplhdr'];?></td>
<td><? echo $row['plhdrname'];?></td>
<td><? echo $row['plhdrseq'];?></td>
<td><? echo $row['pl_idpl'];?></td>
<td><? echo $row['plhdrsdk'];?></td>
 
        <td width="175px"> 
         <a href="plhdr_detail.php?action=detail&id=<? echo $row['idplhdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="plhdr_form.php?action=update&id=<? echo $row['idplhdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="plhdr_process.php?action=delete&id=<? echo $row['idplhdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
