  <?  
session_start();
$emp_idemp = $_SESSION['cookie_name'];  
  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data bukutamu"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idbukutamu),0)+1  FROM bukutamu";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idbukutamu = $data[0];	 
   $tanggal=date('d-m-Y'); 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from bukutamu where idbukutamu = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idbukutamu=$data['idbukutamu']; 
		$nama=$data['nama']; 
		$alamat=$data['alamat']; 
		$notlp=$data['notlp']; 
		$tanggal=$data['tanggal']; 
		$catatan=$data['catatan']; 
		$diterima=$data['diterima']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data bukutamu"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#bukutamu").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idbukutamu"){ 
      dataString = 'idbukutamu='+ cari;  
   } 
   else if (combo == "nama"){ 
      dataString = 'nama='+ cari; 
    } 
   else if (combo == "alamat"){ 
      dataString = 'alamat='+ cari; 
    } 
   else if (combo == "notlp"){ 
      dataString = 'notlp='+ cari; 
    } 
   else if (combo == "tanggal"){ 
      dataString = 'tanggal='+ cari; 
    } 
   else if (combo == "catatan"){ 
      dataString = 'catatan='+ cari; 
    } 
   else if (combo == "diterima"){ 
      dataString = 'diterima='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
    $.ajax({ 
      url: "bukutamu_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#bukutamu_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data bukutamu ini?")){ 
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
        	url: "bukutamu_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("bukutamu_form.php");   
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
<form method="post" name="bukutamu_form" action="" id="bukutamu_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No</td><td><input type="text" id="idbukutamu" name="idbukutamu" size="10" <? echo $readonly;?> value="<? echo $idbukutamu;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">No</td><td><input type="text" id="idbukutamu" name="idbukutamu" size="10" value="<? echo $idbukutamu;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Nama</td> 
<td><input type="text" id="nama" name="nama" size="30" maxlength="25" value="<? echo $nama;?>" /></td> 
</tr> 
<tr> 
<td class="right">Alamat</td> 
<td><input type="text" id="alamat" name="alamat" size="30" maxlength="25" value="<? echo $alamat;?>" /></td> 
</tr> 
<tr> 
<td class="right">No Tlp</td> 
<td><input type="text" id="notlp" name="notlp" size="30" maxlength="25" value="<? echo $notlp;?>" /></td> 
</tr> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="tanggal" name="tanggal" size="30" maxlength="25" value="<? echo $tanggal;?>" /></td> 
</tr> 
<tr> 
<td class="right">Catatan</td> 
<td><input type="text" id="catatan" name="catatan" size="30" maxlength="25" value="<? echo $catatan;?>" /></td> 
</tr> 
<tr> 
<td class="right">Diterima</td> 
<td><input type="text" id="diterima" name="diterima" size="30" maxlength="25" value="<? echo $diterima;?>" /></td> 
</tr> 

<input type="hidden" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" /> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
