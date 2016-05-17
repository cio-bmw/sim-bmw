  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data slsdtl"; 
	$status="Tambah"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from slsdtl where idslsdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslsdtl=$data['idslsdtl']; 
		$cost_price=$data['cost_price']; 
		$qty=$data['qty']; 
		$dtl_discount=$data['dtl_discount']; 
		$sales_price=$data['sales_price']; 
		$dtl_percent=$data['dtl_percent']; 
		$product_idproduct=$data['product_idproduct']; 
		$slshdr_idslshdr=$data['slshdr_idslshdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Data Pelanggan"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#slsdtl").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idslsdtl"){ 
      dataString = 'idslsdtl='+ cari;  
   } 
   else if (combo == "cost_price"){ 
      dataString = 'cost_price='+ cari; 
    } 
   else if (combo == "qty"){ 
      dataString = 'qty='+ cari; 
    } 
   else if (combo == "dtl_discount"){ 
      dataString = 'dtl_discount='+ cari; 
    } 
   else if (combo == "sales_price"){ 
      dataString = 'sales_price='+ cari; 
    } 
   else if (combo == "dtl_percent"){ 
      dataString = 'dtl_percent='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
   else if (combo == "slshdr_idslshdr"){ 
      dataString = 'slshdr_idslshdr='+ cari; 
    } 
 
    $.ajax({ 
      url: "slsdtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#slsdtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data pelanggan ini?")){ 
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
        	url: "slsdtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("slsdtl_form.php");   
              $("#divFormContent").hide(); 
              $("#btnhide").hide(); 
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
<form method="post" name="slsdtl_form" action="" id="slsdtl_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td>ID Pelanggan</td><td><input type="text" id="idpelanggan" name="idpelanggan" size="10" <? echo $readonly;?> value="<? echo $idplgn;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td>idslsdtl</td> 
<td><input type="text" id="idslsdtl" name="idslsdtl" size="30" maxlength="25" value="<? echo $idslsdtl;?>" /></td> 
</tr> 
<tr> 
<td>cost_price</td> 
<td><input type="text" id="cost_price" name="cost_price" size="30" maxlength="25" value="<? echo $cost_price;?>" /></td> 
</tr> 
<tr> 
<td>qty</td> 
<td><input type="text" id="qty" name="qty" size="30" maxlength="25" value="<? echo $qty;?>" /></td> 
</tr> 
<tr> 
<td>dtl_discount</td> 
<td><input type="text" id="dtl_discount" name="dtl_discount" size="30" maxlength="25" value="<? echo $dtl_discount;?>" /></td> 
</tr> 
<tr> 
<td>sales_price</td> 
<td><input type="text" id="sales_price" name="sales_price" size="30" maxlength="25" value="<? echo $sales_price;?>" /></td> 
</tr> 
<tr> 
<td>dtl_percent</td> 
<td><input type="text" id="dtl_percent" name="dtl_percent" size="30" maxlength="25" value="<? echo $dtl_percent;?>" /></td> 
</tr> 
<tr> 
<td>product_idproduct</td> 
<td><input type="text" id="product_idproduct" name="product_idproduct" size="30" maxlength="25" value="<? echo $product_idproduct;?>" /></td> 
</tr> 
<tr> 
<td>slshdr_idslshdr</td> 
<td><input type="text" id="slshdr_idslshdr" name="slshdr_idslshdr" size="30" maxlength="25" value="<? echo $slshdr_idslshdr;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
