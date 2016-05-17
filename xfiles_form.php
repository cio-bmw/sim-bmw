  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data xfiles"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idxfiles),0)+1  FROM xfiles";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idxfiles = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from xfiles where idxfiles = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idxfiles=$data['idxfiles']; 
		$xfilesname=$data['xfilesname']; 
		$xfilesdesc=$data['xfilesdesc']; 
		$xfilesdate=$data['xfilesdate']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data xfiles"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#xfiles").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idxfiles"){ 
      dataString = 'idxfiles='+ cari;  
   } 
   else if (combo == "xfilesname"){ 
      dataString = 'xfilesname='+ cari; 
    } 
   else if (combo == "xfilesdesc"){ 
      dataString = 'xfilesdesc='+ cari; 
    } 
   else if (combo == "xfilesdate"){ 
      dataString = 'xfilesdate='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
    $.ajax({ 
      url: "xfiles_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#xfiles_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data xfiles ini?")){ 
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
        	url: "xfiles_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("xfiles_form.php");   
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
<form method="post" name="xfiles_form" action="" id="xfiles_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idxfiles</td><td><input type="text" id="idxfiles" name="idxfiles" size="10" <? echo $readonly;?> value="<? echo $idxfiles;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idxfiles</td><td><input type="text" id="idxfiles" name="idxfiles" size="10" value="<? echo $idxfiles;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">xfilesname</td> 
<td><input type="text" id="xfilesname" name="xfilesname" size="30" maxlength="25" value="<? echo $xfilesname;?>" /></td> 
</tr> 
<tr> 
<td class="right">xfilesdesc</td> 
<td><input type="text" id="xfilesdesc" name="xfilesdesc" size="30" maxlength="25" value="<? echo $xfilesdesc;?>" /></td> 
</tr> 
<tr> 
<td class="right">xfilesdate</td> 
<td><input type="text" id="xfilesdate" name="xfilesdate" size="30" maxlength="25" value="<? echo $xfilesdate;?>" /></td> 
</tr> 
<tr> 
<td class="right">emp_idemp</td> 
<td><input type="text" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
