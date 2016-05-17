 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data receive_paymenthdr sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpaymenthdr"){ 
    dataString = 'starting='+page+'&idpaymenthdr='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pay_date"){ 
    dataString = 'starting='+page+'&pay_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pay_name"){ 
    dataString = 'starting='+page+'&pay_name='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pay_note"){ 
    dataString = 'starting='+page+'&pay_note='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "supplier_idsupp"){ 
    dataString = 'starting='+page+'&supplier_idsupp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"receive_paymenthdr_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data receive_paymenthdr, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpaymenthdr"){ 
      dataString = 'idpaymenthdr='+ cari;  
   } 
   else if (combo == "pay_date"){ 
      dataString = 'pay_date='+ cari; 
    } 
   else if (combo == "pay_name"){ 
      dataString = 'pay_name='+ cari; 
    } 
   else if (combo == "pay_note"){ 
      dataString = 'pay_note='+ cari; 
    } 
   else if (combo == "supplier_idsupp"){ 
      dataString = 'supplier_idsupp='+ cari; 
    } 
 
  $.ajax({ 
    url: "receive_paymenthdr_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#receive_paymenthdr tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#receive_paymenthdr tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data receive_paymenthdr ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("receive_paymenthdr_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data receive_paymenthdr berhasil di hapus!"); 
					} 
					else{ 
						alert("data receive_paymenthdr gagal di hapus!"); 
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
 
if (isset($_GET['idpaymenthdr']) and !empty($_GET['idpaymenthdr'])){ 
 $idpaymenthdr = $_GET['idpaymenthdr']; 
  $sql = "select * from receive_paymenthdr where idpaymenthdr like '%$idpaymenthdr%' order by idpaymenthdr"; 
} 
else if (isset($_GET['pay_date']) and !empty($_GET['pay_date'])){ 
 $pay_date = $_GET['pay_date']; 
  $sql = "select * from receive_paymenthdr where pay_date like '%$pay_date%' order by pay_date"; 
} 
else if (isset($_GET['pay_name']) and !empty($_GET['pay_name'])){ 
 $pay_name = $_GET['pay_name']; 
  $sql = "select * from receive_paymenthdr where pay_name like '%$pay_name%' order by pay_name"; 
} 
else if (isset($_GET['pay_note']) and !empty($_GET['pay_note'])){ 
 $pay_note = $_GET['pay_note']; 
  $sql = "select * from receive_paymenthdr where pay_note like '%$pay_note%' order by pay_note"; 
} 
else if (isset($_GET['supplier_idsupp']) and !empty($_GET['supplier_idsupp'])){ 
 $supplier_idsupp = $_GET['supplier_idsupp']; 
  $sql = "select * from receive_paymenthdr where supplier_idsupp like '%$supplier_idsupp%' order by supplier_idsupp"; 
} 
else{ 
  $sql = "select * from receive_paymenthdr"; 
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
	 
<p class="judul">Daftar Pembayaran Supplier</p> 
  <table id="receive_paymenthdr"> 
  <tr> 
 <th>No Dok</th>
<th>Tanggal</th>
<th>Nama</th>
<th>Catatan</th>
<th>Supplier</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data receive_paymenthdr 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idpaymenthdr'];?></td>
<td><? echo gettanggal($row['pay_date']);?></td>
<td><? echo $row['pay_name'];?></td>
<td><? echo $row['pay_note'];?></td>
<td><? echo $row['supplier_idsupp'];?></td>
 
        <td width="175px"> 
         <a href="receive_paymenthdr_detail.php?action=detail&id=<? echo $row['idpaymenthdr'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="receive_paymenthdr_form.php?action=update&id=<? echo $row['idpaymenthdr'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="receive_paymenthdr_process.php?action=delete&id=<? echo $row['idpaymenthdr'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
