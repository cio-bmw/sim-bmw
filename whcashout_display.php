 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data whcashout sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashout"){ 
    dataString = 'starting='+page+'&idcashout='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "txndate"){ 
    dataString = 'starting='+page+'&txndate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txndesc"){ 
    dataString = 'starting='+page+'&txndesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnvalue"){ 
    dataString = 'starting='+page+'&txnvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sektor_idsektor"){ 
    dataString = 'starting='+page+'&sektor_idsektor='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"whcashout_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data whcashout, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashout"){ 
      dataString = 'idcashout='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "txnvalue"){ 
      dataString = 'txnvalue='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
  $.ajax({ 
    url: "whcashout_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#whcashout tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#whcashout tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data whcashout ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("whcashout_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data whcashout berhasil di hapus!"); 
					} 
					else{ 
						alert("data whcashout gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 
	

	 
}); 

	$("#btncetak").click(function(){
		window.open('whcashout_pdf.php?start='+$("input#startdate").val()+'&end='+$("input#enddate").val(),'_blank');	
	}); 
	
 
</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
 
if (isset($_GET['idcashout']) and !empty($_GET['idcashout'])){ 
 $idcashout = $_GET['idcashout']; 
  $sql = "select * from whcashout where idcashout like '%$idcashout%' order by idcashout"; 
} 
else if (isset($_GET['txndate']) and !empty($_GET['txndate'])){ 
 $txndate = $_GET['txndate']; 
  $sql = "select * from whcashout where txndate like '%$txndate%' order by txndate"; 
} 
else if (isset($_GET['txndesc']) and !empty($_GET['txndesc'])){ 
 $txndesc = $_GET['txndesc']; 
  $sql = "select * from whcashout where txndesc like '%$txndesc%' order by txndesc"; 
} 
else if (isset($_GET['txnvalue']) and !empty($_GET['txnvalue'])){ 
 $txnvalue = $_GET['txnvalue']; 
  $sql = "select * from whcashout where txnvalue like '%$txnvalue%' order by txnvalue"; 
} 
else if (isset($_GET['sektor_idsektor']) and !empty($_GET['sektor_idsektor'])){ 
 $sektor_idsektor = $_GET['sektor_idsektor']; 
  $sql = "select * from whcashout where sektor_idsektor like '%$sektor_idsektor%' order by sektor_idsektor"; 
} 
else{ 
  $sql = "select * from whcashout"; 
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
	 
<p class="judul">Daftar Pengeluaran Kas Gudang
<input type="submit" id="btncetak" value="Cetak">
</p> 
  <table id="whcashout"> 
  <tr> 
 <th>No Dok</th>
<th>Tanggal</th>
<th>Sektor</th>
<th>Keterangan</th>
<th>Jumlah</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data whcashout 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcashout'];?></td>
<td><? echo gettanggal($row['txndate']);?></td>
<td><? echo $row['sektor_idsektor'];?></td>
<td><? echo $row['txndesc'];?></td>
<td><? echo $row['txnvalue'];?></td>
 
        <td width="105px"> 
       <a href="whcashout_form.php?action=update&id=<? echo $row['idcashout'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="whcashout_process.php?action=delete&id=<? echo $row['idcashout'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
