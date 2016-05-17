 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data prospekflow sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idprospekflow"){ 
    dataString = 'starting='+page+'&idprospekflow='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "prospekflow"){ 
    dataString = 'starting='+page+'&prospekflow='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "dateflow"){ 
    dataString = 'starting='+page+'&dateflow='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "prospek_idprospek"){ 
    dataString = 'starting='+page+'&prospek_idprospek='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"prospekflow_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data prospekflow, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idprospekflow"){ 
      dataString = 'idprospekflow='+ cari;  
   } 
   else if (combo == "prospekflow"){ 
      dataString = 'prospekflow='+ cari; 
    } 
   else if (combo == "dateflow"){ 
      dataString = 'dateflow='+ cari; 
    } 
   else if (combo == "prospek_idprospek"){ 
      dataString = 'prospek_idprospek='+ cari; 
    } 
 
  $.ajax({ 
    url: "prospekflow_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#prospekflow tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#prospekflow tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data prospekflow ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("prospekflow_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data prospekflow berhasil di hapus!"); 
					} 
					else{ 
						alert("data prospekflow gagal di hapus!"); 
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
 
if (isset($_GET['idprospekflow']) and !empty($_GET['idprospekflow'])){ 
 $idprospekflow = $_GET['idprospekflow']; 
  $sql = "select * from prospekflow where idprospekflow like '%$idprospekflow%' order by idprospekflow"; 
} 
else if (isset($_GET['prospekflow']) and !empty($_GET['prospekflow'])){ 
 $prospekflow = $_GET['prospekflow']; 
  $sql = "select * from prospekflow where prospekflow like '%$prospekflow%' order by prospekflow"; 
} 
else if (isset($_GET['dateflow']) and !empty($_GET['dateflow'])){ 
 $dateflow = $_GET['dateflow']; 
  $sql = "select * from prospekflow where dateflow like '%$dateflow%' order by dateflow"; 
} 
else if (isset($_GET['prospek_idprospek']) and !empty($_GET['prospek_idprospek'])){ 
 $prospek_idprospek = $_GET['prospek_idprospek']; 
  $sql = "select * from prospekflow where prospek_idprospek like '%$prospek_idprospek%' order by prospek_idprospek"; 
} 
else{ 
  $sql = "select * from prospekflow"; 
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
	 
<p class="judul">Daftar prospekflow </p> 
  <table id="prospekflow"> 
  <tr> 
 <th>idprospekflow</th>
<th>prospekflow</th>
<th>dateflow</th>
<th>prospek_idprospek</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data prospekflow 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idprospekflow'];?></td>
<td><? echo $row['prospekflow'];?></td>
<td><? echo $row['dateflow'];?></td>
<td><? echo $row['prospek_idprospek'];?></td>
 
        <td width="150px"> 
         <a href="prospekflow_detail.php?action=detail&id=<? echo $row['idprospekflow'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="prospekflow_form.php?action=update&id=<? echo $row['idprospekflow'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="prospekflow_process.php?action=delete&id=<? echo $row['idprospekflow'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
