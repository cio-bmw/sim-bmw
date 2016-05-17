  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data supplier"; 
	$status="Tambah"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from supplier where idsupp = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idsupp=$data['idsupp']; 
		$suppname=$data['suppname']; 
		$supptype=$data['supptype']; 
		$address=$data['address']; 
		$phone=$data['phone']; 
		$fax=$data['fax']; 
		$email=$data['email']; 
		$website=$data['website']; 
		$creditlimit=$data['creditlimit']; 
		$npwp=$data['npwp']; 
		$contact=$data['contact']; 
		$pooverdue=$data['pooverdue']; 
		$aroverdue=$data['aroverdue']; 
		$active=$data['active']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data supplier"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#supplier").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idsupp"){ 
      dataString = 'idsupp='+ cari;  
   } 
   else if (combo == "suppname"){ 
      dataString = 'suppname='+ cari; 
    } 
   else if (combo == "supptype"){ 
      dataString = 'supptype='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "phone"){ 
      dataString = 'phone='+ cari; 
    } 
   else if (combo == "fax"){ 
      dataString = 'fax='+ cari; 
    } 
   else if (combo == "email"){ 
      dataString = 'email='+ cari; 
    } 
   else if (combo == "website"){ 
      dataString = 'website='+ cari; 
    } 
   else if (combo == "creditlimit"){ 
      dataString = 'creditlimit='+ cari; 
    } 
   else if (combo == "npwp"){ 
      dataString = 'npwp='+ cari; 
    } 
   else if (combo == "contact"){ 
      dataString = 'contact='+ cari; 
    } 
   else if (combo == "pooverdue"){ 
      dataString = 'pooverdue='+ cari; 
    } 
   else if (combo == "aroverdue"){ 
      dataString = 'aroverdue='+ cari; 
    } 
   else if (combo == "active"){ 
      dataString = 'active='+ cari; 
    } 
 
    $.ajax({ 
      url: "supplier_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#supplier_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data supplier ini?")){ 
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
        	url: "supplier_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("supplier_form.php");   
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
<form method="post" name="supplier_form" action="" id="supplier_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td>Kode</td><td><input type="text" id="idsupp" name="idsupp" size="10" <? echo $readonly;?> value="<? echo $idsupp;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td>Kode</td><td><input type="text" id="idsupp" name="idsupp" size="10" value="<? echo $idsupp;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td>Nama Supplier</td> 
<td><input type="text" id="suppname" name="suppname" size="30" maxlength="25" value="<? echo $suppname;?>" /></td> 
</tr> 
<tr> 
<td>Alamat</td> 
<td><textarea  id="address" name="address" cols="50"><? echo $address;?></textarea></td> 
</tr> 
<tr> 
<td>No Telepone</td> 
<td><input type="text" id="phone" name="phone" size="30" maxlength="25" value="<? echo $phone;?>" /></td> 
</tr> 
<tr> 
<td>Fax</td> 
<td><input type="text" id="fax" name="fax" size="30" maxlength="25" value="<? echo $fax;?>" /></td> 
</tr> 
<tr> 
<td>Email</td> 
<td><input type="text" id="email" name="email" size="30" maxlength="25" value="<? echo $email;?>" /></td> 
</tr> 
<tr> 
<td>Website</td> 
<td><input type="text" id="website" name="website" size="30" maxlength="25" value="<? echo $website;?>" /></td> 
</tr> 
<tr> 
<td>Credit Limit</td> 
<td><input type="text" id="creditlimit" name="creditlimit" size="30" maxlength="25" value="<? echo $creditlimit;?>" /></td> 
</tr> 
<tr> 
<td>NPWP</td> 
<td><input type="text" id="npwp" name="npwp" size="30" maxlength="25" value="<? echo $npwp;?>" /></td> 
</tr> 
<tr> 
<td>Nama contact</td> 
<td><input type="text" id="contact" name="contact" size="30" maxlength="25" value="<? echo $contact;?>" /></td> 
</tr> 

<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
