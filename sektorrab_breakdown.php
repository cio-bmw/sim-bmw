 <script type="text/javascript">  
// fungsi ini untuk menampilkan list data sektorrabtxn sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var dataString; 
  var vsektor = $("input#sektor").val(); 
  var vrab = $("input#rab").val();  
   
	
  dataString = 'starting='+page+'&sektor='+vsektor+'&rab='+vrab+'&random='+Math.random(); 
   
  $.ajax({ 
    url:"sektorrab_breakdown.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektorrabtxn, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var vsektor = $("input#sektor").val(); 
  var vrab = $("input#rab").val();  
 
   dataString = 'sektor='+vsektor+'&rab='+vrab; 
 
  $.ajax({ 
    url: "sektorrab_breakdown.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sektorrabtxn tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektorrabtxn tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data sektorrabtxn ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("sektorrabtxn_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data sektorrabtxn berhasil di hapus!"); 
					} 
					else{ 
						alert("data sektorrabtxn gagal di hapus!"); 
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
$idrabmst = $_GET['rab'];
$sektor_idsektor = $_GET['sektor'];
 
	$rabmst = rabmstinfo($idrabmst);
   $rabdesc = $rabmst['rabdesc'];  	
   	$sektor = sektorinfo($sektor_idsektor);
	$sektorname= $sektor ['sektorname'];
  
   
$sql = "select * from sektorrabtxn where rabmst_idrabmst = '$idrabmst' and sektor_idsektor = '$sektor_idsektor' "; 
 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 

<input type="hidden" id="rab" name="rab" value="<? echo $idrabmst; ?>" >
<input type="hidden" id="sektor" name="sektor" value="<? echo $sektor_idsektor; ?>" >




  <table id="sektorrabtxn" class="grid"> 
  	 <p class="judul">Detail Transaksi RAB <? echo $rabdesc.' sektor '.$sektorname; ?></p>
  <tr> 
 <th>No Dok</th>
<th>Sektor</th>
<th>RAB</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Jumlah</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sektorrabtxn 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  			$rabmst = rabmstinfo($row['rabmst_idrabmst']);
   $rabdesc = $rabmst['rabdesc'];  	
  			
  			 ?>		 
       <tr> 
 <td><? echo $row['idtxn'];?></td>
<td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $rabdesc;?></td>
<td><? echo gettanggal($row['txndate']);?></td>
<td><? echo $row['txndesc'];?></td>
<td class="right"><? echo nf($row['txnvalue']);?></td>
 
        <td width="120px"><a href="sektorrabtxn_form.php?action=update&id=<? echo $row['idtxn'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="sektorrabtxn_process.php?action=delete&id=<? echo $row['idtxn'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
