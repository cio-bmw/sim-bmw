  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data custpaydtl"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idcustpaydtl),0)+1  FROM custpaydtl";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idcustpaydtl = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from custpaydtl where idcustpaydtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcustpaydtl=$data['idcustpaydtl']; 
		$pay_value=$data['pay_value']; 
		$custpayhdr_idcustpayhdr=$data['custpayhdr_idcustpayhdr']; 
		$unitmstpayment_idpayment=$data['unitmstpayment_idpayment']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data custpaydtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#custpaydtl").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idcustpaydtl"){ 
      dataString = 'idcustpaydtl='+ cari;  
   } 
   else if (combo == "pay_value"){ 
      dataString = 'pay_value='+ cari; 
    } 
   else if (combo == "custpayhdr_idcustpayhdr"){ 
      dataString = 'custpayhdr_idcustpayhdr='+ cari; 
    } 
   else if (combo == "unitmstpayment_idpayment"){ 
      dataString = 'unitmstpayment_idpayment='+ cari; 
    } 
 
    $.ajax({ 
      url: "custpaydtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#custpaydtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data custpaydtl ini?")){ 
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
        	url: "custpaydtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("custpaydtl_form.php");   
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
<form method="post" name="custpaydtl_form" action="" id="custpaydtl_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idcustpaydtl</td><td><input type="text" id="idcustpaydtl" name="idcustpaydtl" size="10" <? echo $readonly;?> value="<? echo $idcustpaydtl;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idcustpaydtl</td><td><input type="text" id="idcustpaydtl" name="idcustpaydtl" size="10" value="<? echo $idcustpaydtl;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">pay_value</td> 
<td><input type="text" id="pay_value" name="pay_value" size="30" maxlength="25" value="<? echo $pay_value;?>" /></td> 
</tr> 
<tr> 
<td class="right">custpayhdr_idcustpayhdr</td> 
<td><input type="text" id="custpayhdr_idcustpayhdr" name="custpayhdr_idcustpayhdr" size="30" maxlength="25" value="<? echo $custpayhdr_idcustpayhdr;?>" /></td> 
</tr> 
<tr> 
<td class="right">unitmstpayment_idpayment</td> 
<td><input type="text" id="unitmstpayment_idpayment" name="unitmstpayment_idpayment" size="30" maxlength="25" value="<? echo $unitmstpayment_idpayment;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
