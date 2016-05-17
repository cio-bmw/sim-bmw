  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data receivedtlsektor"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idreceivedtl),0)+1  FROM receivedtlsektor";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idreceivedtl = $data[0];	 
   
   $receivehdrsektor_idreceivehdr = $_GET['id'];
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from receivedtlsektor where idreceivedtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreceivedtl=$data['idreceivedtl']; 
		$qty=$data['qty']; 
		$receive_price=$data['receive_price']; 
		$dtl_ppn=$data['dtl_ppn']; 
		$receive_priceppn=$data['receive_priceppn']; 
		$receive_pricedisc=$data['receive_pricedisc']; 
		$dtl_percent=$data['dtl_percent']; 
		$dtl_discount=$data['dtl_discount']; 
		$batch_no=$data['batch_no']; 
		$exp_date=$data['exp_date']; 
		$receivehdrsektor_idreceivehdr=$data['receivehdrsektor_idreceivehdr']; 
		$product_idproduct=$data['product_idproduct']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data receivedtlsektor"; 
	} 
	$product = productinfo($product_idproduct);
   $productname = $product['productname'];
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#receivedtlsektor").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idreceivedtl"){ 
      dataString = 'idreceivedtl='+ cari;  
   } 
   else if (combo == "qty"){ 
      dataString = 'qty='+ cari; 
    } 
   else if (combo == "receive_price"){ 
      dataString = 'receive_price='+ cari; 
    } 
   else if (combo == "dtl_ppn"){ 
      dataString = 'dtl_ppn='+ cari; 
    } 
   else if (combo == "receive_priceppn"){ 
      dataString = 'receive_priceppn='+ cari; 
    } 
   else if (combo == "receive_pricedisc"){ 
      dataString = 'receive_pricedisc='+ cari; 
    } 
   else if (combo == "dtl_percent"){ 
      dataString = 'dtl_percent='+ cari; 
    } 
   else if (combo == "dtl_discount"){ 
      dataString = 'dtl_discount='+ cari; 
    } 
   else if (combo == "batch_no"){ 
      dataString = 'batch_no='+ cari; 
    } 
   else if (combo == "exp_date"){ 
      dataString = 'exp_date='+ cari; 
    } 
   else if (combo == "receivehdrsektor_idreceivehdr"){ 
      dataString = 'receivehdrsektor_idreceivehdr='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
 
    $.ajax({ 
      url: "receivedtlsektor_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#receivedtlsektor_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data receivedtlsektor ini?")){ 
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
        	url: "receivedtlsektor_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
      var cari = $("input#idreceivehdr").val(); 
    
		page="receivedtlsektor_form.php?id="+cari;  
		$("#divPageEntry").load(page); 
		$("#divPageEntry").show(); 

		page1="receivedtlsektor_dspproduct.php?id="+cari; 
		$("#divLOV").load(page1); 
		$("#divLOV").show(); 
		
		//$("#btnhide").show(); 
		page2="receivedtlsektor_displaymini.php?id="+cari;
		$("#divPageData").load(page2); 
		$("#divPageData").show(); 

		
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
<p class="judul">Form Entry Penerimaan Barang</p> 
<form method="post" name="receivedtlsektor_form" action="" id="receivedtlsektor_form">  
<table> 
<tr><th colspan="4"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idreceivedtl" name="idreceivedtl" size="10" value="<? echo $idreceivedtl;?>" />
<input type="hidden" id="receivehdrsektor_idreceivehdr" name="receivehdrsektor_idreceivehdr" size="30" maxlength="25" value="<? echo $receivehdrsektor_idreceivehdr;?>" />

<tr> 
<td>Nama Barang</td> 
<td class="right">receive_price</td> 
<td class="right">qty</td> 
<td class="right">Aksi</td> 

</tr>
<tr>
<td>
<input type="text" id="product_idproduct" name="product_idproduct" size="3" maxlength="25" value="<? echo $product_idproduct;?>" />
<input type="text" id="productname" name="productname" size="22" maxlength="35" value="<? echo $productname;?>" readonly />
</td> 
<td><input class="right" type="text" id="receive_price" name="receive_price" size="10" maxlength="25" value="<? echo $receive_price;?>" /></td> 
<td><input class="right" type="text" id="qty" name="qty" size="5" maxlength="25" value="<? echo $qty;?>" /></td> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
