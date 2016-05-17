 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data cashoutdtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashoutdtl"){ 
    dataString = 'starting='+page+'&idcashoutdtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "dtldesc"){ 
    dataString = 'starting='+page+'&dtldesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnvalue"){ 
    dataString = 'starting='+page+'&txnvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "cashouthdr_idcashouthdr"){ 
    dataString = 'starting='+page+'&cashouthdr_idcashouthdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"cashoutdtl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data cashoutdtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashoutdtl"){ 
      dataString = 'idcashoutdtl='+ cari;  
   } 
   else if (combo == "dtldesc"){ 
      dataString = 'dtldesc='+ cari; 
    } 
   else if (combo == "txnvalue"){ 
      dataString = 'txnvalue='+ cari; 
    } 
   else if (combo == "cashouthdr_idcashouthdr"){ 
      dataString = 'cashouthdr_idcashouthdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "cashoutdtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#cashoutdtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#cashoutdtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data cashoutdtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("cashoutdtl_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data cashoutdtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data cashoutdtl gagal di hapus!"); 
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
$id = $_GET['id'];
 

$sql = "select * from cashoutdtl where cashouthdr_idcashouthdr='$id'"; 

 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
  <table id="cashoutdtl" width="500px"> 
  <tr> 
 <th>No <? echo $id; ?></th>
<th>Keterangan</th>
<th>Jumlah</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data cashoutdtl 
		if(mysql_num_rows($result)!=0){ 
		$no=1;
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $no;?></td>
<td><? echo $row['dtldesc'];?></td>
<td><? echo $row['txnvalue'];?></td>
 
        <td><a href="cashoutdtl_form.php?action=update&id=<? echo $row['idcashoutdtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="cashoutdtl_process.php?action=delete&id=<? echo $row['idcashoutdtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?  
      $no++;  		
  		} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
