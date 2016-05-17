 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data publicchat sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpublicchat"){ 
    dataString = 'starting='+page+'&idpublicchat='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "chatdate"){ 
    dataString = 'starting='+page+'&chatdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "chatmsg"){ 
    dataString = 'starting='+page+'&chatmsg='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "chatimg"){ 
    dataString = 'starting='+page+'&chatimg='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idemp"){ 
    dataString = 'starting='+page+'&emp_idemp='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"publicchat_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data publicchat, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idpublicchat"){ 
      dataString = 'idpublicchat='+ cari;  
   } 
   else if (combo == "chatdate"){ 
      dataString = 'chatdate='+ cari; 
    } 
   else if (combo == "chatmsg"){ 
      dataString = 'chatmsg='+ cari; 
    } 
   else if (combo == "chatimg"){ 
      dataString = 'chatimg='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
  $.ajax({ 
    url: "publicchat_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#publicchat tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#publicchat tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data publicchat ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("publicchat_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data publicchat berhasil di hapus!"); 
					} 
					else{ 
						alert("data publicchat gagal di hapus!"); 
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
 
if (isset($_GET['idpublicchat']) and !empty($_GET['idpublicchat'])){ 
 $idpublicchat = $_GET['idpublicchat']; 
  $sql = "select * from publicchat where idpublicchat like '%$idpublicchat%' order by idpublicchat"; 
} 
else if (isset($_GET['chatdate']) and !empty($_GET['chatdate'])){ 
 $chatdate = $_GET['chatdate']; 
  $sql = "select * from publicchat where chatdate like '%$chatdate%' order by chatdate"; 
} 
else if (isset($_GET['chatmsg']) and !empty($_GET['chatmsg'])){ 
 $chatmsg = $_GET['chatmsg']; 
  $sql = "select * from publicchat where chatmsg like '%$chatmsg%' order by chatmsg"; 
} 
else if (isset($_GET['chatimg']) and !empty($_GET['chatimg'])){ 
 $chatimg = $_GET['chatimg']; 
  $sql = "select * from publicchat where chatimg like '%$chatimg%' order by chatimg"; 
} 
else if (isset($_GET['emp_idemp']) and !empty($_GET['emp_idemp'])){ 
 $emp_idemp = $_GET['emp_idemp']; 
  $sql = "select * from publicchat where emp_idemp like '%$emp_idemp%' order by emp_idemp"; 
} 
else{ 
  $sql = "select * from publicchat order by chatdate desc"; 
} 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
<table bgcolor="#FFFDC2" width="800px" id="publicchat"> 
  <?php 
		//menampilkan data publicchat 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  		$emp = empinfo($row['emp_idemp']);
  		$empname = $emp['empname'];	
  		?>		 
<tr> 
<td width="180px" valign="top"><font color="#<? echo $row['color']; ?>"><? echo $row['chatdate'].'->'.$empname;?></td>
<td ><font color="#<? echo $row['color']; ?>"><? echo $row['chatmsg'];?></td></font>
</tr> 
  		<?} //end while ?> 
    <?}else{?> 
<tr><td align="center" colspan="3">Data tidak ditemukan!</td></tr> 
    <?}?> 
</table> 
