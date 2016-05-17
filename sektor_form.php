  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data sektor"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idsektor),0)+1  FROM sektor";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idsektor = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from sektor where idsektor = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idsektor=$data['idsektor']; 
		$sektorname=$data['sektorname']; 
		$address=$data['address']; 
		$emp_idempmkt=$data['emp_idempmkt']; 
		$emp_idempgdg=$data['emp_idempgdg']; 
		$front_img=$data['front_img']; 
		$map_img=$data['map_img']; 
		$siteplan_img=$data['siteplan_img']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data sektor"; 
	} 
?> 
<script type="text/javascript"> 
$(function(){ 
  $("input#sektor").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idsektor"){ 
      dataString = 'idsektor='+ cari;  
   } 
   else if (combo == "sektorname"){ 
      dataString = 'sektorname='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "emp_idempmkt"){ 
      dataString = 'emp_idempmkt='+ cari; 
    } 
   else if (combo == "emp_idempgdg"){ 
      dataString = 'emp_idempgdg='+ cari; 
    } 
   else if (combo == "front_img"){ 
      dataString = 'front_img='+ cari; 
    } 
   else if (combo == "map_img"){ 
      dataString = 'map_img='+ cari; 
    } 
   else if (combo == "siteplan_img"){ 
      dataString = 'siteplan_img='+ cari; 
    } 
 
    $.ajax({ 
      url: "sektor_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#sektor_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data sektor ini?")){ 
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
        	url: "sektor_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("sektor_form.php");   
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
<form method="post" name="sektor_form" action="" id="sektor_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Kode</td><td><input type="text" id="idsektor" name="idsektor" size="10" <? echo $readonly;?> value="<? echo $idsektor;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">Kode</td><td><input type="text" id="idsektor" name="idsektor" size="10" value="<? echo $idsektor;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Nama Sektor</td> 
<td><input type="text" id="sektorname" name="sektorname" size="30" maxlength="25" value="<? echo $sektorname;?>" /></td> 
</tr> 
<tr> 
<td class="right">Alamat</td> 
<td><input type="text" id="address" name="address" size="100" maxlength="125" value="<? echo $address;?>" /></td> 
</tr> 
<tr> 
<td class="right">PIC Marketing</td> 
<td><input type="text" id="emp_idempmkt" name="emp_idempmkt" size="30" maxlength="25" value="<? echo $emp_idempmkt;?>" /></td> 
</tr> 
<tr> 
<td class="right">PIC Gudang</td> 
<td><input type="text" id="emp_idempgdg" name="emp_idempgdg" size="30" maxlength="25" value="<? echo $emp_idempgdg;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
