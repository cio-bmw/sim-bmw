  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data Penerimaan Kayu"; 
	$status="Tambah"; 
		$product_idproduct=$_GET['product'];
		$receive_price=$_GET['price'];
		$qty = $_GET['qty'];
		$qty=1;
	
	$receivehdr_idreceivehdr =$_GET['id'];
	
	 $sql = "SELECT IFNULL(max(idreceivedtl),0)+1  FROM receivedtlkayu";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idreceivedtl = $data[0];	 	
	
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from receivedtlkayu where idreceivedtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreceivedtl=$data['idreceivedtl']; 
		$product_idproduct=$data['product_idproduct']; 
		$qty=$data['qty']; 
		$receive_price=$data['receive_price']; 
		$dtl_ppn=$data['dtl_ppn']; 
		$receive_priceppn=$data['receive_priceppn']; 
		$receive_pricedisc=$data['receive_pricedisc']; 
		$dtl_percent=$data['dtl_percent']; 
		$dtl_discount=$data['dtl_discount']; 
		$receivehdr_idreceivehdr=$data['receivehdr_idreceivehdr']; 
		$batch_no=$data['batch_no']; 
		$exp_date=$data['exp_date']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data Penerimaan Barang"; 
	}
	$product=productinfo($product_idproduct);
	$productname = $product['productname'];
	 
?> 
<script type="text/javascript"> 


 $(function(){ 
  $("input#product_idproduct").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#idreceivehdr").val(); 
      dataString = 'id='+ cari; 
   
 
    $.ajax({ 
    
   
    url: "receivedtlkayu_displaymini.php",
  
     type: "GET", 
     data: dataString, 
       
 		success:function(data) 
		{ 
			$('#divPageData').html(data); 
		
		
			
 		} 
   }); 
  } 
 
  $("form#receivedtlkayu_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data penambahan barang ini?")){
    	
    	var myvar = getURLParameter('id');
 var param = 'id=' +  myvar; 
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
        	url: "receivedtlkayu_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	
          	{  
          	
    
          	  alert("Data Baru berhasil disimpan!"); 
          //    loadData(); //reload list data 
          
      page="receivedtlkayu_form.php?id="+$("input#idreceivehdr").val(); 
		$("#divPageEntry").load(page); 
		$("#divPageEntry").show(); 
		//$("#btnhide").show(); 
		page1="receivedtlkayu_dspproduct.php?id="+$("input#idreceivehdr").val(); 
		$("#divLOV").load(page1); 
		$("#divLOV").show(); 
		//$("#btnhide").show(); 
		page2="receivedtlkayu_displaymini.php?id="+$("input#idreceivehdr").val();
		$("#divPageData").load(page2); 
		$("#divPageData").show(); 
		
		return false; 
            } 
            else if(response.status == 2) {
            	  alert("Perubahan Data berhasil disimpan!"); 
       page2="receivedtlkayu_display.php?id="+$("input#idreceivehdr").val();
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
   
  function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
} 
  
 }); 
 </script> 
<form method="post" name="receivedtlkayu_form" action="" id="receivedtlkayu_form">  
<p class="judul">Form Memasukkan Penerimaan Kayu</p>
<table width="498px"> 
<tr><th colspan="7"><b><?php echo $judul; ?></b></th></tr> 
<tr><td></td><td>Kode</td><td>Nama Barang</td><td>Harga</td><td>Jumlah</td></tr>
<tr><td>
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<input type="hidden" id="idreceivedtl" name="idreceivedtl" size="10" <? echo $readonly;?> value="<? echo $idreceivedtl;?>" />
<?php } else {?> 
<input type="hidden" id="idreceivedtl" name="idreceivedtl" size="10" value="<? echo $idreceivedtl;?>" />
<?php }?> 
</td>
<td><input type="text" id="product_idproduct" name="product_idproduct" size="5" maxlength="25" value="<? echo $product_idproduct;?>" /></td> 
<td><input type="text" id="productname" name="productname" size="20" maxlength="25" value="<? echo $productname;?>" /></td> 


<td><input type="text" id="receive_price" name="receive_price" size="5" maxlength="25" value="<? echo $receive_price;?>" /></td> 
<td><input type="text" id="qty" name="qty" size="2" maxlength="5" value="<? echo $qty;?>" /></td> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 

<input type="hidden" name="action" value="<? echo $action;?>" /> 
<input type="hidden" id="receivehdr_idreceivehdr" name="receivehdr_idreceivehdr" size="30" maxlength="25" value="<? echo $receivehdr_idreceivehdr;?>" />


</form> 
