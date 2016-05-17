 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data txndaily sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var vpos = $("select#idtxnpos").val();
  var valokasi = $("select#idtxnalokasi").val();
  
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxndaily"){ 
    dataString = 'starting='+page+'&idtxndaily='+cari+'&pos='+vpos+'&alokasi='+valokasi+'&random='+Math.random(); 
   } 
   else if (combo == "txndate"){ 
    dataString = 'starting='+page+'&txndate='+cari+'&pos='+vpos+'&alokasi='+valokasi+'&random='+Math.random(); 
    } 
   else if (combo == "txndesc"){ 
    dataString = 'starting='+page+'&txndesc='+cari+'&pos='+vpos+'&alokasi='+valokasi+'   &random='+Math.random(); 
    } 
  
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"txndaily_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data txndaily, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idtxndaily"){ 
      dataString = 'idtxndaily='+ cari+'&pos='+vpos+'&alokasi='+valokasi;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari+'&pos='+vpos+'&alokasi='+valokasi; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari+'&pos='+vpos+'&alokasi='+valokasi; 
    } 
   
 
  $.ajax({ 
    url: "txndaily_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#txndaily tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#txndaily tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		return false; 
	}); 
	 
	$("a.detail").click(function(){ 
		window.location=$(this).attr("href"); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data txndaily ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("txndaily_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data txndaily berhasil di hapus!"); 
					} 
					else{ 
						alert("data txndaily gagal di hapus!"); 
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
$idtxnpos = $_GET['pos'];
$idtxnalokasi = $_GET['alokasi'];
 
if (isset($_GET['idtxndaily']) and !empty($_GET['idtxndaily'])){ 
 $idtxndaily = $_GET['idtxndaily']; 
  $sql = "select * from txndaily where idtxndaily like '%$idtxndaily%' and txnpos_idtxnpos like '%$idtxnpos%'  and txnalokasi_idtxnalokasi like  '%$idtxnalokasi%'   order by idtxndaily"; 
} 
else if (isset($_GET['txndate']) and !empty($_GET['txndate'])){ 
 $txndate = $_GET['txndate']; 
  $sql = "select * from txndaily where txndate like '%$txndate%' and txnpos_idtxnpos like '%$idtxnpos%'  and txnalokasi_idtxnalokasi like  '%$idtxnalokasi%'  order by txndate"; 
} 
else if (isset($_GET['txndesc']) and !empty($_GET['txndesc'])){ 
 $txndesc = $_GET['txndesc']; 
  $sql = "select * from txndaily where txndesc like '%$txndesc%' and txnpos_idtxnpos like '%$idtxnpos%'  and txnalokasi_idtxnalokasi like  '%$idtxnalokasi%'   order by txndesc"; 
} 

else{ 
  $sql = "select * from txndaily"; 
} 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
<p class="judul">Data Transaksi Keuangan</p> 
  <table id="txndaily" class="grid"> 
  <tr> 
 <th>No Dok</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Debit</th>
<th>Kredit</th>
<th>Saldo</th>
<th>Status D/K</th>
<th>Pos</th>
<th>Alokasi</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data txndaily 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
$pos = txnposinfo($row['txnpos_idtxnpos']);
$posname = $pos['posname'];  	

$alokasi = txnalokasiinfo($row['txnalokasi_idtxnalokasi']);
$alokasiname = $alokasi['alokasiname'];	
  		
  		?>		 
       <tr> 
 <td><? echo $row['idtxndaily'];?></td>
<td><? echo gettanggal($row['txndate']);?></td>
<td><? echo $row['txndesc'];?></td>
<td><? echo $row['dvalue'];?></td>
<td><? echo $row['kvalue'];?></td>
<td><? echo $row['saldo'];?></td>
<td><? echo $row['txnflag'];?></td>
<td><? echo $posname;?></td>
<td><? echo $alokasiname;?></td>
 
        <td width="115px"> 
        <a href="txndaily_form.php?action=update&id=<? echo $row['idtxndaily'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="txndaily_process.php?action=delete&id=<? echo $row['idtxndaily'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
