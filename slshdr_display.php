 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idslshdr"){ 
    dataString = 'starting='+page+'&idslshdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "sls_date"){ 
    dataString = 'starting='+page+'&sls_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_bon"){ 
    dataString = 'starting='+page+'&sls_bon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_titip"){ 
    dataString = 'starting='+page+'&sls_titip='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "due_date"){ 
    dataString = 'starting='+page+'&due_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_blj"){ 
    dataString = 'starting='+page+'&sls_blj='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_tambahan"){ 
    dataString = 'starting='+page+'&sls_tambahan='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_total"){ 
    dataString = 'starting='+page+'&sls_total='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_bayar"){ 
    dataString = 'starting='+page+'&sls_bayar='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_kembali"){ 
    dataString = 'starting='+page+'&sls_kembali='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_desc"){ 
    dataString = 'starting='+page+'&sls_desc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "payment_date"){ 
    dataString = 'starting='+page+'&payment_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_status"){ 
    dataString = 'starting='+page+'&sls_status='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sls_diskon"){ 
    dataString = 'starting='+page+'&sls_diskon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "customer_idcustomer"){ 
    dataString = 'starting='+page+'&customer_idcustomer='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"slshdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data pelanggan, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idslshdr"){ 
      dataString = 'idslshdr='+ cari;  
   } 
   else if (combo == "sls_date"){ 
      dataString = 'sls_date='+ cari; 
    } 
   else if (combo == "sls_bon"){ 
      dataString = 'sls_bon='+ cari; 
    } 
   else if (combo == "sls_titip"){ 
      dataString = 'sls_titip='+ cari; 
    } 
   else if (combo == "due_date"){ 
      dataString = 'due_date='+ cari; 
    } 
   else if (combo == "sls_blj"){ 
      dataString = 'sls_blj='+ cari; 
    } 
   else if (combo == "sls_tambahan"){ 
      dataString = 'sls_tambahan='+ cari; 
    } 
   else if (combo == "sls_total"){ 
      dataString = 'sls_total='+ cari; 
    } 
   else if (combo == "sls_bayar"){ 
      dataString = 'sls_bayar='+ cari; 
    } 
   else if (combo == "sls_kembali"){ 
      dataString = 'sls_kembali='+ cari; 
    } 
   else if (combo == "sls_desc"){ 
      dataString = 'sls_desc='+ cari; 
    } 
   else if (combo == "payment_date"){ 
      dataString = 'payment_date='+ cari; 
    } 
   else if (combo == "sls_status"){ 
      dataString = 'sls_status='+ cari; 
    } 
   else if (combo == "sls_diskon"){ 
      dataString = 'sls_diskon='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
   else if (combo == "customer_idcustomer"){ 
      dataString = 'customer_idcustomer='+ cari; 
    } 
 
  $.ajax({ 
    url: "slshdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#slshdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#slshdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data slshdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("slshdr_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data slshdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data slshdr gagal di hapus!"); 
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
 
if (isset($_GET['idslshdr']) and !empty($_GET['idslshdr'])){ 
 $idslshdr = $_GET['idslshdr']; 
  $sql = "select * from slshdr where idslshdr like '%$idslshdr%' order by idslshdr"; 
} 
else if (isset($_GET['sls_date']) and !empty($_GET['sls_date'])){ 
 $sls_date = $_GET['sls_date']; 
  $sql = "select * from slshdr where sls_date like '%$sls_date%' order by sls_date"; 
} 
else if (isset($_GET['sls_bon']) and !empty($_GET['sls_bon'])){ 
 $sls_bon = $_GET['sls_bon']; 
  $sql = "select * from slshdr where sls_bon like '%$sls_bon%' order by sls_bon"; 
} 
else if (isset($_GET['sls_titip']) and !empty($_GET['sls_titip'])){ 
 $sls_titip = $_GET['sls_titip']; 
  $sql = "select * from slshdr where sls_titip like '%$sls_titip%' order by sls_titip"; 
} 
else if (isset($_GET['due_date']) and !empty($_GET['due_date'])){ 
 $due_date = $_GET['due_date']; 
  $sql = "select * from slshdr where due_date like '%$due_date%' order by due_date"; 
} 
else if (isset($_GET['sls_blj']) and !empty($_GET['sls_blj'])){ 
 $sls_blj = $_GET['sls_blj']; 
  $sql = "select * from slshdr where sls_blj like '%$sls_blj%' order by sls_blj"; 
} 
else if (isset($_GET['sls_tambahan']) and !empty($_GET['sls_tambahan'])){ 
 $sls_tambahan = $_GET['sls_tambahan']; 
  $sql = "select * from slshdr where sls_tambahan like '%$sls_tambahan%' order by sls_tambahan"; 
} 
else if (isset($_GET['sls_total']) and !empty($_GET['sls_total'])){ 
 $sls_total = $_GET['sls_total']; 
  $sql = "select * from slshdr where sls_total like '%$sls_total%' order by sls_total"; 
} 
else if (isset($_GET['sls_bayar']) and !empty($_GET['sls_bayar'])){ 
 $sls_bayar = $_GET['sls_bayar']; 
  $sql = "select * from slshdr where sls_bayar like '%$sls_bayar%' order by sls_bayar"; 
} 
else if (isset($_GET['sls_kembali']) and !empty($_GET['sls_kembali'])){ 
 $sls_kembali = $_GET['sls_kembali']; 
  $sql = "select * from slshdr where sls_kembali like '%$sls_kembali%' order by sls_kembali"; 
} 
else if (isset($_GET['sls_desc']) and !empty($_GET['sls_desc'])){ 
 $sls_desc = $_GET['sls_desc']; 
  $sql = "select * from slshdr where sls_desc like '%$sls_desc%' order by sls_desc"; 
} 
else if (isset($_GET['payment_date']) and !empty($_GET['payment_date'])){ 
 $payment_date = $_GET['payment_date']; 
  $sql = "select * from slshdr where payment_date like '%$payment_date%' order by payment_date"; 
} 
else if (isset($_GET['sls_status']) and !empty($_GET['sls_status'])){ 
 $sls_status = $_GET['sls_status']; 
  $sql = "select * from slshdr where sls_status like '%$sls_status%' order by sls_status"; 
} 
else if (isset($_GET['sls_diskon']) and !empty($_GET['sls_diskon'])){ 
 $sls_diskon = $_GET['sls_diskon']; 
  $sql = "select * from slshdr where sls_diskon like '%$sls_diskon%' order by sls_diskon"; 
} 
else if (isset($_GET['emp_idemp']) and !empty($_GET['emp_idemp'])){ 
 $emp_idemp = $_GET['emp_idemp']; 
  $sql = "select * from slshdr where emp_idemp like '%$emp_idemp%' order by emp_idemp"; 
} 
else if (isset($_GET['customer_idcustomer']) and !empty($_GET['customer_idcustomer'])){ 
 $customer_idcustomer = $_GET['customer_idcustomer']; 
  $sql = "select * from slshdr where customer_idcustomer like '%$customer_idcustomer%' order by customer_idcustomer"; 
} 
else{ 
  $sql = "select * from slshdr"; 
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
	 
  <table id="slshdr"> 
  <tr> 
 <th>idslshdr</th>
<th>sls_date</th>
<th>sls_bon</th>
<th>sls_titip</th>
<th>due_date</th>
<th>sls_blj</th>
<th>sls_tambahan</th>
<th>sls_total</th>
<th>sls_bayar</th>
<th>sls_kembali</th>
<th>sls_desc</th>
<th>payment_date</th>
<th>sls_status</th>
<th>sls_diskon</th>
<th>emp_idemp</th>
<th>customer_idcustomer</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idslshdr'];?></td>
<td><? echo $row['sls_date'];?></td>
<td><? echo $row['sls_bon'];?></td>
<td><? echo $row['sls_titip'];?></td>
<td><? echo $row['due_date'];?></td>
<td><? echo $row['sls_blj'];?></td>
<td><? echo $row['sls_tambahan'];?></td>
<td><? echo $row['sls_total'];?></td>
<td><? echo $row['sls_bayar'];?></td>
<td><? echo $row['sls_kembali'];?></td>
<td><? echo $row['sls_desc'];?></td>
<td><? echo $row['payment_date'];?></td>
<td><? echo $row['sls_status'];?></td>
<td><? echo $row['sls_diskon'];?></td>
<td><? echo $row['emp_idemp'];?></td>
<td><? echo $row['customer_idcustomer'];?></td>
 
        <td><a href="slshdr_form.php?action=update&id=<? echo $row['idslshdr'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idslshdr'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
