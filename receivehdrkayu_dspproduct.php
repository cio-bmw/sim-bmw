 <script type="text/javascript">  
 
// fungsi ini untuk menampilkan list data pelanggan sesuai halaman (page) yang dipilih. 
// list data yang ditampilkan disesuaikan juga dengan input data pada bagian search. 
function pagination(page){ 
  var vcari = $("input#fieldcari").val(); 
  	
    dataString = 'starting='+page+'&cari='+vcari+'&random='+Math.random(); 
   
   
  $.ajax({ 
    url:"receivehdr_dspproduct.php", 
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
  var vcari = $("input#fieldcari").val(); 
 
  dataString = 'cari='+ vcari; 
  
  $.ajax({ 
    url: "receivehdr_dspproduct.php", //file tempat pemrosesan permintaan (request) 
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
  $('#product tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#product tr:odd:not(#nav):not(#total)').addClass('odd'); 
   
	$("a.edit").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	
	$("a.pilih").click(function(){ 
		page=$(this).attr("href"); 
		$("#divPageEntry").load(page); // me-load formpelanggan untuk melakukan edit data 
		$("#divPageEntry").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	 
	$("a.delete").click(function(){ 
		el=$(this); 
		if(confirm("Apakah benar akan menghapus data product ini?")) 
		{ 
			$.ajax({ 
				url:$(this).attr("href"),  
				type:"GET", 
				dataType: 'json', //respon yang diminta dalam format JSON 
				success:function(response) 
				{ 
					if(response.status == 1){ 
						loadData(); 
						$("#divFormContent").load("product_form.php"); 
						$("#divFormContent").hide(); 
            $("#btnhide").hide(); 
            alert("Data product berhasil di hapus!"); 
					} 
					else{ 
						alert("data product gagal di hapus!"); 
					} 
				} 
			}); 
		} 
		return false; 
	}); 

$("#btncloseproduct").click(function(){ 
	  	page="receivedtl_display.php?id="+$("input#idreceivehdr").val();
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		$("#divPageEntry").hide();
		return false; 
	}); 
$("#btncari").click(function(){ 
	  	page="rjhdrs_dspproduct.php?id="+$("input#idrjhdrs").val()+"&cari="+$("input#fieldcari").val();
		$("#divPageData").load(page); 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 

	 
}); 
 
</script> 
 

<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$id = $_GET['id'];  
$cari = $_GET['cari'];
$sql = "select * from product where productname like '%".$cari."%'";  
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 25;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
<form method="post" name="dspproduct" action="" id="dspproduct">
<table width="550px"> 
<tr><td colspan=5 >
Cari Nama product : <input size=10 type="text" name="fieldcari" id="fieldcari" value="%" /> 
<input type="button" id="btncari" value="Tampilkan" />
<input type="button" id="btncloseproduct" value="Close">
<input type="hidden" name="id" value=<? echo $id; ?>
</td></tr>  
  <tr> 
 <th>Kode</th>
<th>Nama product</th>
<th>Harga</th>
<th>Stock</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data pelanggan 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){ ?>		 
       <tr> 
 <td ><? echo $row['idproduct'];?></td>
<td ><? echo $row['productname'];?></td>
<td class="right"><? echo nf($row['salesprice']);?></td>
<td " class="right"><? echo nf($row['stock']);?></td>
 
<td><a href="receivedtl_form.php?action=addproduct&product=<? echo $row['idproduct'];?>&price=<? echo $row['salesprice'];?>&id=<? echo $id; ?>" class="pilih">Pilih</a></td></tr> 

  		<?} //end while ?> 
		 
    <?}else{?> 
   <tr><td align="center" colspan="5">Data tidak ditemukan!</td></tr> 
    <?}?> 
	</table> 
	</form>