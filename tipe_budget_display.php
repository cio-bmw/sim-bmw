 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var cari = $("input#fieldcari").val(); 
  var combo = $("select#pilihcari").val(); 
   
	  if (combo == "idbudget"){ 
    dataString = 'starting='+page+'&idbudget='+cari+'&random='+Math.random(); 
   } 
   else if (combo == "qty"){ 
    dataString = 'starting='+page+'&qty='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "tipe_idtipe"){ 
    dataString = 'starting='+page+'&tipe_idtipe='+cari+'&random='+Math.random(); 
    } 
   else if (combo == "product_idproduct"){ 
    dataString = 'starting='+page+'&product_idproduct='+cari+'&random='+Math.random(); 
    } 
  else{ 
    dataString = 'starting='+page+'&random='+Math.random(); 
  } 
   
  $.ajax({ 
    url:"tipe_budget_display.php", 
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
   
	  if (combo == "idbudget"){ 
      dataString = 'idbudget='+ cari;  
   } 
   else if (combo == "qty"){ 
      dataString = 'qty='+ cari; 
    } 
   else if (combo == "tipe_idtipe"){ 
      dataString = 'tipe_idtipe='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
 
  $.ajax({ 
    url: "tipe_budget_display.php", //file tempat pemrosesan permintaan (request) 
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
  $('#tipe_budget tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#tipe_budget tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data tipe_budget ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("tipe_budget_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data tipe_budget berhasil di hapus!"); 
					} 
					else{ 
						alert("data tipe_budget gagal di hapus!"); 
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
 
if (isset($_GET['idbudget']) and !empty($_GET['idbudget'])){ 
 $idbudget = $_GET['idbudget']; 
  $sql = "select * from tipe_budget where idbudget like '%$idbudget%' order by idbudget"; 
} 
else if (isset($_GET['qty']) and !empty($_GET['qty'])){ 
 $qty = $_GET['qty']; 
  $sql = "select * from tipe_budget where qty like '%$qty%' order by qty"; 
} 
else if (isset($_GET['tipe_idtipe']) and !empty($_GET['tipe_idtipe'])){ 
 $tipe_idtipe = $_GET['tipe_idtipe']; 
  $sql = "select * from tipe_budget where tipe_idtipe like '%$tipe_idtipe%' order by tipe_idtipe"; 
} 
else if (isset($_GET['product_idproduct']) and !empty($_GET['product_idproduct'])){ 
 $product_idproduct = $_GET['product_idproduct']; 
  $sql = "select * from tipe_budget where product_idproduct like '%$product_idproduct%' order by product_idproduct"; 
} 
else{ 
  $sql = "select * from tipe_budget"; 
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
	 
  <table id="tipe_budget"> 
  <tr> 
 <th>idbudget</th>
<th>qty</th>
<th>tipe_idtipe</th>
<th>product_idproduct</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td><? echo $row['idbudget'];?></td>
<td><? echo $row['qty'];?></td>
<td><? echo $row['tipe_idtipe'];?></td>
<td><? echo $row['product_idproduct'];?></td>
 
        <td><a href="tipe_budget_form.php?action=update&id=<? echo $row['idtipe_budget'];?>" class="edit">edit</a> | <a href="proses_data.php?action=delete&id=<? echo $row['idtipe_budget'];?>" class="delete">delete</a></td></tr> 
  		<?} //end while ?> 
		 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
