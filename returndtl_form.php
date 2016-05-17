  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data returndtl"; 
	$status="Tambah"; 
  
   $returnhdr_idreturnhdr = $_GET['returnhdr_idreturnhdr'];
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from returndtl where idreturndtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreturndtl=$data['idreturndtl']; 
		$qty=$data['qty']; 
		$costprice=$data['costprice']; 
		$price=$data['price']; 
		$returnhdr_idreturnhdr=$data['returnhdr_idreturnhdr']; 
		$product_idproduct=$data['product_idproduct']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data returndtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#product_idproduct").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input##idreturnhdr").val(); 
	 
      dataString = 'returnhdr_idreturnhdr='+ cari; 
   
 
    $.ajax({ 
      url: "returndtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#returndtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data returndtl ini?")){ 
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
        	url: "returndtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("returndtl_form.php?returnhdr_idreturnhdr="+$("input##idreturnhdr").val());   
             // $("#divPageEntry").show(); 
             
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
 }); 
 </script> 
<form method="post" name="returndtl_form" action="" id="returndtl_form">  
<table width="98%">  
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idreturndtl" name="idreturndtl" size="10" value="<? echo $idreturndtl;?>" />
<tr> 
<td class="right">Nama Barang</td> 
<td><input type="text" id="product_idproduct" name="product_idproduct" size="5" maxlength="25" value="<? echo $product_idproduct;?>" /> 
<input type="text" id="productname" name="product_name" size="30" maxlength="25" value="<? echo $productname;?>" /></td> 
</tr>
<tr>
<td class="right">Jumlah</td> 
<td><input type="text" id="qty" name="qty" size="5" maxlength="25" value="<? echo $qty;?>" /></td> 
</tr>
<input type="hidden" id="price" name="price" size="30" maxlength="25" value="<? echo $price;?>" />
<input type="hidden" id="returnhdr_idreturnhdr" name="returnhdr_idreturnhdr" size="30" maxlength="25" value="<? echo $returnhdr_idreturnhdr;?>" />
<tr>
<td></td>
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
<br>
