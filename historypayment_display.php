 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data historypayment sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idhistorypayment"){ 
    dataString = 'starting='+page+'&idhistorypayment='+cari+'&random='+Math.random(); 
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
    url:"historypayment_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data historypayment, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idhistorypayment"){ 
      dataString = 'idhistorypayment='+ cari;  
   } 
   else if (combo == "pay_date"){ 
      dataString = 'pay_date='+ cari; 
    } 
   else if (combo == "pay_value"){ 
      dataString = 'pay_value='+ cari; 
    } 
   else if (combo == "pay_name"){ 
      dataString = 'pay_name='+ cari; 
    } 
   else if (combo == "pay_note"){ 
      dataString = 'pay_note='+ cari; 
    } 
   else if (combo == "unitmstpayment_idpayment"){ 
      dataString = 'unitmstpayment_idpayment='+ cari; 
    } 
   else if (combo == "unithistory_idunithistory"){ 
      dataString = 'unithistory_idunithistory='+ cari; 
    } 
 
  $.ajax({ 
    url: "historypayment_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#historypayment tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#historypayment tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
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
		if(confirm("Apakah benar akan menghapus data historypayment ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormEntry").load("historypayment_form.php"); 
						$("#divFormEntry").hide(); 
            alert("Data historypayment berhasil di hapus!"); 
					} 
					else{ 
						alert("data historypayment gagal di hapus!"); 
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
 
if (isset($_GET['idhistorypayment']) and !empty($_GET['idhistorypayment'])){ 
 $idhistorypayment = $_GET['idhistorypayment']; 
  $sql = "select * from historypayment where idhistorypayment like '%$idhistorypayment%' order by idhistorypayment"; 
} 
else if (isset($_GET['pay_date']) and !empty($_GET['pay_date'])){ 
 $pay_date = $_GET['pay_date']; 
  $sql = "select * from historypayment where pay_date like '%$pay_date%' order by pay_date"; 
} 
else if (isset($_GET['pay_value']) and !empty($_GET['pay_value'])){ 
 $pay_value = $_GET['pay_value']; 
  $sql = "select * from historypayment where pay_value like '%$pay_value%' order by pay_value"; 
} 
else if (isset($_GET['pay_name']) and !empty($_GET['pay_name'])){ 
 $pay_name = $_GET['pay_name']; 
  $sql = "select * from historypayment where pay_name like '%$pay_name%' order by pay_name"; 
} 
else if (isset($_GET['pay_note']) and !empty($_GET['pay_note'])){ 
 $pay_note = $_GET['pay_note']; 
  $sql = "select * from historypayment where pay_note like '%$pay_note%' order by pay_note"; 
} 
else if (isset($_GET['unitmstpayment_idpayment']) and !empty($_GET['unitmstpayment_idpayment'])){ 
 $unitmstpayment_idpayment = $_GET['unitmstpayment_idpayment']; 
  $sql = "select * from historypayment where unitmstpayment_idpayment like '%$unitmstpayment_idpayment%' order by unitmstpayment_idpayment"; 
} 
else if (isset($_GET['unithistory_idunithistory']) and !empty($_GET['unithistory_idunithistory'])){ 
 $unithistory_idunithistory = $_GET['unithistory_idunithistory']; 
  $sql = "select * from historypayment where unithistory_idunithistory like '%$unithistory_idunithistory%' order by unithistory_idunithistory"; 
} 
else{ 
  $sql = "select * from historypayment"; 
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
	 
<p class="judul">Daftar historypayment </p> 
  <table id="historypayment"   style="min-width:500px;"> 
  <tr> 
 <th>idhistorypayment</th>
<th>pay_date</th>
<th>pay_value</th>
<th>pay_name</th>
<th>pay_note</th>
<th>unitmstpayment_idpayment</th>
<th>unithistory_idunithistory</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data historypayment 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idhistorypayment'];?></td>
<td><? echo $row['pay_date'];?></td>
<td><? echo $row['pay_value'];?></td>
<td><? echo $row['pay_name'];?></td>
<td><? echo $row['pay_note'];?></td>
<td><? echo $row['unitmstpayment_idpayment'];?></td>
<td><? echo $row['unithistory_idunithistory'];?></td>
 
        <td width="150px"> 
         <a href="historypayment_detail.php?action=detail&id=<? echo $row['idhistorypayment'];?>" class="detail"> <input type="button" class="button" value="Detail"></a>   
       |  <a href="historypayment_form.php?action=update&id=<? echo $row['idhistorypayment'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="historypayment_process.php?action=delete&id=<? echo $row['idhistorypayment'];?>" class="delete"><input type="button" class="button" value="Delete"></a> 
         </td> 
         </tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <? }else{ ?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
