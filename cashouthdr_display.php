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
   else if (combo == "costcenter_idcostcenter"){ 
    dataString = 'starting='+page+'&costcenter_idcostcenter='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"cashouthdr_display.php", 
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
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashouthdr"){ 
      dataString = 'idcashouthdr='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "costcenter_idcostcenter"){ 
      dataString = 'costcenter_idcostcenter='+ cari; 
    } 
 
  $.ajax({ 
    url: "cashouthdr_display.php", //file tempat pemrosesan permintaan (request) 
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
						$("#divFormContent").load("cashouthdr_form.php"); 
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
 
if (isset($_GET['idcashouthdr']) and !empty($_GET['idcashouthdr'])){ 
 $idcashouthdr = $_GET['idcashouthdr']; 
  $sql = "select * from cashouthdr where idcashouthdr like '%$idcashouthdr%' order by idcashouthdr"; 
} 
else if (isset($_GET['txndate']) and !empty($_GET['txndate'])){ 
 $txndate = $_GET['txndate']; 
  $sql = "select * from cashouthdr where txndate like '%$txndate%' order by txndate"; 
} 
else if (isset($_GET['txndesc']) and !empty($_GET['txndesc'])){ 
 $txndesc = $_GET['txndesc']; 
  $sql = "select * from cashouthdr where txndesc like '%$txndesc%' order by txndesc"; 
} 
else if (isset($_GET['costcenter_idcostcenter']) and !empty($_GET['costcenter_idcostcenter'])){ 
 $costcenter_idcostcenter = $_GET['costcenter_idcostcenter']; 
  $sql = "select * from cashouthdr where costcenter_idcostcenter like '%$costcenter_idcostcenter%' order by costcenter_idcostcenter"; 
} 
else{ 
  $sql = "select * from cashouthdr"; 
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
	 
  <table id="cashouthdr" class="grid"> 
  <tr> 
 <th>No Dok</th>
<th>Tangal</th>
<th>Keterangan</th>
<th colspan=2>Unit Kerja</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data cashouthdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
  		$cc = costcenterinfo($row['costcenter_idcostcenter']);
  		$costcentername = $cc['costcentername'];
  		 ?>		 
       <tr> 
 <td><? echo $row['idcashouthdr'];?></td>
<td><? echo $row['txndate'];?></td>
<td><? echo $row['txndesc'];?></td>
<td><? echo $row['costcenter_idcostcenter'];?></td>
<td><? echo $costcentername;?></td>

 
        <td width="180px">
         <a href="cashouthdr_detail.php?action=update&id=<? echo $row['idcashouthdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       | <a href="cashouthdr_form.php?action=update&id=<? echo $row['idcashouthdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="cashouthdr_process.php?action=delete&id=<? echo $row['idcashouthdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
