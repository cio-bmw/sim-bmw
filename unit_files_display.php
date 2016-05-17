 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unit_files sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#idunit").val(); 
 
  dataString = 'starting='+page+'&unit_idunit='+cari+'&random='+Math.random(); 
      
  $.ajax({ 
    url:"unit_files_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unit_files, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idunit").val(); 
   
  dataString = 'unit_idunit='+ cari; 
 
  $.ajax({ 
    url: "unit_files_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unit_files tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unit_files tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data unit_files ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("unit_files_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data unit_files berhasil di hapus!"); 
					} 
					else{ 
						alert("data unit_files gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 
	
$("#btntambah").click(function(){ 
		page="unit_files_form.php?idunit="+$("input#idunit").val(); 
		$("#divPageEntry").load(page); 
		$("#divPageEntry").show(); 
		
		pagelov="doccat_lov.php?idunit="+$("input#idunit").val(); 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		
		
		return false; 
	}); 
   
	
	 
}); 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
 
$unit_idunit = $_GET['unit_idunit']; 
 $sql = "select * from unit_files where unit_idunit like '%$unit_idunit%' order by unit_idunit"; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 

	 
  <table id="unit_files" width=98%> 
<tr>
  <td colspan="5">unit_files <select id="pilihcari">  
      <option value="idunit_files">idunit_files</option> 
      <option value="filename">filename</option> 
      <option value="filedesc">filedesc</option> 
      <option value="unit_idunit">unit_idunit</option> 
      <option value="doccat_iddoccat">doccat_iddoccat</option> 
      <option value="semua">Semua</option> 
  </select>
  <input type="text" name="fieldcari" id="fieldcari" value="%" /> 
  <input class="button" type="submit" value="Tampilkan" />
 <input  class="button" type="button" value="Tambah" id="btntambah">
  </td> </tr>  
  
  <tr> 
 <th>No</th>
<th>Nama File</th>
<th>Keterangan</th>
<th>Kategori</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unit_files 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idunit_files'];?></td>
<td><? echo $row['filename'];?></td>
<td><? echo $row['filedesc'];?></td>
<td><? echo $row['doccat_iddoccat'];?></td>
 
        <td width="120"><a href="unit_files_form.php?action=update&id=<? echo $row['idunit_files'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unit_files_process.php?action=delete&id=<? echo $row['idunit_files'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
