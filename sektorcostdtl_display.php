 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data sektorcostdtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
 var cari = $("input#idsektorcosthdr").val(); 
   

  dataString = 'starting='+page+'&id='+cari+'&random='+Math.random(); 
 
     
  $.ajax({ 
    url:"sektorcostdtl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektorcostdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idsektorcosthdr").val(); 
  
      dataString = 'id='+ cari; 
  
 
  $.ajax({ 
    url: "sektorcostdtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sektorcostdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektorcostdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageEntry").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageEntry").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data sektorcostdtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("sektorcostdtl_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data sektorcostdtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data sektorcostdtl gagal di hapus!"); 
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
 
$idsektorcosthdr = $_GET['id']; 


$sql = "select * from sektorcostdtl where sektorcosthdr_idsektorcosthdr = '$idsektorcosthdr'"; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="sektorcostdtl" width="600"> 
  <tr> 
 <th>No <? echo $idsektorcosthdr; ?></th>
<th colspan="2" >Anggaran Belanja</th>
<th>Keterangan</th>
<th>Nilai (Rp)</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sektorcostdtl 
		if(mysql_num_rows($result)!=0){ $total =0;
  		while($row = mysql_fetch_array($result)){ 
  		$rabmst = rabmstinfo($row['rabmst_idrabmst']) ;
      $rabdesc = $rabmst['rabdesc']; 			
  		?>		 
       <tr> 
<td><? echo $row['idsektorcostdtl'];?></td>
<td><? echo $row['rabmst_idrabmst'];?></td>
<td><? echo $rabdesc;?></td>
<td><? echo $row['txndtldesc'];?></td>
<td class="right"><? echo nf($row['costprice']);?></td>
 
        <td width="110"><a href="sektorcostdtl_form.php?action=update&id=<? echo $row['idsektorcostdtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="sektorcostdtl_process.php?action=delete&id=<? echo $row['idsektorcostdtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?
    	$total = $total + $row['costprice'];	
    		} //end while ?> 
		 <tr><td  class="right"  colspan="5"><?php echo nf($total); ?></td><td></td></tr> 
    		
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
