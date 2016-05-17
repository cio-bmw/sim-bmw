 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data cashbook sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashbook"){ 
    dataString = 'starting='+page+'&idcashbook='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "txndate"){ 
    dataString = 'starting='+page+'&txndate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnflag"){ 
    dataString = 'starting='+page+'&txnflag='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txnvalue"){ 
    dataString = 'starting='+page+'&txnvalue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "saldo"){ 
    dataString = 'starting='+page+'&saldo='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "txndesc"){ 
    dataString = 'starting='+page+'&txndesc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "idcashin"){ 
    dataString = 'starting='+page+'&idcashin='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "idcashouthdr"){ 
    dataString = 'starting='+page+'&idcashouthdr='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"cashbook_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data cashbook, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcashbook"){ 
      dataString = 'idcashbook='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txnflag"){ 
      dataString = 'txnflag='+ cari; 
    } 
   else if (combo == "txnvalue"){ 
      dataString = 'txnvalue='+ cari; 
    } 
   else if (combo == "saldo"){ 
      dataString = 'saldo='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "idcashin"){ 
      dataString = 'idcashin='+ cari; 
    } 
   else if (combo == "idcashouthdr"){ 
      dataString = 'idcashouthdr='+ cari; 
    } 
 
  $.ajax({ 
    url: "cashbook_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#cashbook tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#cashbook tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data cashbook ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("cashbook_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data cashbook berhasil di hapus!"); 
					} 
					else{ 
						alert("data cashbook gagal di hapus!"); 
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
 
if (isset($_GET['idcashbook']) and !empty($_GET['idcashbook'])){ 
 $idcashbook = $_GET['idcashbook']; 
  $sql = "select * from cashbook where idcashbook like '%$idcashbook%' order by idcashbook"; 
} 
else if (isset($_GET['txndate']) and !empty($_GET['txndate'])){ 
 $txndate = $_GET['txndate']; 
  $sql = "select * from cashbook where txndate like '%$txndate%' order by txndate"; 
} 
else if (isset($_GET['txnflag']) and !empty($_GET['txnflag'])){ 
 $txnflag = $_GET['txnflag']; 
  $sql = "select * from cashbook where txnflag like '%$txnflag%' order by txnflag"; 
} 
else if (isset($_GET['txnvalue']) and !empty($_GET['txnvalue'])){ 
 $txnvalue = $_GET['txnvalue']; 
  $sql = "select * from cashbook where txnvalue like '%$txnvalue%' order by txnvalue"; 
} 
else if (isset($_GET['saldo']) and !empty($_GET['saldo'])){ 
 $saldo = $_GET['saldo']; 
  $sql = "select * from cashbook where saldo like '%$saldo%' order by saldo"; 
} 
else if (isset($_GET['txndesc']) and !empty($_GET['txndesc'])){ 
 $txndesc = $_GET['txndesc']; 
  $sql = "select * from cashbook where txndesc like '%$txndesc%' order by txndesc"; 
} 
else if (isset($_GET['idcashin']) and !empty($_GET['idcashin'])){ 
 $idcashin = $_GET['idcashin']; 
  $sql = "select * from cashbook where idcashin like '%$idcashin%' order by idcashin"; 
} 
else if (isset($_GET['idcashouthdr']) and !empty($_GET['idcashouthdr'])){ 
 $idcashouthdr = $_GET['idcashouthdr']; 
  $sql = "select * from cashbook where idcashouthdr like '%$idcashouthdr%' order by idcashouthdr"; 
} 
else{ 
  $sql = "select * from cashbook"; 
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
	 
  <table id="cashbook"> 
  <tr> 
 <th>idcashbook</th>
<th>txndate</th>
<th>txnflag</th>
<th>txnvalue</th>
<th>saldo</th>
<th>txndesc</th>
<th>idcashin</th>
<th>idcashouthdr</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data cashbook 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcashbook'];?></td>
<td><? echo $row['txndate'];?></td>
<td><? echo $row['txnflag'];?></td>
<td><? echo $row['txnvalue'];?></td>
<td><? echo $row['saldo'];?></td>
<td><? echo $row['txndesc'];?></td>
<td><? echo $row['idcashin'];?></td>
<td><? echo $row['idcashouthdr'];?></td>
 
        <td><a href="cashbook_form.php?action=update&id=<? echo $row['idcashbook'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="cashbook_process.php?action=delete&id=<? echo $row['idcashbook'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
