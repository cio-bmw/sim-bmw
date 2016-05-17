 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "id"){ 
    dataString = 'starting='+page+'&id='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "message"){ 
    dataString = 'starting='+page+'&message='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "sender"){ 
    dataString = 'starting='+page+'&sender='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"message_display.php", 
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
   
	  if (combo == "id"){ 
      dataString = 'id='+ cari;  
   } 
   else if (combo == "message"){ 
      dataString = 'message='+ cari; 
    } 
   else if (combo == "sender"){ 
      dataString = 'sender='+ cari; 
    } 
 
  $.ajax({ 
    url: "message_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#message tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#message tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data message ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("message_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data message berhasil di hapus!"); 
					} 
					else{ 
						alert("data message gagal di hapus!"); 
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
 
if (isset($_GET['id']) and !empty($_GET['id'])){ 
 $id = $_GET['id']; 
  $sql = "select * from message where id like '%$id%' order by id"; 
} 
else if (isset($_GET['message']) and !empty($_GET['message'])){ 
 $message = $_GET['message']; 
  $sql = "select * from message where message like '%$message%' order by message"; 
} 
else if (isset($_GET['sender']) and !empty($_GET['sender'])){ 
 $sender = $_GET['sender']; 
  $sql = "select * from message where sender like '%$sender%' order by sender"; 
} 
else{ 
  $sql = "select * from message"; 
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
	 
  <table id="message"> 
  <tr> 
 <th>id</th>
<th>message</th>
<th>sender</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['id'];?></td>
<td><? echo $row['message'];?></td>
<td><? echo $row['sender'];?></td>
 
        <td><a href="message_form.php?action=update&id=<? echo $row['idmessage'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idmessage'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
