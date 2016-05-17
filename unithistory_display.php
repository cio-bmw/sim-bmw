 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unithistory sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunithistory"){ 
    dataString = 'starting='+page+'&idunithistory='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "namauser"){ 
    dataString = 'starting='+page+'&namauser='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "tglmundur"){ 
    dataString = 'starting='+page+'&tglmundur='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "alasan"){ 
    dataString = 'starting='+page+'&alasan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unit_idunit"){ 
    dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"unithistory_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unithistory, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunithistory"){ 
      dataString = 'idunithistory='+ cari;  
   } 
   else if (combo == "namauser"){ 
      dataString = 'namauser='+ cari; 
    } 
   else if (combo == "tglmundur"){ 
      dataString = 'tglmundur='+ cari; 
    } 
   else if (combo == "alasan"){ 
      dataString = 'alasan='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
 
  $.ajax({ 
    url: "unithistory_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unithistory tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unithistory tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data unithistory ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("unithistory_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data unithistory berhasil di hapus!"); 
					} 
					else{ 
						alert("data unithistory gagal di hapus!"); 
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
 
if (isset($_GET['idunithistory']) and !empty($_GET['idunithistory'])){ 
 $idunithistory = $_GET['idunithistory']; 
  $sql = "select * from unithistory where idunithistory like '%$idunithistory%' order by idunithistory"; 
} 
else if (isset($_GET['namauser']) and !empty($_GET['namauser'])){ 
 $namauser = $_GET['namauser']; 
  $sql = "select * from unithistory where namauser like '%$namauser%' order by namauser"; 
} 
else if (isset($_GET['tglmundur']) and !empty($_GET['tglmundur'])){ 
 $tglmundur = $_GET['tglmundur']; 
  $sql = "select * from unithistory where tglmundur like '%$tglmundur%' order by tglmundur"; 
} 
else if (isset($_GET['alasan']) and !empty($_GET['alasan'])){ 
 $alasan = $_GET['alasan']; 
  $sql = "select * from unithistory where alasan like '%$alasan%' order by alasan"; 
} 
else if (isset($_GET['unit_idunit']) and !empty($_GET['unit_idunit'])){ 
 $unit_idunit = $_GET['unit_idunit']; 
  $sql = "select * from unithistory where unit_idunit like '%$unit_idunit%' order by unit_idunit"; 
} 
else{ 
  $sql = "select * from unithistory"; 
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
	 
<p class="judul">Daftar unithistory </p> 
  <table id="unithistory"   style="min-width:500px;"> 
  <tr> 
 <th>Id</th>
<th>Sektor</th>
<th>Idunit</th>
<th>Kavling</th>
<th>Nama User</th>
<th>Tanggal</th>
<th>Alasan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unithistory 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
		$unit = unitinfo($row['unit_idunit']);
		$kavling = $unit['kavling'];
		$idsektor = $unit['sektor_idsektor'];

		$sektor = sektorinfo($idsektor);
  		$sektorname = $sektor['sektorname']; 


?>		
       <tr> 
 <td><? echo $row['idunithistory'];?></td>
<td><? echo $sektorname;?></td>
<td><? echo $row['unit_idunit'];?></td>
<td><? echo $kavling;?></td>
<td><? echo $row['namauser'];?></td>
<td><? echo gettanggal($row ['tglmundur']);?></td>
<td><? echo $row['alasan'];?></td>

 
        <td width="160px"> 
         <a href="unithistory_detail.php?action=detail&id=<? echo $row['idunithistory'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="unithistory_form.php?action=update&id=<? echo $row['idunithistory'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unithistory_process.php?action=delete&id=<? echo $row['idunithistory'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
