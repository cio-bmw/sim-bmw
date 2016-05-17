  <?  
  include_once("config.php"); 
 
   
	$action="add"; 
	$judul="Form Penambahan Data Barang"; 
	$status="Tambah"; 
   $product_idproduct=$_GET['product']; 
   $sales_price=$_GET['price']; 
   $qty = 1;
	$slshdrsektor_idslshdr=$_GET['id'];

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
		$judul="Update data Pengeluaran Barang"; 
	} 
	
	$product = productinfo($product_idproduct);
	$productname=$product['productname'];
?> 
<script type="text/javascript"> 
function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
} 
  
 
$(function(){ 
  $("input#slsdtlsektor").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   var myvar = getURLParameter('id');
     var param = 'id=' +  myvar;
	   
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
      url: "slsdtlsektor_displaymini.php", 
      type: "GET", 
      data: param, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#slsdtlsektor_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data Pengeluaran Barang ini?")){ 
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
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("slsdtlsektor_form.php");   
              $("#divFormContent").hide(); 
              $("#btnhide").hide(); 
              
              page1="slsdtlsektor_dspproduct.php?id="+myvar; 
				$("#divLOV").load(page1); 
					$("#divLOV").show(); 
		//$("#btnhide").show(); 
				page2="slsdtlsektor_displaymini.php?id="+myvar; 
				$("#divPageData").load(page2); 
				$("#divPageData").show(); 
		
		
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
<table width="510px"> 
<tr><th colspan="6"><b><?php echo $judul; ?></b></th></tr> 
<tr>
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<td class="right">idslsdtl</td><td><input type="text" id="idslsdtl" name="idslsdtl" size="4" <? echo $readonly;?> value="<? echo $idslsdtl;?>" /></td> 
<?php }?> 
<td><input type="text" id="product_idproduct" name="product_idproduct" size="3" maxlength="25" value="<? echo $product_idproduct;?>" /></td> 
<td><input type="text" id="productname" name="productname" size="22" maxlength="25" value="<? echo $productname;?>" /></td> 

<td><input type="text" id="qty" name="qty" size="2" maxlength="25" value="<? echo $qty;?>" /></td> 
<td><input type="text" id="sales_price" name="sales_price" size="6" maxlength="25" value="<? echo $sales_price;?>" /></td> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 


<input type="text" id="slshdrsektor_idslshdr" name="slshdrsektor_idslshdr" size="30" maxlength="25" value="<? echo $slshdrsektor_idslshdr;?>" />
 

</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
