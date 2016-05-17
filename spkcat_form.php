  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data spkcat"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idspkcat),0)+1  FROM spkcat";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idspkcat = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from spkcat where idspkcat = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idspkcat=$data['idspkcat']; 
		$category=$data['category']; 
		$spkdesc1=$data['spkdesc1']; 
		$spkdesc2=$data['spkdesc2']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data spkcat"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#spkcat").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idspkcat"){ 
      dataString = 'idspkcat='+ cari;  
   } 
   else if (combo == "category"){ 
      dataString = 'category='+ cari; 
    } 
   else if (combo == "spkdesc1"){ 
      dataString = 'spkdesc1='+ cari; 
    } 
   else if (combo == "spkdesc2"){ 
      dataString = 'spkdesc2='+ cari; 
    } 
 
    $.ajax({ 
      url: "spkcat_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#spkcat_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data spkcat ini?")){ 
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
        	url: "spkcat_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("spkcat_form.php");   
              $("#divPageEntry").hide(); 
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
<form method="post" name="spkcat_form" action="" id="spkcat_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idspkcat</td><td><input type="text" id="idspkcat" name="idspkcat" size="10" <? echo $readonly;?> value="<? echo $idspkcat;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idspkcat</td><td><input type="text" id="idspkcat" name="idspkcat" size="10" value="<? echo $idspkcat;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">category</td> 
<td><input type="text" id="category" name="category" size="30" maxlength="25" value="<? echo $category;?>" /></td> 
</tr> 
<tr> 
<td class="right">spkdesc1</td> 
<td><input type="text" id="spkdesc1" name="spkdesc1" size="30" maxlength="25" value="<? echo $spkdesc1;?>" /></td> 
</tr> 
<tr> 
<td class="right">spkdesc2</td> 
<td><input type="text" id="spkdesc2" name="spkdesc2" size="30" maxlength="25" value="<? echo $spkdesc2;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
