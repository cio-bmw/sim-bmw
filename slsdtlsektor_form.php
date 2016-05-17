  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data slsdtlsektor"; 
	$status="Tambah"; 
	
	$product_idproduct=$_GET['product']; 
   
 
   $qty = 1;
   $slshdrsektor_idslshdr = $_GET['idhdr'];

   $sql = "SELECT IFNULL(max(idslsdtl),0)+1  FROM slsdtlsektor";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idslsdtl = $data[0];	 
   
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from slsdtlsektor where idslsdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslsdtl=$data['idslsdtl']; 
		$cost_price=$data['cost_price']; 
		$qty=$data['qty']; 
		$dtl_discount=$data['dtl_discount']; 
		$sales_price=$data['sales_price']; 
		$dtl_percent=$data['dtl_percent']; 
		$product_idproduct=$data['product_idproduct']; 
		$slshdrsektor_idslshdr=$data['slshdrsektor_idslshdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data slsdtlsektor"; 
	} 
	$product=productinfo($product_idproduct);
   $sales_price=$product['salesprice']; 
   $cost_price=$product['costprice']; 
 
	  $productname = $product['productname'];
?> 
<script type="text/javascript"> 
$(function(){ 

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
   else if (combo == "slshdrsektor_idslshdr"){ 
      dataString = 'slshdrsektor_idslshdr='+ cari; 
    } 
 
    $.ajax({ 
      url: "slsdtlsektor_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#slsdtlsektor_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data slsdtlsektor ini?")){ 
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
        	url: "slsdtlsektor_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	document.slsdtlsektor_form.product_idproduct.value ="";
          	document.slsdtlsektor_form.productname.value ="";
          	document.slsdtlsektor_form.qty.value ="";
          	document.slsdtlsektor_form.sales_price.value ="";
          	
         
           page="slsdtlsektor_displaymini.php?id="+$("input#slshdrsektor_idslshdr").val();
   	     $("#divPageData").load(page); 
		     $("#divPageData").show(); 
		     
		     	page1="slsdtlsektor_dspproduct.php?id="+$("input#slshdrsektor_idslshdr").val();
	     	$("#divLOV").load(page1); 
		     return false; 
            alert("Data berhasil disimpan!"); 
           } 
           else if(response.status == 2) // return nilai dari hasil proses 
     	     {  
           alert("Update Data berhasil disimpan!"); 
      	  
      page="slsdtlsektor_display.php?id="+$("input#slshdrsektor_idslshdr").val();
   	$("#divPageData").load(page); 
		$("#divPageData").show(); 
		$("#divPageEntry").hide(); 
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
 }); 

 </script> 
<form method="post" name="slsdtlsektor_form" action="" id="slsdtlsektor_form">  
<p class="judul">Form Memasukkan Data Barang</p>
<table width="495px"> 
<tr><th colspan="6"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<input type="hidden" id="idslsdtl" name="idslsdtl" size="10" <? echo $readonly;?> value="<? echo $idslsdtl;?>" />
<?php } else {?> 
<input type="hidden" id="idslsdtl" name="idslsdtl" size="10" value="<? echo $idslsdtl;?>" />
<?php }?> 
<input type="hidden" id="cost_price" name="cost_price" size="30" maxlength="25" value="<? echo $cost_price;?>" />
<tr> 
<td><input type="text" id="product_idproduct" name="product_idproduct" size="3" maxlength="25" value="<? echo $product_idproduct;?>" /></td> 
<td><input type="text" id="productname" name="productname" size="25" maxlength="25" value="<? echo $productname;?>" /></td> 
<td><input class="right" type="text" id="qty" name="qty" size="2" maxlength="25" value="<? echo $qty;?>" /></td> 
<td><input class="right" type="text" id="sales_price" name="sales_price" size="4" maxlength="25" value="<? echo $sales_price;?>" /></td> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 

<input type="hidden" id="dtl_discount" name="dtl_discount" size="30" maxlength="25" value="<? echo $dtl_discount;?>" />
<input type="hidden" id="dtl_percent" name="dtl_percent" size="30" maxlength="25" value="<? echo $dtl_percent;?>" />
<input type="hidden" id="slshdrsektor_idslshdr" name="slshdrsektor_idslshdr" size="30" maxlength="25" value="<? echo $slshdrsektor_idslshdr;?>" />
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
