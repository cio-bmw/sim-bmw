 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data acc sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idacc"){ 
    dataString = 'starting='+page+'&idacc='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "accname"){ 
    dataString = 'starting='+page+'&accname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "accsaldo"){ 
    dataString = 'starting='+page+'&accsaldo='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "groupacc_idgroupacc"){ 
    dataString = 'starting='+page+'&groupacc_idgroupacc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"acc_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data acc, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idacc"){ 
      dataString = 'idacc='+ cari;  
   } 
   else if (combo == "accname"){ 
      dataString = 'accname='+ cari; 
    } 
   else if (combo == "accsaldo"){ 
      dataString = 'accsaldo='+ cari; 
    } 
   else if (combo == "groupacc_idgroupacc"){ 
      dataString = 'groupacc_idgroupacc='+ cari; 
    } 
 
  $.ajax({ 
    url: "acc_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#acc tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#acc tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data acc ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("acc_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data acc berhasil di hapus!"); 
					} 
					else{ 
						alert("data acc gagal di hapus!"); 
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
 
if (isset($_GET['idacc']) and !empty($_GET['idacc'])){ 
 $idacc = $_GET['idacc']; 
  $sql = "select * from acc where idacc like '%$idacc%' order by idacc"; 
} 
else if (isset($_GET['accname']) and !empty($_GET['accname'])){ 
 $accname = $_GET['accname']; 
  $sql = "select * from acc where accname like '%$accname%' order by accname"; 
} 
else if (isset($_GET['accsaldo']) and !empty($_GET['accsaldo'])){ 
 $accsaldo = $_GET['accsaldo']; 
  $sql = "select * from acc where accsaldo like '%$accsaldo%' order by accsaldo"; 
} 
else if (isset($_GET['groupacc_idgroupacc']) and !empty($_GET['groupacc_idgroupacc'])){ 
 $groupacc_idgroupacc = $_GET['groupacc_idgroupacc']; 
  $sql = "select * from acc where groupacc_idgroupacc like '%$groupacc_idgroupacc%' order by groupacc_idgroupacc"; 
} 
else{ 
  $sql = "select * from acc"; 
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
	 
<p class="judul">Daftar Kode Account</p> 
  <table id="acc"> 
  <tr> 
 <th>Kode</th>
<th>Nama Account</th>
<th>Group Account</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data acc 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
  		
  		?>		 
       <tr> 
 <td><? echo $row['idacc'];?></td>
<td><? echo $row['accname'];?></td>
<td><? echo $row['groupacc_idgroupacc'];?></td>
 
        <td width="100px"> 
          <a href="acc_form.php?action=update&id=<? echo $row['idacc'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="acc_process.php?action=delete&id=<? echo $row['idacc'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
