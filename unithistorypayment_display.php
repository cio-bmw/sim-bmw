 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data unithistorypayment sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idunithistorypayment"){ 
    dataString = 'starting='+page+'&idunithistorypayment='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "pay_date"){ 
    dataString = 'starting='+page+'&pay_date='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pay_value"){ 
    dataString = 'starting='+page+'&pay_value='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pay_name"){ 
    dataString = 'starting='+page+'&pay_name='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pay_note"){ 
    dataString = 'starting='+page+'&pay_note='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unitmstpayment_idpayment"){ 
    dataString = 'starting='+page+'&unitmstpayment_idpayment='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "unithistory_idunithistory"){ 
    dataString = 'starting='+page+'&unithistory_idunithistory='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"unithistorypayment_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data unithistorypayment, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#idunithistory").val(); 
   
      dataString = 'id='+ cari;  
  
  $.ajax({ 
    url: "unithistorypayment_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#unithistorypayment tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#unithistorypayment tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data unithistorypayment ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("unithistorypayment_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data unithistorypayment berhasil di hapus!"); 
					} 
					else{ 
						alert("data unithistorypayment gagal di hapus!"); 
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
$id = $_GET['id']; 
 
$sql = "select * from unithistorypayment where idunithistorypayment = '$id' order by idunithistorypayment"; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
<p class="judul">Daftar unithistorypayment </p> 
  <table id="unithistorypayment"   style="min-width:500px;"> 
  <tr> 
 <th>Id</th>
<th>Tanggal Pembayaran</th>
<th>Nilai</th>
<th>Nama Pembayar</th>
<th>Jenis Pembayaran</th>
<th>Catatan</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data unithistorypayment 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ 
		$unitmstpayment = unitmstpaymentinfo($row['unitmstpayment_idpayment']);
		$paymentdesc=$unitmstpayment['paymentdesc'];

?>		 
       <tr> 
 <td><? echo $row['idunithistorypayment'];?></td>
<td><? echo gettanggal($row['pay_date']);?></td>

<td class="right"><? echo nf($row['pay_value']);?></td>
<td><? echo $row['pay_name'];?></td>
<td><? echo $paymentdesc;?></td>
<td><? echo $row['pay_note'];?></td>

        <td width="150px"> 
      <a href="unithistorypayment_form.php?action=update&id=<? echo $row['idunithistorypayment'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="unithistorypayment_process.php?action=delete&id=<? echo $row['idunithistorypayment'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
