 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data receivehdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idreceivehdr"){ 
    dataString = 'starting='+page+'&idreceivehdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "supplier_idsupp"){ 
    dataString = 'starting='+page+'&supplier_idsupp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_date"){ 
    dataString = 'starting='+page+'&rcv_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_bon"){ 
    dataString = 'starting='+page+'&rcv_bon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_titip"){ 
    dataString = 'starting='+page+'&rcv_titip='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_desc"){ 
    dataString = 'starting='+page+'&rcv_desc='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "due_date"){ 
    dataString = 'starting='+page+'&due_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "paid_date"){ 
    dataString = 'starting='+page+'&paid_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "faktur"){ 
    dataString = 'starting='+page+'&faktur='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_bayar"){ 
    dataString = 'starting='+page+'&rcv_bayar='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_status"){ 
    dataString = 'starting='+page+'&rcv_status='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_diskon"){ 
    dataString = 'starting='+page+'&rcv_diskon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_totprice"){ 
    dataString = 'starting='+page+'&rcv_totprice='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_totdiskon"){ 
    dataString = 'starting='+page+'&rcv_totdiskon='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rcv_totppn"){ 
    dataString = 'starting='+page+'&rcv_totppn='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"receivehdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receivehdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val();
  var vstatus = $("select#status").val();
   
   
	  if (combo == "idreceivehdr"){ 
      dataString = 'rcv_status='+ vstatus+'&idreceivehdr='+ cari;  
   } 
   else if (combo == "supplier_idsupp"){ 
      dataString == 'supplier_idsupp='+ cari; 
    } 
   else if (combo == "rcv_date"){ 
      dataString = 'rcv_date='+ cari; 
    } 
   else if (combo == "rcv_bon"){ 
      dataString = 'rcv_bon='+ cari; 
    } 
   else if (combo == "rcv_titip"){ 
      dataString = 'rcv_titip='+ cari; 
    } 
   else if (combo == "rcv_desc"){ 
      dataString = 'rcv_desc='+ cari; 
    } 
   else if (combo == "due_date"){ 
      dataString = 'due_date='+ cari; 
    } 
   else if (combo == "paid_date"){ 
      dataString = 'paid_date='+ cari; 
    } 
   else if (combo == "faktur"){ 
      dataString = 'faktur='+ cari; 
    } 
   else if (combo == "rcv_bayar"){ 
      dataString = 'rcv_bayar='+ cari; 
    } 
   else if (combo == "rcv_status"){ 
      dataString = 'rcv_status='+ cari; 
    } 
   else if (combo == "rcv_diskon"){ 
      dataString = 'rcv_diskon='+ cari; 
    } 
   else if (combo == "rcv_totprice"){ 
      dataString = 'rcv_totprice='+ cari; 
    } 
   else if (combo == "rcv_totdiskon"){ 
      dataString = 'rcv_totdiskon='+ cari; 
    } 
   else if (combo == "rcv_totppn"){ 
      dataString = 'rcv_totppn='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    }
    else { 
    dataString = 'rcv_status='+ vstatus;
   }
   
  $.ajax({ 
    url: "receivehdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receivehdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receivehdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	
   $("a.process").click(function(){ 
		window.location='receivedtl.php?id= $row["idreceivehdr"]'; 
	}); 	 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data receivehdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("receivehdr_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data receivehdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data receivehdr gagal di hapus!"); 
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
 
if (isset($_GET['idreceivehdr']) and !empty($_GET['idreceivehdr'])){ 
 $idreceivehdr = $_GET['idreceivehdr']; 
  $sql = "select * from receivehdr where idreceivehdr like '%$idreceivehdr%' order by idreceivehdr"; 
} 
else if (isset($_GET['supplier_idsupp']) and !empty($_GET['supplier_idsupp'])){ 
 $supplier_idsupp = $_GET['supplier_idsupp']; 
  $sql = "select * from receivehdr where supplier_idsupp like '%$supplier_idsupp%' and rcv_status like '%$rcv_status%'  order by supplier_idsupp"; 
} 
else if (isset($_GET['rcv_date']) and !empty($_GET['rcv_date'])){ 
 $rcv_date = $_GET['rcv_date']; 
  $sql = "select * from receivehdr where rcv_date like '%$rcv_date%' order by rcv_date"; 
} 
else if (isset($_GET['rcv_bon']) and !empty($_GET['rcv_bon'])){ 
 $rcv_bon = $_GET['rcv_bon']; 
  $sql = "select * from receivehdr where rcv_bon like '%$rcv_bon%' order by rcv_bon"; 
} 
else if (isset($_GET['rcv_titip']) and !empty($_GET['rcv_titip'])){ 
 $rcv_titip = $_GET['rcv_titip']; 
  $sql = "select * from receivehdr where rcv_titip like '%$rcv_titip%' order by rcv_titip"; 
} 
else if (isset($_GET['rcv_desc']) and !empty($_GET['rcv_desc'])){ 
 $rcv_desc = $_GET['rcv_desc']; 
  $sql = "select * from receivehdr where rcv_desc like '%$rcv_desc%' order by rcv_desc"; 
} 
else if (isset($_GET['due_date']) and !empty($_GET['due_date'])){ 
 $due_date = $_GET['due_date']; 
  $sql = "select * from receivehdr where due_date like '%$due_date%' order by due_date"; 
} 
else if (isset($_GET['paid_date']) and !empty($_GET['paid_date'])){ 
 $paid_date = $_GET['paid_date']; 
  $sql = "select * from receivehdr where paid_date like '%$paid_date%' order by paid_date"; 
} 
else if (isset($_GET['faktur']) and !empty($_GET['faktur'])){ 
 $faktur = $_GET['faktur']; 
  $sql = "select * from receivehdr where faktur like '%$faktur%' order by faktur"; 
} 
else if (isset($_GET['rcv_bayar']) and !empty($_GET['rcv_bayar'])){ 
 $rcv_bayar = $_GET['rcv_bayar']; 
  $sql = "select * from receivehdr where rcv_bayar like '%$rcv_bayar%' order by rcv_bayar"; 
} 
else if (isset($_GET['rcv_status']) and !empty($_GET['rcv_status'])){ 
 $rcv_status = $_GET['rcv_status']; 
  $sql = "select * from receivehdr where rcv_status like '%$rcv_status%' order by rcv_status"; 
} 
else if (isset($_GET['rcv_diskon']) and !empty($_GET['rcv_diskon'])){ 
 $rcv_diskon = $_GET['rcv_diskon']; 
  $sql = "select * from receivehdr where rcv_diskon like '%$rcv_diskon%' order by rcv_diskon"; 
} 
else if (isset($_GET['rcv_totprice']) and !empty($_GET['rcv_totprice'])){ 
 $rcv_totprice = $_GET['rcv_totprice']; 
  $sql = "select * from receivehdr where rcv_totprice like '%$rcv_totprice%' order by rcv_totprice"; 
} 
else if (isset($_GET['rcv_totdiskon']) and !empty($_GET['rcv_totdiskon'])){ 
 $rcv_totdiskon = $_GET['rcv_totdiskon']; 
  $sql = "select * from receivehdr where rcv_totdiskon like '%$rcv_totdiskon%' order by rcv_totdiskon"; 
} 
else if (isset($_GET['rcv_totppn']) and !empty($_GET['rcv_totppn'])){ 
 $rcv_totppn = $_GET['rcv_totppn']; 
  $sql = "select * from receivehdr where rcv_totppn like '%$rcv_totppn%' order by rcv_totppn"; 
} 
else if (isset($_GET['emp_idemp']) and !empty($_GET['emp_idemp'])){ 
 $emp_idemp = $_GET['emp_idemp']; 
  $sql = "select * from receivehdr where emp_idemp like '%$emp_idemp%' order by emp_idemp"; 
} 
else { 
   $sql = "select * from receivehdr where rcv_status='confirm'"; 
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
	 
  <table id="receivehdr"> 
  <tr> 
 <th>No Dok</th>
<th>Kode</th>
<th>Nama Supplier</th>

<th>Tgl Terima</th>
<th>Jatuh Tempo</th>
<th>Faktur</th>

<th>Keterangan</th>
<th>Status</th>
<th>Total Harga</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receivehdr 
		if(mysql_num_rows($result)!=0){ $alltotal =0;
  		while($row = mysql_fetch_array($result)){
$supplier = supplierinfo($row['supplier_idsupp']) ; 

$sql2="SELECT sum(receive_price * qty) vreceive FROM receivedtl  
where receivehdr_idreceivehdr ='".$row['idreceivehdr']."'";
$data2  = mysql_fetch_array(mysql_query($sql2));  
$mrcv = $data2[0];	

			
 ?>		 
 <tr> 
 <td><? echo $row['idreceivehdr'];?></td>
<td><? echo $row['supplier_idsupp'];?></td>
<td><? echo $supplier['suppname'];?></td>

<td><? echo gettanggal($row['rcv_date']);?></td>
<td><? echo gettanggal($row['due_date']);?></td>
<td><? echo $row['faktur'];?></td>
<td><? echo $row['rcv_desc'];?></td>
<td><? echo $row['rcv_status'];?></td>
<td class="right"><? echo nf($mrcv);?></td>
 
        <td>
           <a href="receivedtl.php?action=detail&id=<? echo $row['idreceivehdr'];?>" class="process"> <input type="button" class="button" value="Detail"></a>     
           | <a href="receivehdr_form.php?action=update&id=<? echo $row['idreceivehdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="receivehdr_process.php?action=delete&id=<? echo $row['idreceivehdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?  
$alltotal = $alltotal + $mrcv;  		
  		
  		} //end while ?> 
		 <tr id="nav"><td colspan="8"><?php echo $obj->anchors; ?></td><td class="right"><? echo nf($alltotal);?></td></tr> 
	   <tr id="total"><td colspan="10"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="10">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
