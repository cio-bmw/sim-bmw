 <script type="text/javascript">  
 function pagination(page){ 
  var vcari = $("input#fieldcari").val(); 
  var vsektor = $("input#idsektor").val(); 
  var vid = $("input#idslshdr").val(); 

 dataString = 'starting='+page+'&sektor='+vsektor+'&cari='+vcari+'&id='+vid+'&random='+Math.random(); 
   
   
  $.ajax({ 
    url:"sektorstok_lov.php", 
    data: dataString, 
		type:"GET", 
		success:function(data) 
		{ 
			$('#divLOV').html(data); 
			
		
		} 
  }); 
} 
 
// fungsi untuk me-load tampilan list data sektorstok, data yang ditampilkan disesuaikan 
// juga dengan input data pada bagian search 
function loadData(){ 
  var vcari = $("input#fieldcari").val(); 
  var vsektor = $("input#idsektor").val(); 

 dataString = 'starting='+page+'&sektor='+vsektor+'&cari='+vcari+'&random='+Math.random(); 
   
   
  $.ajax({ 
    url: "sektorstok_lov.php", //file tempat pemrosesan permintaan (request) 
    type: "GET", 
    data: dataString, 
		success:function(data) 
		{ 
			$('#divlov').html(data); 
		} 
  }); 
} 
   
$(function(){  
  // membuat warna tampilan baris data pada tabel menjadi selang-seling 
  $('#sektorstok tr:even:not(#nav):not(#total)').addClass('even'); 
  $('#sektorstok tr:odd:not(#nav):not(#total)').addClass('odd'); 
  
$("a.pilih").click(function(){ 
		pagelov=$(this).attr("href"); 
		$("#divPageEntry").load(pagelov);
		$("#divPageEntry").show(); 
		$("#btnhide").show(); 
		return false; 
	}); 
	
$("#btncarilov").click(function(){ 
  	page="sektorstok_lov.php?id="+$("input#idslshdr").val()+"&cari="+$("input#fieldcari").val()+"&sektor="+$("input#idsektor").val();
		$("#divLOV").load(page); 
		$("#divLOV").show(); 
		return false; 
	}); 

	   
   
	 
});

</script> 
 
<?php 
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php'); 
include_once('pagination_class.php'); 
$fieldcari = $_GET['cari']; 
$sektor=$_GET['sektor'];
$id = $_GET['id'];
 
//$sql = "select * from sektorstok a, product b where a.product_idproduct = b.idproduct  
//and a.sektor_idsektor='".$sektor."' and b.productname like '%".$fieldcari."%'";  
 
$sql = "select * from sektorstok a, product b where a.product_idproduct = b.idproduct  
and b.productname like '%".$fieldcari."%'";  
 
 
if(isset($_GET['starting'])){ //starting page 
	$starting=$_GET['starting']; 
}else{ 
	$starting=0; 
} 
 
$recpage = 15;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql,$starting,$recpage);		 
$result = $obj->result; 
?> 
	 
	<form  name="sektorstok_lov" action="" id="sektorstok_lov">  
	<table width=480px>  
	<tr><td colspan=5 > 
	Cari Data : <input size=10 type="text" name="fieldcari" id="fieldcari" value="<? echo $fieldcari; ?>" />  
	<input class="button"  type="button" id="btncarilov" value="Cari Barang" /> 
	<input type="hidden" name="id" value="<? echo $id;?> "> 
	</td></tr>   
  <tr> 
 <th colspan=2>Nama Barang<? echo $fieldcari.$sektor.$id; ?></th>
<th>Stok</th>
<th>sektor</th>
<th>Aksi</th> 
  </tr> 
		<?php 
		//menampilkan data sektorstok 
		if(mysql_num_rows($result)!=0){ 
  		while($row = mysql_fetch_array($result)){
  		$product = productinfo($row['product_idproduct']);
  		$productname = $product['productname'];		
  			 ?>		 
       <tr> 
       
<td><? echo $row['product_idproduct'];?></td>
<td><? echo $productname;?></td>
<td><? echo $row['qty'];?></td>
<td><? echo $row['sektor_idsektor'];?></td>

 
<td><a href="slsdtlunit_form.php?action=addproduct&product=<? echo $row['product_idproduct'];?>&id=<? echo $id; ?>" class="pilih"><input class="button2" type="button" value="Pilih"></a></td></tr> 

  		<?} //end while ?> 
	 <tr id="nav"><td colspan="5"><?php echo $obj->anchors; ?></td></tr> 
	   <tr id="total"><td colspan="5"><?php echo $obj->total; ?></td></tr> 	
	
    <?}else{?> 
   <tr><td align="center" colspan="5">Tidak Ada Stok DI Gudang Sektor!</td></tr> 
    <?}?> 
	</table> 
	</form>	
