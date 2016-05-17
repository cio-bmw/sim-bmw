 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data costcenter sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcostcenter"){ 
    dataString = 'starting='+page+'&idcostcenter='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "costcentername"){ 
    dataString = 'starting='+page+'&costcentername='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"costcenter_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data costcenter, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcostcenter"){ 
      dataString = 'idcostcenter='+ cari;  
   } 
   else if (combo == "costcentername"){ 
      dataString = 'costcentername='+ cari; 
    } 
 
  $.ajax({ 
    url: "costcenter_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#costcenter tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#costcenter tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data costcenter ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("costcenter_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data costcenter berhasil di hapus!"); 
					} 
					else{ 
						alert("data costcenter gagal di hapus!"); 
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
 
if (isset($_GET['idcostcenter']) and !empty($_GET['idcostcenter'])){ 
 $idcostcenter = $_GET['idcostcenter']; 
  $sql = "select * from costcenter where idcostcenter like '%$idcostcenter%' order by idcostcenter"; 
} 
else if (isset($_GET['costcentername']) and !empty($_GET['costcentername'])){ 
 $costcentername = $_GET['costcentername']; 
  $sql = "select * from costcenter where costcentername like '%$costcentername%' order by costcentername"; 
} 
else{ 
  $sql = "select * from costcenter"; 
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
	 
<p class="judul">Daftar costcenter </p> 
  <table id="costcenter"> 
  <tr> 
 <th>idcostcenter</th>
<th>costcentername</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data costcenter 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcostcenter'];?></td>
<td><? echo $row['costcentername'];?></td>
 
        <td width="150px"> 
         <a href="costcenter_detail.php?action=detail&id=<? echo $row['idcostcenter'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="costcenter_form.php?action=update&id=<? echo $row['idcostcenter'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="costcenter_process.php?action=delete&id=<? echo $row['idcostcenter'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
