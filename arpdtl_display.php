 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data arpdtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idarpdtl"){ 
    dataString = 'starting='+page+'&idarpdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pvalue"){ 
    dataString = 'starting='+page+'&pvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "arphdr_idarphdr"){ 
    dataString = 'starting='+page+'&arphdr_idarphdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "slshdrsektor_idslshdr"){ 
    dataString = 'starting='+page+'&slshdrsektor_idslshdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"arpdtl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data arpdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idarpdtl"){ 
      dataString = 'idarpdtl='+ cari;  
   } 
   else if (combo == "pvalue"){ 
      dataString = 'pvalue='+ cari; 
    } 
   else if (combo == "arphdr_idarphdr"){ 
      dataString = 'arphdr_idarphdr='+ cari; 
    } 
   else if (combo == "slshdrsektor_idslshdr"){ 
      dataString = 'slshdrsektor_idslshdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "arpdtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#arpdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#arpdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data arpdtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("arpdtl_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data arpdtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data arpdtl gagal di hapus!"); 
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
 
if (isset($_GET['idarpdtl']) and !empty($_GET['idarpdtl'])){ 
 $idarpdtl = $_GET['idarpdtl']; 
  $sql = "select * from arpdtl where idarpdtl like '%$idarpdtl%' order by idarpdtl"; 
} 
else if (isset($_GET['pvalue']) and !empty($_GET['pvalue'])){ 
 $pvalue = $_GET['pvalue']; 
  $sql = "select * from arpdtl where pvalue like '%$pvalue%' order by pvalue"; 
} 
else if (isset($_GET['arphdr_idarphdr']) and !empty($_GET['arphdr_idarphdr'])){ 
 $arphdr_idarphdr = $_GET['arphdr_idarphdr']; 
  $sql = "select * from arpdtl where arphdr_idarphdr like '%$arphdr_idarphdr%' order by arphdr_idarphdr"; 
} 
else if (isset($_GET['slshdrsektor_idslshdr']) and !empty($_GET['slshdrsektor_idslshdr'])){ 
 $slshdrsektor_idslshdr = $_GET['slshdrsektor_idslshdr']; 
  $sql = "select * from arpdtl where slshdrsektor_idslshdr like '%$slshdrsektor_idslshdr%' order by slshdrsektor_idslshdr"; 
} 
else{ 
  $sql = "select * from arpdtl"; 
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
	 
  <table id="arpdtl"> 
  <tr> 
 <th>idarpdtl</th>
<th>pvalue</th>
<th>arphdr_idarphdr</th>
<th>slshdrsektor_idslshdr</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data arpdtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idarpdtl'];?></td>
<td><? echo $row['pvalue'];?></td>
<td><? echo $row['arphdr_idarphdr'];?></td>
<td><? echo $row['slshdrsektor_idslshdr'];?></td>
 
        <td><a href="arpdtl_form.php?action=update&id=<? echo $row['idarpdtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="arpdtl_process.php?action=delete&id=<? echo $row['idarpdtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
