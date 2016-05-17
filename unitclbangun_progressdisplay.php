 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unitclbangun sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#idunit").val(); 
  
    dataString = 'starting='+page+'&idunit='+cari+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"unitclbangun_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unitclbangun, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
    var vunit = $("input#idunit").val(); 
	  var vspk = $("select#unitspk_idunitspk").val(); 
     dataString = 'idunit='+ vunit+'&spk='+vspk; 
  
  $.ajax({ 
    url: "unitclbangun_progressdisplay.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unitclbangun tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unitclbangun tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		return false; 
	}); 
	 
	$("a.detail").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data unitclbangun ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("unitclbangun_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data unitclbangun berhasil di hapus!"); 
					} 
					else{ 
						alert("data unitclbangun gagal di hapus!"); 
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

 $idunit = $_GET['idunit']; 
 $idspkcat = $_GET['spk'];
 $spkcat = spkcatinfo($idspkcat);
 $category = $spkcat['category'];
 
 
 $sql = "select * from unitclbangun a, unitspk b  where a.unitspk_idunitspk = b.idunitspk and 
 a.unit_idunit ='$idunit' and b.spkcat_idspkcat like '%".$idspkcat."%' "; 

if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	<p class="judul">Check List Progres SPK <? echo $category; ?></p> 
	
  <table id="unitclbangun" width="490px"> 
  <tr> 
 <th>No</th>
<th>Keterangan</th>
<th width="50px">bobotpct</th>
<th width="50px">workdays</th>
<th width="50px">clstatus</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unitclbangun 
		if(mysql_num_rows($result)!=0){ $no=1;
  		while($row = mysql_fetch_array($result)){ 
      $clbangun = clbanguninfo($row['clbangun_idclbangun']);
      $clbangundesc = $clbangun['clbangundesc'];  		
  		
  		?>		 
       <tr> 
 <td><? echo $no;?></td>
<td><? echo $clbangundesc;?></td>
<td  class="right"><? echo $row['bobotpct'];?></td>
<td  class="right"><? echo $row['workdays'];?></td>
 <td><? echo $row['clstatus'];?></td>
        <td width="105px"> 
       <a href="unitclbangun_form.php?action=update&id=<? echo $row['idunitclbangun'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unitclbangun_process.php?action=delete&id=<? echo $row['idunitclbangun'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?   $no++;} //end while ?> 
		 <tr id="nav"><td colspan="6"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="6"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="6">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
