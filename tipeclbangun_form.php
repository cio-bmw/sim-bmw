  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data tipeclbangun"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idtipeclbangun),0)+1  FROM tipeclbangun";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idtipeclbangun = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from tipeclbangun where idtipeclbangun = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtipeclbangun=$data['idtipeclbangun']; 
		$bobotpct=$data['bobotpct']; 
		$tipe_idtipe=$data['tipe_idtipe']; 
		$clbangun_idclbangun=$data['clbangun_idclbangun']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data tipeclbangun"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#tipeclbangun").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idtipeclbangun"){ 
      dataString = 'idtipeclbangun='+ cari;  
   } 
   else if (combo == "bobotpct"){ 
      dataString = 'bobotpct='+ cari; 
    } 
   else if (combo == "tipe_idtipe"){ 
      dataString = 'tipe_idtipe='+ cari; 
    } 
   else if (combo == "clbangun_idclbangun"){ 
      dataString = 'clbangun_idclbangun='+ cari; 
    } 
 
    $.ajax({ 
      url: "tipeclbangun_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#tipeclbangun_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data tipeclbangun ini?")){ 
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
        	url: "tipeclbangun_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("tipeclbangun_form.php");   
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
<form method="post" name="tipeclbangun_form" action="" id="tipeclbangun_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idtipeclbangun" name="idtipeclbangun" size="10" value="<? echo $idtipeclbangun;?>" /></td> 
<tr> 
<td>
<input type="text" id="clbangun_idclbangun" name="clbangun_idclbangun" size="5" maxlength="25" value="<? echo $clbangun_idclbangun;?>" />
<input type="text" id="clbangundesc" name="clbangundesc" size="5" maxlength="25" value="<? echo $clbangundesc;?>" />

</td> 


<td class="right">bobotpct</td> 
<td><input type="text" id="bobotpct" name="bobotpct" size="30" maxlength="25" value="<? echo $bobotpct;?>" /></td> 
</tr> 
<tr> 
<td class="right">tipe_idtipe</td> 
<td><input type="text" id="tipe_idtipe" name="tipe_idtipe" size="30" maxlength="25" value="<? echo $tipe_idtipe;?>" /></td> 
</tr> 
<tr> 
<td class="right">clbangun_idclbangun</td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
