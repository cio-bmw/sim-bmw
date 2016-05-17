 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data contractor sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcontractor"){ 
    dataString = 'starting='+page+'&idcontractor='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "contractorname"){ 
    dataString = 'starting='+page+'&contractorname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "contactno"){ 
    dataString = 'starting='+page+'&contactno='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "contactname"){ 
    dataString = 'starting='+page+'&contactname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "address"){ 
    dataString = 'starting='+page+'&address='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "bankname"){ 
    dataString = 'starting='+page+'&bankname='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "rekno"){ 
    dataString = 'starting='+page+'&rekno='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"contractor_display.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data contractor, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var dataString; 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idcontractor"){ 
      dataString = 'idcontractor='+ cari;  
   } 
   else if (combo == "contractorname"){ 
      dataString = 'contractorname='+ cari; 
    } 
   else if (combo == "contactno"){ 
      dataString = 'contactno='+ cari; 
    } 
   else if (combo == "contactname"){ 
      dataString = 'contactname='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "bankname"){ 
      dataString = 'bankname='+ cari; 
    } 
   else if (combo == "rekno"){ 
      dataString = 'rekno='+ cari; 
    } 
 
  $.ajax({ 
    url: "contractor_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#contractor tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#contractor tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data contractor ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("contractor_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data contractor berhasil di hapus!"); 
					} 
					else{ 
						alert("data contractor gagal di hapus!"); 
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
 
if (isset($_GET['idcontractor']) and !empty($_GET['idcontractor'])){ 
 $idcontractor = $_GET['idcontractor']; 
  $sql = "select * from contractor where idcontractor like '%$idcontractor%' order by idcontractor"; 
} 
else if (isset($_GET['contractorname']) and !empty($_GET['contractorname'])){ 
 $contractorname = $_GET['contractorname']; 
  $sql = "select * from contractor where contractorname like '%$contractorname%' order by contractorname"; 
} 
else if (isset($_GET['contactno']) and !empty($_GET['contactno'])){ 
 $contactno = $_GET['contactno']; 
  $sql = "select * from contractor where contactno like '%$contactno%' order by contactno"; 
} 
else if (isset($_GET['contactname']) and !empty($_GET['contactname'])){ 
 $contactname = $_GET['contactname']; 
  $sql = "select * from contractor where contactname like '%$contactname%' order by contactname"; 
} 
else if (isset($_GET['address']) and !empty($_GET['address'])){ 
 $address = $_GET['address']; 
  $sql = "select * from contractor where address like '%$address%' order by address"; 
} 
else if (isset($_GET['bankname']) and !empty($_GET['bankname'])){ 
 $bankname = $_GET['bankname']; 
  $sql = "select * from contractor where bankname like '%$bankname%' order by bankname"; 
} 
else if (isset($_GET['rekno']) and !empty($_GET['rekno'])){ 
 $rekno = $_GET['rekno']; 
  $sql = "select * from contractor where rekno like '%$rekno%' order by rekno"; 
} 
else{ 
  $sql = "select * from contractor"; 
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
	 
  <table id="contractor"> 
  <tr> 
 <th>idcontractor</th>
<th>contractorname</th>
<th>contactno</th>
<th>contactname</th>
<th>address</th>
<th>bankname</th>
<th>rekno</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data contractor 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idcontractor'];?></td>
<td><? echo $row['contractorname'];?></td>
<td><? echo $row['contactno'];?></td>
<td><? echo $row['contactname'];?></td>
<td><? echo $row['address'];?></td>
<td><? echo $row['bankname'];?></td>
<td><? echo $row['rekno'];?></td>
 
        <td><a href="contractor_form.php?action=update&id=<? echo $row['idcontractor'];?>" class="edit"> <input type="button" class="button" value="Edit"></a>   
       | <a href="contractor_process.php?action=delete&id=<? echo $row['idcontractor'];?>" class="delete"><input type="button" class="button" value="Delete"></a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
