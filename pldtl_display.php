 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pldtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpldtl"){ 
    dataString = 'starting='+page+'&idpldtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "plhdr_idplhdr"){ 
    dataString = 'starting='+page+'&plhdr_idplhdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "acc_idacc"){ 
    dataString = 'starting='+page+'&acc_idacc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"pldtl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pldtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpldtl"){ 
      dataString = 'idpldtl='+ cari;  
   } 
   else if (combo == "plhdr_idplhdr"){ 
      dataString = 'plhdr_idplhdr='+ cari; 
    } 
   else if (combo == "acc_idacc"){ 
      dataString = 'acc_idacc='+ cari; 
    } 
 
  $.ajax({ 
    url: "pldtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#pldtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#pldtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data pldtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("pldtl_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data pldtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data pldtl gagal di hapus!"); 
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
 
if (isset($_GET['idpldtl']) and !empty($_GET['idpldtl'])){ 
 $idpldtl = $_GET['idpldtl']; 
  $sql = "select * from pldtl where idpldtl like '%$idpldtl%' order by idpldtl"; 
} 
else if (isset($_GET['plhdr_idplhdr']) and !empty($_GET['plhdr_idplhdr'])){ 
 $plhdr_idplhdr = $_GET['plhdr_idplhdr']; 
  $sql = "select * from pldtl where plhdr_idplhdr like '%$plhdr_idplhdr%' order by plhdr_idplhdr"; 
} 
else if (isset($_GET['acc_idacc']) and !empty($_GET['acc_idacc'])){ 
 $acc_idacc = $_GET['acc_idacc']; 
  $sql = "select * from pldtl where acc_idacc like '%$acc_idacc%' order by acc_idacc"; 
} 
else{ 
  $sql = "select * from pldtl"; 
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
	 
<p class="judul">Daftar pldtl </p> 
  <table id="pldtl"> 
  <tr> 
 <th>idpldtl</th>
<th>plhdr_idplhdr</th>
<th>acc_idacc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pldtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idpldtl'];?></td>
<td><? echo $row['plhdr_idplhdr'];?></td>
<td><? echo $row['acc_idacc'];?></td>
 
        <td width="175px"> 
         <a href="pldtl_detail.php?action=detail&id=<? echo $row['idpldtl'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="pldtl_form.php?action=update&id=<? echo $row['idpldtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="pldtl_process.php?action=delete&id=<? echo $row['idpldtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
