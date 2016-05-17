  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data customer"; 
	$status="Tambah"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from customer where idcustomer = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcustomer=$data['idcustomer']; 
		$custname=$data['custname']; 
		$birthdate=$data['birthdate']; 
		$address=$data['address']; 
		$phone=$data['phone']; 
		$creditlimit=$data['creditlimit']; 
		$tolerance=$data['tolerance']; 
		$active_record=$data['active_record']; 
		$cm_status=$data['cm_status']; 
		$cm_phone=$data['cm_phone']; 
		$age=$data['age']; 
		$agedesc=$data['agedesc']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Data Pelanggan"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#customer").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idcustomer"){ 
      dataString = 'idcustomer='+ cari;  
   } 
   else if (combo == "custname"){ 
      dataString = 'custname='+ cari; 
    } 
   else if (combo == "birthdate"){ 
      dataString = 'birthdate='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "phone"){ 
      dataString = 'phone='+ cari; 
    } 
   else if (combo == "creditlimit"){ 
      dataString = 'creditlimit='+ cari; 
    } 
   else if (combo == "tolerance"){ 
      dataString = 'tolerance='+ cari; 
    } 
   else if (combo == "active_record"){ 
      dataString = 'active_record='+ cari; 
    } 
   else if (combo == "cm_status"){ 
      dataString = 'cm_status='+ cari; 
    } 
   else if (combo == "cm_phone"){ 
      dataString = 'cm_phone='+ cari; 
    } 
   else if (combo == "age"){ 
      dataString = 'age='+ cari; 
    } 
   else if (combo == "agedesc"){ 
      dataString = 'agedesc='+ cari; 
    } 
 
    $.ajax({ 
      url: "customer_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#customer_form").submit(function(){ 
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
        	url: "customer_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("customer_form.php");   
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
<form method="post" name="customer_form" action="" id="customer_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td>ID Pelanggan</td><td><input type="text" id="idpelanggan" name="idpelanggan" size="10" <? echo $readonly;?> value="<? echo $idplgn;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td>idcustomer</td> 
<td><input type="text" id="idcustomer" name="idcustomer" size="30" maxlength="25" value="<? echo $idcustomer;?>" /></td> 
</tr> 
<tr> 
<td>custname</td> 
<td><input type="text" id="custname" name="custname" size="30" maxlength="25" value="<? echo $custname;?>" /></td> 
</tr> 
<tr> 
<td>birthdate</td> 
<td><input type="text" id="birthdate" name="birthdate" size="30" maxlength="25" value="<? echo $birthdate;?>" /></td> 
</tr> 
<tr> 
<td>address</td> 
<td><input type="text" id="address" name="address" size="30" maxlength="25" value="<? echo $address;?>" /></td> 
</tr> 
<tr> 
<td>phone</td> 
<td><input type="text" id="phone" name="phone" size="30" maxlength="25" value="<? echo $phone;?>" /></td> 
</tr> 
<tr> 
<td>creditlimit</td> 
<td><input type="text" id="creditlimit" name="creditlimit" size="30" maxlength="25" value="<? echo $creditlimit;?>" /></td> 
</tr> 
<tr> 
<td>tolerance</td> 
<td><input type="text" id="tolerance" name="tolerance" size="30" maxlength="25" value="<? echo $tolerance;?>" /></td> 
</tr> 
<tr> 
<td>active_record</td> 
<td><input type="text" id="active_record" name="active_record" size="30" maxlength="25" value="<? echo $active_record;?>" /></td> 
</tr> 
<tr> 
<td>cm_status</td> 
<td><input type="text" id="cm_status" name="cm_status" size="30" maxlength="25" value="<? echo $cm_status;?>" /></td> 
</tr> 
<tr> 
<td>cm_phone</td> 
<td><input type="text" id="cm_phone" name="cm_phone" size="30" maxlength="25" value="<? echo $cm_phone;?>" /></td> 
</tr> 
<tr> 
<td>age</td> 
<td><input type="text" id="age" name="age" size="30" maxlength="25" value="<? echo $age;?>" /></td> 
</tr> 
<tr> 
<td>agedesc</td> 
<td><input type="text" id="agedesc" name="agedesc" size="30" maxlength="25" value="<? echo $agedesc;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
