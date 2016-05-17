 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data supplier sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsupp"){ 
    dataString = 'starting='+page+'&idsupp='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "suppname"){ 
    dataString = 'starting='+page+'&suppname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "supptype"){ 
    dataString = 'starting='+page+'&supptype='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "address"){ 
    dataString = 'starting='+page+'&address='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "phone"){ 
    dataString = 'starting='+page+'&phone='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "fax"){ 
    dataString = 'starting='+page+'&fax='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "email"){ 
    dataString = 'starting='+page+'&email='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "website"){ 
    dataString = 'starting='+page+'&website='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "creditlimit"){ 
    dataString = 'starting='+page+'&creditlimit='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "npwp"){ 
    dataString = 'starting='+page+'&npwp='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "contact"){ 
    dataString = 'starting='+page+'&contact='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "pooverdue"){ 
    dataString = 'starting='+page+'&pooverdue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "aroverdue"){ 
    dataString = 'starting='+page+'&aroverdue='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "active"){ 
    dataString = 'starting='+page+'&active='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"supplier_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data supplier, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idsupp"){ 
      dataString = 'idsupp='+ cari;  
   } 
   else if (combo == "suppname"){ 
      dataString = 'suppname='+ cari; 
    } 
   else if (combo == "supptype"){ 
      dataString = 'supptype='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "phone"){ 
      dataString = 'phone='+ cari; 
    } 
   else if (combo == "fax"){ 
      dataString = 'fax='+ cari; 
    } 
   else if (combo == "email"){ 
      dataString = 'email='+ cari; 
    } 
   else if (combo == "website"){ 
      dataString = 'website='+ cari; 
    } 
   else if (combo == "creditlimit"){ 
      dataString = 'creditlimit='+ cari; 
    } 
   else if (combo == "npwp"){ 
      dataString = 'npwp='+ cari; 
    } 
   else if (combo == "contact"){ 
      dataString = 'contact='+ cari; 
    } 
   else if (combo == "pooverdue"){ 
      dataString = 'pooverdue='+ cari; 
    } 
   else if (combo == "aroverdue"){ 
      dataString = 'aroverdue='+ cari; 
    } 
   else if (combo == "active"){ 
      dataString = 'active='+ cari; 
    } 
 
  $.ajax({ 
    url: "supplier_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#supplier tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#supplier tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data supplier ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("supplier_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data supplier berhasil di hapus!"); 
					} 
					else{ 
						alert("data supplier gagal di hapus!"); 
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
 
if (isset($_GET['idsupp']) and !empty($_GET['idsupp'])){ 
 $idsupp = $_GET['idsupp']; 
  $sql = "select * from supplier where idsupp like '%$idsupp%' order by idsupp"; 
} 
else if (isset($_GET['suppname']) and !empty($_GET['suppname'])){ 
 $suppname = $_GET['suppname']; 
  $sql = "select * from supplier where suppname like '%$suppname%' order by suppname"; 
} 
else if (isset($_GET['supptype']) and !empty($_GET['supptype'])){ 
 $supptype = $_GET['supptype']; 
  $sql = "select * from supplier where supptype like '%$supptype%' order by supptype"; 
} 
else if (isset($_GET['address']) and !empty($_GET['address'])){ 
 $address = $_GET['address']; 
  $sql = "select * from supplier where address like '%$address%' order by address"; 
} 
else if (isset($_GET['phone']) and !empty($_GET['phone'])){ 
 $phone = $_GET['phone']; 
  $sql = "select * from supplier where phone like '%$phone%' order by phone"; 
} 
else if (isset($_GET['fax']) and !empty($_GET['fax'])){ 
 $fax = $_GET['fax']; 
  $sql = "select * from supplier where fax like '%$fax%' order by fax"; 
} 
else if (isset($_GET['email']) and !empty($_GET['email'])){ 
 $email = $_GET['email']; 
  $sql = "select * from supplier where email like '%$email%' order by email"; 
} 
else if (isset($_GET['website']) and !empty($_GET['website'])){ 
 $website = $_GET['website']; 
  $sql = "select * from supplier where website like '%$website%' order by website"; 
} 
else if (isset($_GET['creditlimit']) and !empty($_GET['creditlimit'])){ 
 $creditlimit = $_GET['creditlimit']; 
  $sql = "select * from supplier where creditlimit like '%$creditlimit%' order by creditlimit"; 
} 
else if (isset($_GET['npwp']) and !empty($_GET['npwp'])){ 
 $npwp = $_GET['npwp']; 
  $sql = "select * from supplier where npwp like '%$npwp%' order by npwp"; 
} 
else if (isset($_GET['contact']) and !empty($_GET['contact'])){ 
 $contact = $_GET['contact']; 
  $sql = "select * from supplier where contact like '%$contact%' order by contact"; 
} 
else if (isset($_GET['pooverdue']) and !empty($_GET['pooverdue'])){ 
 $pooverdue = $_GET['pooverdue']; 
  $sql = "select * from supplier where pooverdue like '%$pooverdue%' order by pooverdue"; 
} 
else if (isset($_GET['aroverdue']) and !empty($_GET['aroverdue'])){ 
 $aroverdue = $_GET['aroverdue']; 
  $sql = "select * from supplier where aroverdue like '%$aroverdue%' order by aroverdue"; 
} 
else if (isset($_GET['active']) and !empty($_GET['active'])){ 
 $active = $_GET['active']; 
  $sql = "select * from supplier where active like '%$active%' order by active"; 
} 
else{ 
  $sql = "select * from supplier"; 
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
	 
  <table id="supplier" class="minigrid1"> 
  <tr> 
 <th>Kode</th>
<th>Nama Supplier</th>
<th>Alamat</th>
<th>Phone</th>
<th>contact</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data supplier 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idsupp'];?></td>
<td><? echo $row['suppname'];?></td>
<td><? echo $row['address'];?></td>
<td width=10><? echo $row['phone'];?></td>
<td width=10><? echo $row['contact'];?></td>
 
        <td><a href="supplier_form.php?action=update&id=<? echo $row['idsupp'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="supplier_process.php?action=delete&id=<? echo $row['idsupp'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="7"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="7"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
