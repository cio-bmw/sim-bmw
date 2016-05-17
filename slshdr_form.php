  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data slshdr"; 
	$status="Tambah"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from slshdr where idslshdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslshdr=$data['idslshdr']; 
		$sls_date=$data['sls_date']; 
		$sls_bon=$data['sls_bon']; 
		$sls_titip=$data['sls_titip']; 
		$due_date=$data['due_date']; 
		$sls_blj=$data['sls_blj']; 
		$sls_tambahan=$data['sls_tambahan']; 
		$sls_total=$data['sls_total']; 
		$sls_bayar=$data['sls_bayar']; 
		$sls_kembali=$data['sls_kembali']; 
		$sls_desc=$data['sls_desc']; 
		$payment_date=$data['payment_date']; 
		$sls_status=$data['sls_status']; 
		$sls_diskon=$data['sls_diskon']; 
		$emp_idemp=$data['emp_idemp']; 
		$customer_idcustomer=$data['customer_idcustomer']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Data Pelanggan"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#slshdr").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idslshdr"){ 
      dataString = 'idslshdr='+ cari;  
   } 
   else if (combo == "sls_date"){ 
      dataString = 'sls_date='+ cari; 
    } 
   else if (combo == "sls_bon"){ 
      dataString = 'sls_bon='+ cari; 
    } 
   else if (combo == "sls_titip"){ 
      dataString = 'sls_titip='+ cari; 
    } 
   else if (combo == "due_date"){ 
      dataString = 'due_date='+ cari; 
    } 
   else if (combo == "sls_blj"){ 
      dataString = 'sls_blj='+ cari; 
    } 
   else if (combo == "sls_tambahan"){ 
      dataString = 'sls_tambahan='+ cari; 
    } 
   else if (combo == "sls_total"){ 
      dataString = 'sls_total='+ cari; 
    } 
   else if (combo == "sls_bayar"){ 
      dataString = 'sls_bayar='+ cari; 
    } 
   else if (combo == "sls_kembali"){ 
      dataString = 'sls_kembali='+ cari; 
    } 
   else if (combo == "sls_desc"){ 
      dataString = 'sls_desc='+ cari; 
    } 
   else if (combo == "payment_date"){ 
      dataString = 'payment_date='+ cari; 
    } 
   else if (combo == "sls_status"){ 
      dataString = 'sls_status='+ cari; 
    } 
   else if (combo == "sls_diskon"){ 
      dataString = 'sls_diskon='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
   else if (combo == "customer_idcustomer"){ 
      dataString = 'customer_idcustomer='+ cari; 
    } 
 
    $.ajax({ 
      url: "slshdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#slshdr_form").submit(function(){ 
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
        	url: "slshdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("slshdr_form.php");   
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
<form method="post" name="slshdr_form" action="" id="slshdr_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td>ID Pelanggan</td><td><input type="text" id="idpelanggan" name="idpelanggan" size="10" <? echo $readonly;?> value="<? echo $idplgn;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td>idslshdr</td> 
<td><input type="text" id="idslshdr" name="idslshdr" size="30" maxlength="25" value="<? echo $idslshdr;?>" /></td> 
</tr> 
<tr> 
<td>sls_date</td> 
<td><input type="text" id="sls_date" name="sls_date" size="30" maxlength="25" value="<? echo $sls_date;?>" /></td> 
</tr> 
<tr> 
<td>sls_bon</td> 
<td><input type="text" id="sls_bon" name="sls_bon" size="30" maxlength="25" value="<? echo $sls_bon;?>" /></td> 
</tr> 
<tr> 
<td>sls_titip</td> 
<td><input type="text" id="sls_titip" name="sls_titip" size="30" maxlength="25" value="<? echo $sls_titip;?>" /></td> 
</tr> 
<tr> 
<td>due_date</td> 
<td><input type="text" id="due_date" name="due_date" size="30" maxlength="25" value="<? echo $due_date;?>" /></td> 
</tr> 
<tr> 
<td>sls_blj</td> 
<td><input type="text" id="sls_blj" name="sls_blj" size="30" maxlength="25" value="<? echo $sls_blj;?>" /></td> 
</tr> 
<tr> 
<td>sls_tambahan</td> 
<td><input type="text" id="sls_tambahan" name="sls_tambahan" size="30" maxlength="25" value="<? echo $sls_tambahan;?>" /></td> 
</tr> 
<tr> 
<td>sls_total</td> 
<td><input type="text" id="sls_total" name="sls_total" size="30" maxlength="25" value="<? echo $sls_total;?>" /></td> 
</tr> 
<tr> 
<td>sls_bayar</td> 
<td><input type="text" id="sls_bayar" name="sls_bayar" size="30" maxlength="25" value="<? echo $sls_bayar;?>" /></td> 
</tr> 
<tr> 
<td>sls_kembali</td> 
<td><input type="text" id="sls_kembali" name="sls_kembali" size="30" maxlength="25" value="<? echo $sls_kembali;?>" /></td> 
</tr> 
<tr> 
<td>sls_desc</td> 
<td><input type="text" id="sls_desc" name="sls_desc" size="30" maxlength="25" value="<? echo $sls_desc;?>" /></td> 
</tr> 
<tr> 
<td>payment_date</td> 
<td><input type="text" id="payment_date" name="payment_date" size="30" maxlength="25" value="<? echo $payment_date;?>" /></td> 
</tr> 
<tr> 
<td>sls_status</td> 
<td><input type="text" id="sls_status" name="sls_status" size="30" maxlength="25" value="<? echo $sls_status;?>" /></td> 
</tr> 
<tr> 
<td>sls_diskon</td> 
<td><input type="text" id="sls_diskon" name="sls_diskon" size="30" maxlength="25" value="<? echo $sls_diskon;?>" /></td> 
</tr> 
<tr> 
<td>emp_idemp</td> 
<td><input type="text" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" /></td> 
</tr> 
<tr> 
<td>customer_idcustomer</td> 
<td><input type="text" id="customer_idcustomer" name="customer_idcustomer" size="30" maxlength="25" value="<? echo $customer_idcustomer;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
