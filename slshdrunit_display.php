 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data slshdrunit sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("select#idsektor").val(); 
   
	 dataString = 'starting='+page+'&idsektor='+cari+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"slshdrunit_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data slshdrunit, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
   var cari = $("select#idsektor").val(); 
   
      dataString = 'idsektor='+ cari;  
 
  $.ajax({ 
    url: "slshdrunit_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#slshdrunit tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#slshdrunit tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data slshdrunit ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("slshdrunit_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data slshdrunit berhasil di hapus!"); 
					} 
					else{ 
						alert("data slshdrunit gagal di hapus!"); 
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
 
$kavling = $_GET['kavling'];
$idsektor = $_GET['idsektor']; 

if ($idsektor =='%' ) {
$sql = "select * from slshdrunit a, unit b 
where a.unit_idunit = b.idunit  and 
kavling like '%$kavling%' order by idslshdr desc"; 
} else {
$sql = "select * from slshdrunit a, unit b 
where a.unit_idunit = b.idunit  and b.sektor_idsektor = '$idsektor' and 
kavling like '%$kavling%' order by idslshdr desc"; 
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
	 
  <table id="slshdrunit" class="grid"> 
  <tr><td colspan="6"> Pengeluaran Barang Ke Unit</td></tr>
  <tr> 
 <th>No Dok</th>
<th>Tanggal</th>
<th>Sektor</th>
<th>Kavling</th>
<th>Status</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data slshdrunit 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
      $unit = unitinfo($row['unit_idunit']);
      $kavling = $unit['kavling'];
      $idsektor = $unit['sektor_idsektor'];
      $sektor = sektorinfo($idsektor);  			
      $sektorname = $sektor['sektorname'];  			
  			
  			
  			 ?>		 
       <tr> 
 <td><? echo $row['idslshdr'];?></td>
<td><? echo gettanggal($row['sls_date']);?></td>
<td><? echo $sektorname;?></td>
<td><? echo $kavling  ?></td>
<td><? echo $row['sls_status'];?></td>
 
        <td width="180px">
        <a href="slsdtlunit.php?id=<? echo $row['idslshdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>  
       | <a href="slshdrunit_form.php?action=update&id=<? echo $row['idslshdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="slshdrunit_process.php?action=delete&id=<? echo $row['idslshdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="6"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="6"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
