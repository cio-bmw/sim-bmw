  <?  
  include_once("config.php"); 
   	$product_idproduct = $_GET['product'];
   $tipe_idtipe = $_GET['idtipe'];
	$action="add"; 
	$judul="Penambahan Data RAB Type"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idbudget),0)+1  FROM tipe_materialbudget";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idbudget = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from tipe_materialbudget where idbudget = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idbudget=$data['idbudget']; 
		$qty=$data['qty']; 
		$tipe_idtipe=$data['tipe_idtipe']; 
		$product_idproduct=$data['product_idproduct']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data tipe_materialbudget"; 
	} 
$product = productinfo($product_idproduct);
$productname = $product['productname'];	
	
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#tipe_materialbudget").focus();  
  
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
      url: "tipe_materialbudget_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#tipe_materialbudget_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data tipe_materialbudget ini?")){ 
   //   var vNama = $("input#namapelanggan").val(); //mengambil id dari input 
   //   var vAlamat = $("textarea#alamat").val(); 
   //   var vNoHP = $("input#nohp").val(); 
   //   var myRegExp=/^\+62[0-9]+$/; 
   //    
   //   // cek validasi form dahulu, semua field data harus diisi 
   //   if ((vNama.replace(/\s/g,"") == "") || (vAlamat.replace(/\s/g,"") == "") || (vNoHP.replace(/\s/g,"") == "")) { 
   //     alert("Mohon melengkapi semua field data!"); 
   //     $("input#namapelanggan").focus(); 
   //     return false; 
   //   } 
   //   // cek validasi no handphone 
   //   else if (!myRegExp.test(vNoHP)){ 
   //     alert ('No handphone harus angka dan diawali +62 (contoh: +62818040567890)'); 
   //     $("input#nohp").focus(); 
   //    return false; 
   //   } 
   //   else{   
    		$.ajax({ 
        	url: "tipe_materialbudget_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
       //   	  alert("Data berhasil disimpan!"); 
          
          		page="tipe_materialbudget_form.php?idtipe="+$('input#idtipe').val(); 
		$("#divPageEntry").load(page); 
		$("#divPageEntry").show(); 

		page1="tipe_materialbudget_dspproduct.php?idtipe="+$('input#idtipe').val(); 
		$("#divLOV").load(page1); 
		$("#divLOV").show(); 


		page2="tipe_materialbudget_display.php?idtipe="+$('input#idtipe').val(); 
		$("#divPageData").load(page2); 
		$("#divPageData").show(); 
		$("#btnhide").show(); 
		return false; 
              
            } 
          	else 
          	{ 
          		alert("Data gagal di simpan!"); 
           	} 
        	} 
         }); 
     //		return false; 
     	} 
     //} 
     return false; 
   }); 
   
   $("#btnclose").click(function(){ 
   $("#divPageEntry").hide(); 
   $("#divLOV").hide(); 

   	return false; 
	}); 
 }); 
 </script> 
<form method="post" name="tipe_materialbudget_form" action="" id="tipe_materialbudget_form">  
<table width="500px"> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idbudget" name="idbudget" size="10" value="<? echo $idbudget;?>" />
<input type="hidden" id="tipe_idtipe" name="tipe_idtipe" size="30" maxlength="25" value="<? echo $tipe_idtipe;?>" />
<tr> 
<td class="right">Nama Barang</td> 
<td><input type="text" id="product_idproduct" name="product_idproduct" size="8" maxlength="25" value="<? echo $product_idproduct;?>" />
<input type="text" id="productname" name="productname" size="30" maxlength="25" value="<? echo $productname;?>" /></td> 
</tr>
<tr> 
<td class="right">Jumlah</td> 
<td>
<input type="text" id="qty" name="qty" size="30" maxlength="25" value="<? echo $qty;?>" />
</td> 
</tr> 

 
<tr> 
<td colspan="2">
<input class="button" type="submit" value="<? echo $status;?>">
<input class="button" type="button" id="btnclose" value="Tutup Form">

</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
