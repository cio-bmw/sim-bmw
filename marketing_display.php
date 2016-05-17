 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data marketing sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idmarketing"){ 
    dataString = 'starting='+page+'&idmarketing='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "marketing"){ 
    dataString = 'starting='+page+'&marketing='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "phone"){ 
    dataString = 'starting='+page+'&phone='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"marketing_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data marketing, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idmarketing"){ 
      dataString = 'idmarketing='+ cari;  
   } 
   else if (combo == "marketing"){ 
      dataString = 'marketing='+ cari; 
    } 
   else if (combo == "phone"){ 
      dataString = 'phone='+ cari; 
    } 
 
  $.ajax({ 
    url: "marketing_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#marketing tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#marketing tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data marketing ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("marketing_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data marketing berhasil di hapus!"); 
					} 
					else{ 
						alert("data marketing gagal di hapus!"); 
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
 
if (isset($_GET['idmarketing']) and !empty($_GET['idmarketing'])){ 
 $idmarketing = $_GET['idmarketing']; 
  $sql = "select * from marketing where idmarketing like '%$idmarketing%' order by idmarketing"; 
} 
else if (isset($_GET['marketing']) and !empty($_GET['marketing'])){ 
 $marketing = $_GET['marketing']; 
  $sql = "select * from marketing where marketing like '%$marketing%' order by marketing"; 
} 
else if (isset($_GET['phone']) and !empty($_GET['phone'])){ 
 $phone = $_GET['phone']; 
  $sql = "select * from marketing where phone like '%$phone%' order by phone"; 
} 
else{ 
  $sql = "select * from marketing"; 
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
	 
<p class="judul">Daftar Marketer</p> 
  <table id="marketing"> 
  <tr> 
 <th>ID Marketer</th>
<th>Nama</th>
<th>Telp./HP</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data marketing 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idmarketing'];?></td>
<td><? echo $row['marketing'];?></td>
<td><? echo $row['phone'];?></td>
 
        <td width="150px"> 
         <a href="marketing_detail.php?action=detail&id=<? echo $row['idmarketing'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="marketing_form.php?action=update&id=<? echo $row['idmarketing'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="marketing_process.php?action=delete&id=<? echo $row['idmarketing'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
