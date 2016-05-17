  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data msgmaster"; 
	$status="Tambah"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from msgmaster where idmsgmaster = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpesan=$data['idpesan']; 
		$pesan=$data['pesan']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Data Pelanggan"; 
	} 
?> 

<script type="text/javascript"> 

 
$(function(){ 
  $("input#msgmaster").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idpesan"){ 
      dataString = 'idpesan='+ cari;  
   } 
   else if (combo == "pesan"){ 
      dataString = 'pesan='+ cari; 
    } 
 
    $.ajax({ 
      url: "msgmaster_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#msgmaster_form").submit(function(){ 
   // if (confirm("Apakah benar akan menyimpan data pelanggan ini?")){ 
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
        	url: "msgmaster_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  document.getElementById("pesan").value = '';
                $("input#pesan").focus();  
 
          	 // alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		//$("#divFormContent").load("msgmaster_form.php");   
              //$("#divFormContent").hide(); 
              //$("#btnhide").hide(); 
            } 
          	else 
          	{ 
          		alert("Data gagal di simpan!"); 
           	} 
        	} 
         }); 
     //		return false; 
     //	} 
     //} 
     
     
         $('#divPageData').animate({
             scrollTop: $('#divPageData')[0].scrollHeight}, 1000
        );
return false; 
   }); 
   
  	   
 }); 
 </script> 
 <script type="text/javascript" src="js/jscolor.js"></script>
<form method="post" name="msgmaster_form" action="" id="msgmaster_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td>ID Pelanggan</td><td><input type="text" id="idpelanggan" name="idpelanggan" size="10" <? echo $readonly;?> value="<? echo $idplgn;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td><input class="color" size="4" name="warna" value="66ff00"></td> 
<td><input type="text" id="pesan" name="pesan" size="30" maxlength="25" value="<? echo $pesan;?>" /></td> 
<td colspan="2"><input type="submit" class="button" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
