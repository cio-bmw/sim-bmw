  <?  
  include_once("config.php"); 
   $unit_idunit=$_GET['idunit'];
	$action="add"; 
	$judul="Penambahan Data unit_files"; 
	$status="Simpan Data"; 
   $sql = "SELECT IFNULL(max(idunit_files),0)+1  FROM unit_files";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idunit_files = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from unit_files where idunit_files = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunit_files=$data['idunit_files']; 
		$filename=$data['filename']; 
		$filedesc=$data['filedesc']; 
		$unit_idunit=$data['unit_idunit']; 
		$doccat_iddoccat=$data['doccat_iddoccat']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unit_files"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#unit_files").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idunit_files"){ 
      dataString = 'idunit_files='+ cari;  
   } 
   else if (combo == "filename"){ 
      dataString = 'filename='+ cari; 
    } 
   else if (combo == "filedesc"){ 
      dataString = 'filedesc='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "doccat_iddoccat"){ 
      dataString = 'doccat_iddoccat='+ cari; 
    } 
 
    $.ajax({ 
      url: "unit_files_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#unit_files_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data unit_files ini?")){ 
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
        	url: "unit_files_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
              
           page="unit_files_form.php?idunit="+$("input#idunit").val(); 
		$("#divPageEntry").load(page); 
		$("#divPageEntry").show(); 
		
		pagelov="doccat_lov.php?idunit="+$("input#idunit").val(); 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		
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
<form method="post" name="unit_files_form" action="" id="unit_files_form">  
<table width=98%> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idunit_files" name="idunit_files" size="10" value="<? echo $idunit_files;?>" />
<tr> 
<td class="right">Kategori</td> 
<td>
<input type="text" id="doccat_iddoccat" name="doccat_iddoccat" size="5" maxlength="25" value="<? echo $doccat_iddoccat;?>" />
<input type="button" id="btnlovdoc" value="..." />
<input type="text" id="doccatname" name="doccatname" size="37" maxlength="45" value="<? echo $doccatname;?>" />

</td> 
</tr> 

<tr> 
<td class="right">Filename</td> 
<td><input type="file" id="filename" name="filename" size="40" maxlength="25" value="<? echo $filename;?>" /></td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="filedesc" name="filedesc" size="51" maxlength="75" value="<? echo $filedesc;?>" /></td> 
</tr> 
<tr> 
<input type="hidden" id="unit_idunit" name="unit_idunit" size="33" maxlength="45" value="<? echo $unit_idunit;?>" />

<tr> 
<td></td>
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
