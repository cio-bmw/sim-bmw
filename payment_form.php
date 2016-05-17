  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data payment"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idpayment),0)+1  FROM payment";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idpayment = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from payment where idpayment = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpayment=$data['idpayment']; 
		$paymentdesc=$data['paymentdesc']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data payment"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#payment").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idpayment"){ 
      dataString = 'idpayment='+ cari;  
   } 
   else if (combo == "paymentdesc"){ 
      dataString = 'paymentdesc='+ cari; 
    } 
 
    $.ajax({ 
      url: "payment_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#payment_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data payment ini?")){ 
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
        	url: "payment_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("payment_form.php");   
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
<form method="post" name="payment_form" action="" id="payment_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idpayment</td><td><input type="text" id="idpayment" name="idpayment" size="10" <? echo $readonly;?> value="<? echo $idpayment;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idpayment</td><td><input type="text" id="idpayment" name="idpayment" size="10" value="<? echo $idpayment;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">paymentdesc</td> 
<td><input type="text" id="paymentdesc" name="paymentdesc" size="30" maxlength="25" value="<? echo $paymentdesc;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
