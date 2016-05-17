 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data accsetting sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaccsetting"){ 
    dataString = 'starting='+page+'&idaccsetting='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "app"){ 
    dataString = 'starting='+page+'&app='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "dacc_idacc"){ 
    dataString = 'starting='+page+'&dacc_idacc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kacc_idacc"){ 
    dataString = 'starting='+page+'&kacc_idacc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"accsetting_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data accsetting, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idaccsetting"){ 
      dataString = 'idaccsetting='+ cari;  
   } 
   else if (combo == "app"){ 
      dataString = 'app='+ cari; 
    } 
   else if (combo == "dacc_idacc"){ 
      dataString = 'dacc_idacc='+ cari; 
    } 
   else if (combo == "kacc_idacc"){ 
      dataString = 'kacc_idacc='+ cari; 
    } 
 
  $.ajax({ 
    url: "accsetting_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#accsetting tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#accsetting tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data accsetting ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("accsetting_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data accsetting berhasil di hapus!"); 
					} 
					else{ 
						alert("data accsetting gagal di hapus!"); 
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
 
if (isset($_GET['idaccsetting']) and !empty($_GET['idaccsetting'])){ 
 $idaccsetting = $_GET['idaccsetting']; 
  $sql = "select * from accsetting where idaccsetting like '%$idaccsetting%' order by idaccsetting"; 
} 
else if (isset($_GET['app']) and !empty($_GET['app'])){ 
 $app = $_GET['app']; 
  $sql = "select * from accsetting where app like '%$app%' order by app"; 
} 
else if (isset($_GET['dacc_idacc']) and !empty($_GET['dacc_idacc'])){ 
 $dacc_idacc = $_GET['dacc_idacc']; 
  $sql = "select * from accsetting where dacc_idacc like '%$dacc_idacc%' order by dacc_idacc"; 
} 
else if (isset($_GET['kacc_idacc']) and !empty($_GET['kacc_idacc'])){ 
 $kacc_idacc = $_GET['kacc_idacc']; 
  $sql = "select * from accsetting where kacc_idacc like '%$kacc_idacc%' order by kacc_idacc"; 
} 
else{ 
  $sql = "select * from accsetting"; 
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
	 
<p class="judul">Daftar accsetting </p> 
  <table id="accsetting"> 
  <tr> 
 <th>idaccsetting</th>
<th>app</th>
<th>dacc_idacc</th>
<th>kacc_idacc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data accsetting 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idaccsetting'];?></td>
<td><? echo $row['app'];?></td>
<td><? echo $row['dacc_idacc'];?></td>
<td><? echo $row['kacc_idacc'];?></td>
 
        <td width="150px"> 
         <a href="accsetting_detail.php?action=detail&id=<? echo $row['idaccsetting'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="accsetting_form.php?action=update&id=<? echo $row['idaccsetting'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="accsetting_process.php?action=delete&id=<? echo $row['idaccsetting'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
