 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data gldtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idgldtl"){ 
    dataString = 'starting='+page+'&idgldtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "glhdr_idglhdr"){ 
    dataString = 'starting='+page+'&glhdr_idglhdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Dvalue"){ 
    dataString = 'starting='+page+'&Dvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "Kvalue"){ 
    dataString = 'starting='+page+'&Kvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "acc_idacc"){ 
    dataString = 'starting='+page+'&acc_idacc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"gldtl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data gldtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  dataString = 'id='+ cari; 
 
  $.ajax({ 
    url: "gldtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#gldtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#gldtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
 var vstatus = $("input#gl_status").val();	
	
	if  (vstatus == 'posted') {
	alert('Data Sudah Posting tidak bisa di Edit, unposting dulu');	
	return false;
	} else {	
	
		page=$(this).attr("href"); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		return false; 
   }

	}); 
	 
	$("a.detail").click(function(){ 
		window.location=$(this).attr("href"); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
   var vstatus = $("input#gl_status").val();	
	
	if  (vstatus == 'posted') {
	alert('Data Sudah Posting tidak bisa di delete, un posting dulu');	
	return false;
	} else {
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data gldtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("gldtl_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data gldtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data gldtl gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}	
	}); 
	
	
	 
}); 
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
 
$glhdr_idglhdr = $_GET['id']; 
$sql = "select * from gldtl where glhdr_idglhdr like '%$glhdr_idglhdr%' order by glhdr_idglhdr"; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
<p class="judul">Journal Detail</p> 
  <table id="gldtl" width="450px">  
  <tr> 
<th>No Acc</th>
<th>Keterangan</th>
<th>Debet</th>
<th>Kredit</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data gldtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
$acc=accinfo($row['acc_idacc']);
$accname = $acc['accname'];  			
  			
  			?>		 
       <tr> 
<td><? echo $row['acc_idacc'];?></td>
<td><? echo $accname;?></td>
<td class="right"><? echo $row['dvalue'];?></td>
<td class="right"><? echo $row['kvalue'];?></td>
 
        <td width="100px"> 
        <a href="gldtl_form.php?action=update&id=<? echo $row['idgldtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="gldtl_process.php?action=delete&id=<? echo $row['idgldtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
