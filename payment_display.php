 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data payment sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpayment"){ 
    dataString = 'starting='+page+'&idpayment='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "paymentdesc"){ 
    dataString = 'starting='+page+'&paymentdesc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"payment_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data payment, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpayment"){ 
      dataString = 'idpayment='+ cari;  
   } 
   else if (combo == "paymentdesc"){ 
      dataString = 'paymentdesc='+ cari; 
    } 
 
  $.ajax({ 
    url: "payment_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#payment tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#payment tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data payment ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("payment_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data payment berhasil di hapus!"); 
					} 
					else{ 
						alert("data payment gagal di hapus!"); 
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
 
if (isset($_GET['idpayment']) and !empty($_GET['idpayment'])){ 
 $idpayment = $_GET['idpayment']; 
  $sql = "select * from payment where idpayment like '%$idpayment%' order by idpayment"; 
} 
else if (isset($_GET['paymentdesc']) and !empty($_GET['paymentdesc'])){ 
 $paymentdesc = $_GET['paymentdesc']; 
  $sql = "select * from payment where paymentdesc like '%$paymentdesc%' order by paymentdesc"; 
} 
else{ 
  $sql = "select * from payment"; 
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
	 
  <table id="payment"> 
  <tr> 
 <th>idpayment</th>
<th>paymentdesc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data payment 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idpayment'];?></td>
<td><? echo $row['paymentdesc'];?></td>
 
        <td><a href="payment_form.php?action=update&id=<? echo $row['idpayment'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="payment_process.php?action=delete&id=<? echo $row['idpayment'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
