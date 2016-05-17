 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data custpaydtl sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcustpaydtl"){ 
    dataString = 'starting='+page+'&idcustpaydtl='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pay_value"){ 
    dataString = 'starting='+page+'&pay_value='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "custpayhdr_idcustpayhdr"){ 
    dataString = 'starting='+page+'&custpayhdr_idcustpayhdr='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unitmstpayment_idpayment"){ 
    dataString = 'starting='+page+'&unitmstpayment_idpayment='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"custpaydtl_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data custpaydtl, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcustpaydtl"){ 
      dataString = 'idcustpaydtl='+ cari;  
   } 
   else if (combo == "pay_value"){ 
      dataString = 'pay_value='+ cari; 
    } 
   else if (combo == "custpayhdr_idcustpayhdr"){ 
      dataString = 'custpayhdr_idcustpayhdr='+ cari; 
    } 
   else if (combo == "unitmstpayment_idpayment"){ 
      dataString = 'unitmstpayment_idpayment='+ cari; 
    } 
 
  $.ajax({ 
    url: "custpaydtl_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#custpaydtl tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#custpaydtl tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data custpaydtl ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("custpaydtl_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data custpaydtl berhasil di hapus!"); 
					} 
					else{ 
						alert("data custpaydtl gagal di hapus!"); 
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
 
if (isset($_GET['idcustpaydtl']) and !empty($_GET['idcustpaydtl'])){ 
 $idcustpaydtl = $_GET['idcustpaydtl']; 
  $sql = "select * from custpaydtl where idcustpaydtl like '%$idcustpaydtl%' order by idcustpaydtl"; 
} 
else if (isset($_GET['pay_value']) and !empty($_GET['pay_value'])){ 
 $pay_value = $_GET['pay_value']; 
  $sql = "select * from custpaydtl where pay_value like '%$pay_value%' order by pay_value"; 
} 
else if (isset($_GET['custpayhdr_idcustpayhdr']) and !empty($_GET['custpayhdr_idcustpayhdr'])){ 
 $custpayhdr_idcustpayhdr = $_GET['custpayhdr_idcustpayhdr']; 
  $sql = "select * from custpaydtl where custpayhdr_idcustpayhdr like '%$custpayhdr_idcustpayhdr%' order by custpayhdr_idcustpayhdr"; 
} 
else if (isset($_GET['unitmstpayment_idpayment']) and !empty($_GET['unitmstpayment_idpayment'])){ 
 $unitmstpayment_idpayment = $_GET['unitmstpayment_idpayment']; 
  $sql = "select * from custpaydtl where unitmstpayment_idpayment like '%$unitmstpayment_idpayment%' order by unitmstpayment_idpayment"; 
} 
else{ 
  $sql = "select * from custpaydtl"; 
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
	 
  <table id="custpaydtl"> 
  <tr> 
 <th>idcustpaydtl</th>
<th>pay_value</th>
<th>custpayhdr_idcustpayhdr</th>
<th>unitmstpayment_idpayment</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data custpaydtl 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcustpaydtl'];?></td>
<td><? echo $row['pay_value'];?></td>
<td><? echo $row['custpayhdr_idcustpayhdr'];?></td>
<td><? echo $row['unitmstpayment_idpayment'];?></td>
 
        <td><a href="custpaydtl_form.php?action=update&id=<? echo $row['idcustpaydtl'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="custpaydtl_process.php?action=delete&id=<? echo $row['idcustpaydtl'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
