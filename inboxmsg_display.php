<? 
session_start();
$userid = $_SESSION['cookie_name'];
require_once ('login.php');
 ?>
 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data inboxmsg sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idinboxmsg"){ 
    dataString = 'starting='+page+'&idinboxmsg='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "status"){ 
    dataString = 'starting='+page+'&status='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "msg"){ 
    dataString = 'starting='+page+'&msg='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "inboxdate"){ 
    dataString = 'starting='+page+'&inboxdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idempfrom"){ 
    dataString = 'starting='+page+'&emp_idempfrom='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "emp_idempto"){ 
    dataString = 'starting='+page+'&emp_idempto='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"inboxmsg_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data inboxmsg, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idinboxmsg"){ 
      dataString = 'idinboxmsg='+ cari;  
   } 
   else if (combo == "status"){ 
      dataString = 'status='+ cari; 
    } 
   else if (combo == "msg"){ 
      dataString = 'msg='+ cari; 
    } 
   else if (combo == "inboxdate"){ 
      dataString = 'inboxdate='+ cari; 
    } 
   else if (combo == "emp_idempfrom"){ 
      dataString = 'emp_idempfrom='+ cari; 
    } 
   else if (combo == "emp_idempto"){ 
      dataString = 'emp_idempto='+ cari; 
    } 
 
  $.ajax({ 
    url: "inboxmsg_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#inboxmsg tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#inboxmsg tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data inboxmsg ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("inboxmsg_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data inboxmsg berhasil di hapus!"); 
					} 
					else{ 
						alert("data inboxmsg gagal di hapus!"); 
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
$emp = empinfo($userid);  			
$empname = $emp['empname'];	

  $sql = "select * from inboxmsg order by idinboxmsg desc "; 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 100;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	
<p class="judul" >Selamat Datang di SIMDEV BMW <? echo ucwords($empname); ?></p>	 
<div style="height: 275px; width:690px; padding-left:25px;  overflow-y: scroll;  overflow-x: scroll; border:1px;  background-color: #F7CB72;  "> 
		<?php 
		//menampilkan data inboxmsg 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
     $emp = empinfo($userid);  			
  		$empname = $emp['empname'];	
  			
  			 ?>		
<table style="-moz-border-radius:10px;  -khtml-border-radius: 10px; -webkit-border-radius:10px; border-radius: 10px;"><tr><td>  	
<p style=""><? echo '<font size=1 color=red>'.$row['inboxdate'].'</font>  <font size=1 color=green>pesan dari '.$empname.'</font>'; ?><br>
<pre>  <?  echo $row['msg'];?> </pre></p>
</td></tr></table>
<p><br></p>
  		<? } //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
</div>