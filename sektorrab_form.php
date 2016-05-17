  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data sektorrab"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idsektorrab),0)+1  FROM sektorrab";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idsektorrab = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['ids'])) 
	{ 
		$str="select * from sektorrab where idsektorrab = '$_GET[ids]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idsektorrab=$data['idsektorrab']; 
		$volume=$data['volume']; 
		$hargasat=$data['hargasat']; 
		$txntotal=$data['txntotal']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$rabmst_idrabmst=$data['rabmst_idrabmst']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data sektorrab"; 
	} 
	$rabmst=rabmstinfo($rabmst_idrabmst);
	$rabdesc = $rabmst['rabdesc'];
	$sektor = sektorinfo($sektor_idsektor);
	$sektorname = $sektor['sektorname'];
	 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#sektorrab").focus();  
  
  function loadData(){ 
	  var dataString; 
	   var vcari = $("select#carisektor").val(); 
  
      dataString = 'id='+ vcari; 
	
    $.ajax({ 
      url: "sektorrab_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#sektorrab_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data sektorrab ini?")){ 
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
        	url: "sektorrab_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
          
             loadData(); //reload list data 
      //    		$("#divFormContent").load("sektorrab_form.php");   
      //        $("#divFormContent").hide(); 
      //       $("#btnhide").hide(); 
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
   
 $("#btnlovsektor").click(function(){ 
		pagelov="sektor_lovpage.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	});   
	
	 $("#btnlovrab").click(function(){ 
		pagelov="rabmst_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	});   
   
 }); 
 </script> 
<form method="post" name="sektorrab_form" action="" id="sektorrab_form">  
<table width="510px" >
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Doc</td><td><input type="text" id="idsektorrab" name="idsektorrab" size="10" <? echo $readonly;?> value="<? echo $idsektorrab;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">No Doc</td><td><input type="text" id="idsektorrab" name="idsektorrab" size="10" value="<? echo $idsektorrab;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Sektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="25" value="<? echo $sektor_idsektor;?>" />
<input type="button" id="btnlovsektor" value="..." >
<input type="text" id="sektorname" name="sektorname" size="25" maxlength="25" value="<? echo $sektorname;?>" />
</td> 
</tr> 
<tr> 
<td class="right">rabmst_idrabmst</td> 
<td>
<input type="text" id="rabmst_idrabmst" name="rabmst_idrabmst" size="5" maxlength="25" value="<? echo $rabmst_idrabmst;?>" />
<input type="button" id="btnlovrab" value="..." >
<input type="text" id="rabdesc" name="rabdesc" size="25" maxlength="25" value="<? echo $rabdesc;?>" />

</td> 
</tr> 
<tr> 
<td class="right">volume</td> 
<td><input class="right" type="text" id="volume" name="volume" size="10" maxlength="25" value="<? echo $volume;?>" /></td> 
</tr> 
<tr> 
<td class="right">hargasat</td> 
<td><input class="right" type="text" id="hargasat" name="hargasat" size="10" maxlength="25" value="<? echo $hargasat;?>" /></td> 
</tr> 
<?php if ($_GET['action'] == "updatex"){?>
<tr> 
<td class="right">txntotal</td> 
<td><input type="text" id="txntotal" name="txntotal" size="30" maxlength="25" value="<? echo $txntotal;?>" /></td> 
</tr> 
<?php }?> 

<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
