 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data cashouthdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashouthdr"){ 
    dataString = 'starting='+page+'&idcashouthdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "txndate"){ 
    dataString = 'starting='+page+'&txndate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txndesc"){ 
    dataString = 'starting='+page+'&txndesc='+cari+'&random='+Math.random(); 
    } 
     else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"whcashouthdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data cashouthdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  
  var vstartdate = $("input#startdate").val(); 
  var venddate = $("input#enddate").val(); 
  
   
 dataString = 'startdate='+vstartdate+'&enddate='+venddate; 


 
  $.ajax({ 
    url: "whcashouthdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#cashouthdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#cashouthdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data cashouthdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("whcashouthdr_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data cashouthdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data cashouthdr gagal di hapus!"); 
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
$startdate = settanggal($_GET['startdate']);
$enddate = settanggal($_GET['enddate']);
 

  $sql = "select * from whcashouthdr  where txndate  between '$startdate' and '$enddate' order by idcashouthdr desc"; 

 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
<p class="judul" >Data Pengeluaran Kas Gudang</p>	 
  <table id="cashouthdr" > 
  <tr> 
 <th>No Dok</th>
<th>Tangal</th>
<th>Keterangan</th>
<th>Jumlah x</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data cashouthdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
  		
$sql1 = "select IFNULL(sum(txnvalue),0) jml from whcashoutdtl where cashouthdr_idcashouthdr = '".$row['idcashouthdr']."'";
$data1  = mysql_fetch_array(mysql_query($sql1));  
$jml = $data1[0];	  		
  		
  		
  		
  		 ?>		 
       <tr> 
 <td><? echo $row['idcashouthdr'];?></td>
<td><? echo gettanggal($row['txndate']);?></td>
<td><? echo $row['txndesc'];?></td>
<td class="right"><? echo nf($jml) ; ?></td>

 
        <td width="180px">
         <a href="whcashouthdr_detail.php?action=update&id=<? echo $row['idcashouthdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       | <a href="whcashouthdr_form.php?action=update&id=<? echo $row['idcashouthdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="whcashouthdr_process.php?action=delete&id=<? echo $row['idcashouthdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
