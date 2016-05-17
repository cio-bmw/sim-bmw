  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data tipe"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(CAST(idtipe AS UNSIGNED)),0)+1 id  FROM tipe";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idtipe = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from tipe where idtipe = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtipe=$data['idtipe']; 
		$tipename=$data['tipename']; 
		$ukuran=$data['ukuran']; 
		$lb=$data['lb']; 
		$lt=$data['lt']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data tipe"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#tipe").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idtipe"){ 
      dataString = 'idtipe='+ cari;  
   } 
   else if (combo == "tipename"){ 
      dataString = 'tipename='+ cari; 
    } 
   else if (combo == "ukuran"){ 
      dataString = 'ukuran='+ cari; 
    } 
   else if (combo == "lb"){ 
      dataString = 'lb='+ cari; 
    } 
   else if (combo == "lt"){ 
      dataString = 'lt='+ cari; 
    } 
 
    $.ajax({ 
      url: "tipe_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#tipe_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data tipe ini?")){ 
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
        	url: "tipe_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("tipe_form.php");   
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
<form method="post" name="tipe_form" action="" id="tipe_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Kode</td><td><input type="text" id="idtipe" name="idtipe" size="10" <? echo $readonly;?> value="<? echo $idtipe;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">Kode</td><td><input type="text" id="idtipe" name="idtipe" size="10" value="<? echo $idtipe;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Nama Tipe</td> 
<td><input type="text" id="tipename" name="tipename" size="30" maxlength="25" value="<? echo $tipename;?>" /></td> 
</tr> 
<tr> 
<td class="right">ukuran</td> 
<td><input type="text" id="ukuran" name="ukuran" size="30" maxlength="25" value="<? echo $ukuran;?>" /></td> 
</tr> 
<tr> 
<td class="right">lb</td> 
<td><input type="text" id="lb" name="lb" size="30" maxlength="25" value="<? echo $lb;?>" /></td> 
</tr> 
<tr> 
<td class="right">lt</td> 
<td><input type="text" id="lt" name="lt" size="30" maxlength="25" value="<? echo $lt;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
