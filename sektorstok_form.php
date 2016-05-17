  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data sektorstok"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idsektorstok),0)+1  FROM sektorstok";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idsektorstok = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from sektorstok where idsektorstok = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idsektorstok=$data['idsektorstok']; 
		$qty=$data['qty']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$product_idproduct=$data['product_idproduct']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data sektorstok"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#sektorstok").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idsektorstok"){ 
      dataString = 'idsektorstok='+ cari;  
   } 
   else if (combo == "qty"){ 
      dataString = 'qty='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
 
    $.ajax({ 
      url: "sektorstok_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#sektorstok_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data sektorstok ini?")){ 
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
        	url: "sektorstok_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("sektorstok_form.php");   
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
   
 $("#btnlovsektor").click(function(){ 
		pagelov="sektor_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 
      
 $("#btnlovproduct").click(function(){ 
		pagelov="sektorstok_dspproduct.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 
   
   
   
 }); 
 </script> 
<form method="post" name="sektorstok_form" action="" id="sektorstok_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idsektorstok</td><td><input type="text" id="idsektorstok" name="idsektorstok" size="10" <? echo $readonly;?> value="<? echo $idsektorstok;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idsektorstok</td><td><input type="text" id="idsektorstok" name="idsektorstok" size="10" value="<? echo $idsektorstok;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">qty</td> 
<td><input type="text" id="qty" name="qty" size="30" maxlength="25" value="<? echo $qty;?>" /></td> 
</tr> 
<tr> 
<td class="right">sektor_idsektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="30" maxlength="25" value="<? echo $sektor_idsektor;?>" />
<input type="button" id="btnlovsektor" value="..." />
<input type="text" id="sektorname" name="sektorname" size="30" maxlength="25" value="<? echo $sektorname;?>" />

</td> 
</tr> 
<tr> 
<td class="right">product_idproduct</td> 
<td>
<input type="text" id="product_idproduct" name="product_idproduct" size="30" maxlength="25" value="<? echo $product_idproduct;?>" />
<input type="button" id="btnlovproduct" value="..." />
<input type="text" id="productname" name="productname" size="30" maxlength="25" value="<? echo $productname;?>" />

</td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
