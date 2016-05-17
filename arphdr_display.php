 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data arphdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idarphdr"){ 
    dataString = 'starting='+page+'&idarphdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "arphdr_date"){ 
    dataString = 'starting='+page+'&arphdr_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "arphdr_desc"){ 
    dataString = 'starting='+page+'&arphdr_desc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektor_idsektor"){ 
    dataString = 'starting='+page+'&sektor_idsektor='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"arphdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data arphdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idarphdr"){ 
      dataString = 'idarphdr='+ cari;  
   } 
   else if (combo == "arphdr_date"){ 
      dataString = 'arphdr_date='+ cari; 
    } 
   else if (combo == "arphdr_desc"){ 
      dataString = 'arphdr_desc='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
  $.ajax({ 
    url: "arphdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#arphdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#arphdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 

	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data arphdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("arphdr_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data arphdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data arphdr gagal di hapus!"); 
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
 
if (isset($_GET['idarphdr']) and !empty($_GET['idarphdr'])){ 
 $idarphdr = $_GET['idarphdr']; 
  $sql = "select * from arphdr where idarphdr like '%$idarphdr%' order by idarphdr"; 
} 
else if (isset($_GET['arphdr_date']) and !empty($_GET['arphdr_date'])){ 
 $arphdr_date = $_GET['arphdr_date']; 
  $sql = "select * from arphdr where arphdr_date like '%$arphdr_date%' order by arphdr_date"; 
} 
else if (isset($_GET['arphdr_desc']) and !empty($_GET['arphdr_desc'])){ 
 $arphdr_desc = $_GET['arphdr_desc']; 
  $sql = "select * from arphdr where arphdr_desc like '%$arphdr_desc%' order by arphdr_desc"; 
} 
else if (isset($_GET['sektor_idsektor']) and !empty($_GET['sektor_idsektor'])){ 
 $sektor_idsektor = $_GET['sektor_idsektor']; 
  $sql = "select * from arphdr where sektor_idsektor like '%$sektor_idsektor%' order by sektor_idsektor"; 
} 
else{ 
  $sql = "select * from arphdr"; 
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
	 
  <table id="arphdr"> 
  <tr> 
 <th>No Dok</th>
<th>Tanggal</th>

<th colspan=2>Sektor</th>
<th>Keterangan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data arphdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
  		$sektor = sektorinfo($row['sektor_idsektor']);
  			$sektorname = $sektor['sektorname'];
  		?>		 
       <tr> 
 <td><? echo $row['idarphdr'];?></td>
<td><? echo $row['arphdr_date'];?></td>
<td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $sektorname; ?></td>
<td><? echo $row['arphdr_desc'];?></td>

 
        <td>
        <a href="arpdtl.php?action=detail&id=<? echo $row['idarphdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>    
       | <a href="arphdr_form.php?action=update&id=<? echo $row['idarphdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="arphdr_process.php?action=delete&id=<? echo $row['idarphdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a>
       </td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="6"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="6"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="6">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
