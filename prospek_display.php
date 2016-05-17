 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data prospek sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idprospek"){ 
    dataString = 'starting='+page+'&idprospek='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "prospek"){ 
    dataString = 'starting='+page+'&prospek='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "phone"){ 
    dataString = 'starting='+page+'&phone='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "alamat"){ 
    dataString = 'starting='+page+'&alamat='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "catatan"){ 
    dataString = 'starting='+page+'&catatan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "marketing_idmarketing"){ 
    dataString = 'starting='+page+'&marketing_idmarketing='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektor_idsektor"){ 
    dataString = 'starting='+page+'&sektor_idsektor='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "kavling"){ 
    dataString = 'starting='+page+'&kavling='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"prospek_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data prospek, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idprospek"){ 
      dataString = 'idprospek='+ cari;  
   } 
   else if (combo == "prospek"){ 
      dataString = 'prospek='+ cari; 
    } 
   else if (combo == "phone"){ 
      dataString = 'phone='+ cari; 
    } 
   else if (combo == "alamat"){ 
      dataString = 'alamat='+ cari; 
    } 
   else if (combo == "catatan"){ 
      dataString = 'catatan='+ cari; 
    } 
   else if (combo == "marketing_idmarketing"){ 
      dataString = 'marketing_idmarketing='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
   else if (combo == "kavling"){ 
      dataString = 'kavling='+ cari; 
    } 
 
  $.ajax({ 
    url: "prospek_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#prospek tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#prospek tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data prospek ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("prospek_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data prospek berhasil di hapus!"); 
					} 
					else{ 
						alert("data prospek gagal di hapus!"); 
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
 
if (isset($_GET['idprospek']) and !empty($_GET['idprospek'])){ 
 $idprospek = $_GET['idprospek']; 
  $sql = "select * from prospek where idprospek like '%$idprospek%' order by idprospek"; 
} 
else if (isset($_GET['prospek']) and !empty($_GET['prospek'])){ 
 $prospek = $_GET['prospek']; 
  $sql = "select * from prospek where prospek like '%$prospek%' order by prospek"; 
} 
else if (isset($_GET['phone']) and !empty($_GET['phone'])){ 
 $phone = $_GET['phone']; 
  $sql = "select * from prospek where phone like '%$phone%' order by phone"; 
} 
else if (isset($_GET['alamat']) and !empty($_GET['alamat'])){ 
 $alamat = $_GET['alamat']; 
  $sql = "select * from prospek where alamat like '%$alamat%' order by alamat"; 
} 
else if (isset($_GET['catatan']) and !empty($_GET['catatan'])){ 
 $catatan = $_GET['catatan']; 
  $sql = "select * from prospek where catatan like '%$catatan%' order by catatan"; 
} 
else if (isset($_GET['marketing_idmarketing']) and !empty($_GET['marketing_idmarketing'])){ 
 $marketing_idmarketing = $_GET['marketing_idmarketing']; 
  $sql = "select * from prospek where marketing_idmarketing like '%$marketing_idmarketing%' order by marketing_idmarketing"; 
} 
else if (isset($_GET['sektor_idsektor']) and !empty($_GET['sektor_idsektor'])){ 
 $sektor_idsektor = $_GET['sektor_idsektor']; 
  $sql = "select * from prospek where sektor_idsektor like '%$sektor_idsektor%' order by sektor_idsektor"; 
} 
else if (isset($_GET['kavling']) and !empty($_GET['kavling'])){ 
 $kavling = $_GET['kavling']; 
  $sql = "select * from prospek where kavling like '%$kavling%' order by kavling"; 
} 
else{ 
  $sql = "select * from prospek"; 
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
	 
<p class="judul">Daftar prospek </p> 
  <table id="prospek"> 
  <tr> 
 <th>idprospek</th>
<th>prospek</th>
<th>phone</th>
<th>alamat</th>
<th>catatan</th>
<th>marketing_idmarketing</th>
<th>sektor_idsektor</th>
<th>kavling</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data prospek 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idprospek'];?></td>
<td><? echo $row['prospek'];?></td>
<td><? echo $row['phone'];?></td>
<td><? echo $row['alamat'];?></td>
<td><? echo $row['catatan'];?></td>
<td><? echo $row['marketing_idmarketing'];?></td>
<td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $row['kavling'];?></td>
 
        <td width="150px"> 
         <a href="prospek_detail.php?action=detail&id=<? echo $row['idprospek'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="prospek_form.php?action=update&id=<? echo $row['idprospek'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="prospek_process.php?action=delete&id=<? echo $row['idprospek'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
