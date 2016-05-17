 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data sektorcosthdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsektorcosthdr"){ 
    dataString = 'starting='+page+'&idsektorcosthdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "txndate"){ 
    dataString = 'starting='+page+'&txndate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txndesc"){ 
    dataString = 'starting='+page+'&txndesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektor_idsektor"){ 
    dataString = 'starting='+page+'&sektor_idsektor='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"sektorcosthdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektorcosthdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsektorcosthdr"){ 
      dataString = 'idsektorcosthdr='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
  $.ajax({ 
    url: "sektorcosthdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#sektorcosthdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektorcosthdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data sektorcosthdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("sektorcosthdr_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data sektorcosthdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data sektorcosthdr gagal di hapus!"); 
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
 
if (isset($_GET['idsektorcosthdr']) and !empty($_GET['idsektorcosthdr'])){ 
 $idsektorcosthdr = $_GET['idsektorcosthdr']; 
  $sql = "select * from sektorcosthdr where idsektorcosthdr like '%$idsektorcosthdr%' order by idsektorcosthdr desc"; 
} 
else if (isset($_GET['txndate']) and !empty($_GET['txndate'])){ 
 $txndate = $_GET['txndate']; 
  $sql = "select * from sektorcosthdr where txndate like '%$txndate%' order by txndate"; 
} 
else if (isset($_GET['txndesc']) and !empty($_GET['txndesc'])){ 
 $txndesc = $_GET['txndesc']; 
  $sql = "select * from sektorcosthdr where txndesc like '%$txndesc%' order by txndesc"; 
} 
else if (isset($_GET['sektor_idsektor']) and !empty($_GET['sektor_idsektor'])){ 
 $sektor_idsektor = $_GET['sektor_idsektor']; 
  $sql = "select * from sektorcosthdr where sektor_idsektor like '%$sektor_idsektor%' order by sektor_idsektor"; 
} 
else{ 
  $sql = "select * from sektorcosthdr  order by idsektorcosthdr desc "; 
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
	 
  <table id="sektorcosthdr" class="grid"> 
  <tr> 
 <th width="50">No Dok</th>
<th >Sektor</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Jumlah</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sektorcosthdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
     	$sektor =sektorinfo($row['sektor_idsektor']);
  		$sektorname = $sektor['sektorname'];
$sql1 = "select IFNULL(sum(costprice),0) jml from sektorcostdtl where sektorcosthdr_idsektorcosthdr = '".$row['idsektorcosthdr']."'";
$data1  = mysql_fetch_array(mysql_query($sql1));  
$jumlah = $data1[0];	  		
     		
    		
    		
  		?>		 
       <tr> 
<td><? echo $row['idsektorcosthdr'];?></td>

<td width="170"><? echo $sektorname;?></td>

<td width="100"><? echo $row['txndate'];?></td>
<td><? echo $row['txndesc'];?></td>
<td class="right"><? echo nf($jumlah);?></td>

 
        <td width=180px">
        <a href="sektorcosthdr_detail.php?id=<? echo $row['idsektorcosthdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       | <a href="sektorcosthdr_form.php?action=update&id=<? echo $row['idsektorcosthdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="sektorcosthdr_process.php?action=delete&id=<? echo $row['idsektorcosthdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="6"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="6"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="6">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
