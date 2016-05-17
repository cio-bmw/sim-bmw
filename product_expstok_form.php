  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data product_expstok"; 
	$status="Tambah"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from product_expstok where idproduct_expstok = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$exp_date=$data['exp_date']; 
		$stok=$data['stok']; 
		$product_idproduct=$data['product_idproduct']; 
		$rcv_date=$data['rcv_date']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Data Pelanggan"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#product_expstok").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "exp_date"){ 
      dataString = 'exp_date='+ cari;  
   } 
   else if (combo == "stok"){ 
      dataString = 'stok='+ cari; 
    } 
   else if (combo == "product_idproduct"){ 
      dataString = 'product_idproduct='+ cari; 
    } 
   else if (combo == "rcv_date"){ 
      dataString = 'rcv_date='+ cari; 
    } 
 
    $.ajax({ 
      url: "product_expstok_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#product_expstok_form").submit(function(){ 
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
        	url: "product_expstok_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("product_expstok_form.php");   
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
<form method="post" name="product_expstok_form" action="" id="product_expstok_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td>ID Pelanggan</td><td><input type="text" id="idpelanggan" name="idpelanggan" size="10" <? echo $readonly;?> value="<? echo $idplgn;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td>exp_date</td> 
<td><input type="text" id="exp_date" name="exp_date" size="30" maxlength="25" value="<? echo $exp_date;?>" /></td> 
</tr> 
<tr> 
<td>stok</td> 
<td><input type="text" id="stok" name="stok" size="30" maxlength="25" value="<? echo $stok;?>" /></td> 
</tr> 
<tr> 
<td>product_idproduct</td> 
<td><input type="text" id="product_idproduct" name="product_idproduct" size="30" maxlength="25" value="<? echo $product_idproduct;?>" /></td> 
</tr> 
<tr> 
<td>rcv_date</td> 
<td><input type="text" id="rcv_date" name="rcv_date" size="30" maxlength="25" value="<? echo $rcv_date;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
