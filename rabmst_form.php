  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data rabmst"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idrabmst),0)+1  FROM rabmst";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idrabmst = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from rabmst where idrabmst = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idrabmst=$data['idrabmst']; 
		$rabdesc=$data['rabdesc']; 
		$rabcat_idrabcat=$data['rabcat_idrabcat']; 
		$satuan=$data['satuan']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data rabmst"; 
	} 
	  $rabcat = rabcatinfo($rabcat_idrabcat);
     $rabcatname = $rabcat['rabcatname'];  		
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#rabmst").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idrabmst"){ 
      dataString = 'idrabmst='+ cari;  
   } 
   else if (combo == "rabdesc"){ 
      dataString = 'rabdesc='+ cari; 
    } 
   else if (combo == "rabcat_idrabcat"){ 
      dataString = 'rabcat_idrabcat='+ cari; 
    } 
   else if (combo == "satuan"){ 
      dataString = 'satuan='+ cari; 
    } 
 
    $.ajax({ 
      url: "rabmst_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#rabmst_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data rabmst ini?")){ 
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
        	url: "rabmst_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              document.rabmst_form.rabdesc.val='';
              document.rabmst_form.rabcat_idrabcat.val='';
              document.rabmst_form.rabcatname.val='';
              document.rabmst_form.satuan.val='';
              
              page1="rabmst_form.php"; 
		$("#divPageEntry").load(page1); 
		$("#divPageEntry").show();           	  
          	  
              loadData(); //reload list data 
          		$("#divFormContent").load("rabmst_form.php");   
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
   
  $("#btnlovrabcat").click(function(){ 
		pagelov="rabcat_lov.php"; 
		$("#divlov").load(pagelov); 
		$("#divlov").show(); 
		return false; 
	});  
   
 }); 
 </script> 
<form method="post" name="rabmst_form" action="" id="rabmst_form">  
<table width=600px> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Kode</td><td><input type="text" id="idrabmst" name="idrabmst" size="10" <? echo $readonly;?> value="<? echo $idrabmst;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">Kode</td><td><input type="text" id="idrabmst" name="idrabmst" size="10" value="<? echo $idrabmst;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="rabdesc" name="rabdesc" size="50" maxlength="100" value="<? echo $rabdesc;?>" /></td> 
</tr> 
<tr> 
<td class="right">Kategori</td> 
<td>
<input type="text" id="rabcat_idrabcat" name="rabcat_idrabcat" size="2" maxlength="25" value="<? echo $rabcat_idrabcat;?>" />
<input class="button" type="button" id="btnlovrabcat" value="..." />
<input type="text" id="rabcatname" name="rabcatname" size="20" maxlength="25" value="<? echo $rabcatname;?>" />

</td> 
</tr> 
<tr> 
<td class="right">Satuan</td> 
<td><input type="text" id="satuan" name="satuan" size="30" maxlength="25" value="<? echo $satuan;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
