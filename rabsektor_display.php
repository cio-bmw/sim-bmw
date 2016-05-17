 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idrabsektor"){ 
    dataString = 'starting='+page+'&idrabsektor='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "qtyrab"){ 
    dataString = 'starting='+page+'&qtyrab='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rabprice"){ 
    dataString = 'starting='+page+'&rabprice='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektor_idsektor"){ 
    dataString = 'starting='+page+'&sektor_idsektor='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rabmst_idrabmst"){ 
    dataString = 'starting='+page+'&rabmst_idrabmst='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"rabsektor_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pelanggan, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idrabsektor"){ 
      dataString = 'idrabsektor='+ cari;  
   } 
   else if (combo == "qtyrab"){ 
      dataString = 'qtyrab='+ cari; 
    } 
   else if (combo == "rabprice"){ 
      dataString = 'rabprice='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
   else if (combo == "rabmst_idrabmst"){ 
      dataString = 'rabmst_idrabmst='+ cari; 
    } 
 
  $.ajax({ 
    url: "rabsektor_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#rabsektor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#rabsektor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data rabsektor ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("rabsektor_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data rabsektor berhasil di hapus!"); 
					} 
					else{ 
						alert("data rabsektor gagal di hapus!"); 
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
 
if (isset($_GET['idrabsektor']) and !empty($_GET['idrabsektor'])){ 
 $idrabsektor = $_GET['idrabsektor']; 
  $sql = "select * from rabsektor where idrabsektor like '%$idrabsektor%' order by idrabsektor"; 
} 
else if (isset($_GET['qtyrab']) and !empty($_GET['qtyrab'])){ 
 $qtyrab = $_GET['qtyrab']; 
  $sql = "select * from rabsektor where qtyrab like '%$qtyrab%' order by qtyrab"; 
} 
else if (isset($_GET['rabprice']) and !empty($_GET['rabprice'])){ 
 $rabprice = $_GET['rabprice']; 
  $sql = "select * from rabsektor where rabprice like '%$rabprice%' order by rabprice"; 
} 
else if (isset($_GET['sektor_idsektor']) and !empty($_GET['sektor_idsektor'])){ 
 $sektor_idsektor = $_GET['sektor_idsektor']; 
  $sql = "select * from rabsektor where sektor_idsektor like '%$sektor_idsektor%' order by sektor_idsektor"; 
} 
else if (isset($_GET['rabmst_idrabmst']) and !empty($_GET['rabmst_idrabmst'])){ 
 $rabmst_idrabmst = $_GET['rabmst_idrabmst']; 
  $sql = "select * from rabsektor where rabmst_idrabmst like '%$rabmst_idrabmst%' order by rabmst_idrabmst"; 
} 
else{ 
  $sql = "select * from rabsektor"; 
} 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="rabsektor"> 
  <tr> 
 <th>idrabsektor</th>
<th>qtyrab</th>
<th>rabprice</th>
<th>sektor_idsektor</th>
<th>rabmst_idrabmst</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idrabsektor'];?></td>
<td><? echo $row['qtyrab'];?></td>
<td><? echo $row['rabprice'];?></td>
<td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $row['rabmst_idrabmst'];?></td>
 
        <td><a href="rabsektor_form.php?action=update&id=<? echo $row['idrabsektor'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idrabsektor'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
