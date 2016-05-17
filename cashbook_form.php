  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data cashbook"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idcashbook),0)+1  FROM cashbook";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idcashbook = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from cashbook where idcashbook = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcashbook=$data['idcashbook']; 
		$txndate=$data['txndate']; 
		$txnflag=$data['txnflag']; 
		$txnvalue=$data['txnvalue']; 
		$saldo=$data['saldo']; 
		$txndesc=$data['txndesc']; 
		$idcashin=$data['idcashin']; 
		$idcashouthdr=$data['idcashouthdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data cashbook"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#cashbook").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idcashbook"){ 
      dataString = 'idcashbook='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txnflag"){ 
      dataString = 'txnflag='+ cari; 
    } 
   else if (combo == "txnvalue"){ 
      dataString = 'txnvalue='+ cari; 
    } 
   else if (combo == "saldo"){ 
      dataString = 'saldo='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "idcashin"){ 
      dataString = 'idcashin='+ cari; 
    } 
   else if (combo == "idcashouthdr"){ 
      dataString = 'idcashouthdr='+ cari; 
    } 
 
    $.ajax({ 
      url: "cashbook_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#cashbook_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data cashbook ini?")){ 
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
        	url: "cashbook_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("cashbook_form.php");   
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
<form method="post" name="cashbook_form" action="" id="cashbook_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idcashbook</td><td><input type="text" id="idcashbook" name="idcashbook" size="10" <? echo $readonly;?> value="<? echo $idcashbook;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idcashbook</td><td><input type="text" id="idcashbook" name="idcashbook" size="10" value="<? echo $idcashbook;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">txndate</td> 
<td><input type="text" id="txndate" name="txndate" size="30" maxlength="25" value="<? echo $txndate;?>" /></td> 
</tr> 
<tr> 
<td class="right">txnflag</td> 
<td><input type="text" id="txnflag" name="txnflag" size="30" maxlength="25" value="<? echo $txnflag;?>" /></td> 
</tr> 
<tr> 
<td class="right">txnvalue</td> 
<td><input type="text" id="txnvalue" name="txnvalue" size="30" maxlength="25" value="<? echo $txnvalue;?>" /></td> 
</tr> 
<tr> 
<td class="right">saldo</td> 
<td><input type="text" id="saldo" name="saldo" size="30" maxlength="25" value="<? echo $saldo;?>" /></td> 
</tr> 
<tr> 
<td class="right">txndesc</td> 
<td><input type="text" id="txndesc" name="txndesc" size="30" maxlength="25" value="<? echo $txndesc;?>" /></td> 
</tr> 
<tr> 
<td class="right">idcashin</td> 
<td><input type="text" id="idcashin" name="idcashin" size="30" maxlength="25" value="<? echo $idcashin;?>" /></td> 
</tr> 
<tr> 
<td class="right">idcashouthdr</td> 
<td><input type="text" id="idcashouthdr" name="idcashouthdr" size="30" maxlength="25" value="<? echo $idcashouthdr;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
