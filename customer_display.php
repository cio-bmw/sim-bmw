 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcustomer"){ 
    dataString = 'starting='+page+'&idcustomer='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "custname"){ 
    dataString = 'starting='+page+'&custname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "birthdate"){ 
    dataString = 'starting='+page+'&birthdate='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "address"){ 
    dataString = 'starting='+page+'&address='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "phone"){ 
    dataString = 'starting='+page+'&phone='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "creditlimit"){ 
    dataString = 'starting='+page+'&creditlimit='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "tolerance"){ 
    dataString = 'starting='+page+'&tolerance='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "active_record"){ 
    dataString = 'starting='+page+'&active_record='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "cm_status"){ 
    dataString = 'starting='+page+'&cm_status='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "cm_phone"){ 
    dataString = 'starting='+page+'&cm_phone='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "age"){ 
    dataString = 'starting='+page+'&age='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "agedesc"){ 
    dataString = 'starting='+page+'&agedesc='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"customer_display.php", 
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
   
	  if (combo == "idcustomer"){ 
      dataString = 'idcustomer='+ cari;  
   } 
   else if (combo == "custname"){ 
      dataString = 'custname='+ cari; 
    } 
   else if (combo == "birthdate"){ 
      dataString = 'birthdate='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "phone"){ 
      dataString = 'phone='+ cari; 
    } 
   else if (combo == "creditlimit"){ 
      dataString = 'creditlimit='+ cari; 
    } 
   else if (combo == "tolerance"){ 
      dataString = 'tolerance='+ cari; 
    } 
   else if (combo == "active_record"){ 
      dataString = 'active_record='+ cari; 
    } 
   else if (combo == "cm_status"){ 
      dataString = 'cm_status='+ cari; 
    } 
   else if (combo == "cm_phone"){ 
      dataString = 'cm_phone='+ cari; 
    } 
   else if (combo == "age"){ 
      dataString = 'age='+ cari; 
    } 
   else if (combo == "agedesc"){ 
      dataString = 'agedesc='+ cari; 
    } 
 
  $.ajax({ 
    url: "customer_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#customer tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#customer tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data customer ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("customer_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data customer berhasil di hapus!"); 
					} 
					else{ 
						alert("data customer gagal di hapus!"); 
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
 
if (isset($_GET['idcustomer']) and !empty($_GET['idcustomer'])){ 
 $idcustomer = $_GET['idcustomer']; 
  $sql = "select * from customer where idcustomer like '%$idcustomer%' order by idcustomer"; 
} 
else if (isset($_GET['custname']) and !empty($_GET['custname'])){ 
 $custname = $_GET['custname']; 
  $sql = "select * from customer where custname like '%$custname%' order by custname"; 
} 
else if (isset($_GET['birthdate']) and !empty($_GET['birthdate'])){ 
 $birthdate = $_GET['birthdate']; 
  $sql = "select * from customer where birthdate like '%$birthdate%' order by birthdate"; 
} 
else if (isset($_GET['address']) and !empty($_GET['address'])){ 
 $address = $_GET['address']; 
  $sql = "select * from customer where address like '%$address%' order by address"; 
} 
else if (isset($_GET['phone']) and !empty($_GET['phone'])){ 
 $phone = $_GET['phone']; 
  $sql = "select * from customer where phone like '%$phone%' order by phone"; 
} 
else if (isset($_GET['creditlimit']) and !empty($_GET['creditlimit'])){ 
 $creditlimit = $_GET['creditlimit']; 
  $sql = "select * from customer where creditlimit like '%$creditlimit%' order by creditlimit"; 
} 
else if (isset($_GET['tolerance']) and !empty($_GET['tolerance'])){ 
 $tolerance = $_GET['tolerance']; 
  $sql = "select * from customer where tolerance like '%$tolerance%' order by tolerance"; 
} 
else if (isset($_GET['active_record']) and !empty($_GET['active_record'])){ 
 $active_record = $_GET['active_record']; 
  $sql = "select * from customer where active_record like '%$active_record%' order by active_record"; 
} 
else if (isset($_GET['cm_status']) and !empty($_GET['cm_status'])){ 
 $cm_status = $_GET['cm_status']; 
  $sql = "select * from customer where cm_status like '%$cm_status%' order by cm_status"; 
} 
else if (isset($_GET['cm_phone']) and !empty($_GET['cm_phone'])){ 
 $cm_phone = $_GET['cm_phone']; 
  $sql = "select * from customer where cm_phone like '%$cm_phone%' order by cm_phone"; 
} 
else if (isset($_GET['age']) and !empty($_GET['age'])){ 
 $age = $_GET['age']; 
  $sql = "select * from customer where age like '%$age%' order by age"; 
} 
else if (isset($_GET['agedesc']) and !empty($_GET['agedesc'])){ 
 $agedesc = $_GET['agedesc']; 
  $sql = "select * from customer where agedesc like '%$agedesc%' order by agedesc"; 
} 
else{ 
  $sql = "select * from customer"; 
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
	 
  <table id="customer"> 
  <tr> 
 <th>idcustomer</th>
<th>custname</th>
<th>birthdate</th>
<th>address</th>
<th>phone</th>
<th>creditlimit</th>
<th>tolerance</th>
<th>active_record</th>
<th>cm_status</th>
<th>cm_phone</th>
<th>age</th>
<th>agedesc</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcustomer'];?></td>
<td><? echo $row['custname'];?></td>
<td><? echo $row['birthdate'];?></td>
<td><? echo $row['address'];?></td>
<td><? echo $row['phone'];?></td>
<td><? echo $row['creditlimit'];?></td>
<td><? echo $row['tolerance'];?></td>
<td><? echo $row['active_record'];?></td>
<td><? echo $row['cm_status'];?></td>
<td><? echo $row['cm_phone'];?></td>
<td><? echo $row['age'];?></td>
<td><? echo $row['agedesc'];?></td>
 
        <td><a href="customer_form.php?action=update&id=<? echo $row['idcustomer'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idcustomer'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
