  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data rabsektor"; 
	$status="Tambah"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from rabsektor where idrabsektor = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idrabsektor=$data['idrabsektor']; 
		$qtyrab=$data['qtyrab']; 
		$rabprice=$data['rabprice']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$rabmst_idrabmst=$data['rabmst_idrabmst']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Data Pelanggan"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#rabsektor").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idrabsektor"){ 
      dataString = 'idrabsektor='+ cari;  
   } 
   else if (combo == "qtyrab"){ 
      dataString = 'qtyrab='+ cari; 
    } 
   else if (combo == "rabprice"){ 
      dataString = 'rabprice='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
   else if (combo == "rabmst_idrabmst"){ 
      dataString = 'rabmst_idrabmst='+ cari; 
    } 
 
    $.ajax({ 
      url: "rabsektor_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#rabsektor_form").submit(function(){ 
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
        	url: "rabsektor_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("rabsektor_form.php");   
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
<form method="post" name="rabsektor_form" action="" id="rabsektor_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td>ID Pelanggan</td><td><input type="text" id="idpelanggan" name="idpelanggan" size="10" <? echo $readonly;?> value="<? echo $idplgn;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td>idrabsektor</td> 
<td><input type="text" id="idrabsektor" name="idrabsektor" size="30" maxlength="25" value="<? echo $idrabsektor;?>" /></td> 
</tr> 
<tr> 
<td>qtyrab</td> 
<td><input type="text" id="qtyrab" name="qtyrab" size="30" maxlength="25" value="<? echo $qtyrab;?>" /></td> 
</tr> 
<tr> 
<td>rabprice</td> 
<td><input type="text" id="rabprice" name="rabprice" size="30" maxlength="25" value="<? echo $rabprice;?>" /></td> 
</tr> 
<tr> 
<td>sektor_idsektor</td> 
<td><input type="text" id="sektor_idsektor" name="sektor_idsektor" size="30" maxlength="25" value="<? echo $sektor_idsektor;?>" /></td> 
</tr> 
<tr> 
<td>rabmst_idrabmst</td> 
<td><input type="text" id="rabmst_idrabmst" name="rabmst_idrabmst" size="30" maxlength="25" value="<? echo $rabmst_idrabmst;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
