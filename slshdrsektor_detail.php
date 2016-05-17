  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data slshdrsektor"; 
	$status="Tambah"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from slshdrsektor where idslshdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslshdr=$data['idslshdr']; 
		$sls_date=$data['sls_date']; 
		$sls_bon=$data['sls_bon']; 
		$sls_titip=$data['sls_titip']; 
		$due_date=$data['due_date']; 
		$sls_blj=$data['sls_blj']; 
		$sls_tambahan=$data['sls_tambahan']; 
		$sls_total=$data['sls_total']; 
		$sls_bayar=$data['sls_bayar']; 
		$sls_kembali=$data['sls_kembali']; 
		$sls_desc=$data['sls_desc']; 
		$payment_date=$data['payment_date']; 
		$sls_status=$data['sls_status']; 
		$sls_diskon=$data['sls_diskon']; 
		$emp_idemp=$data['emp_idemp']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data slshdrsektor"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#slshdrsektor").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idslshdr"){ 
      dataString = 'idslshdr='+ cari;  
   } 
   else if (combo == "sls_date"){ 
      dataString = 'sls_date='+ cari; 
    } 
   else if (combo == "sls_bon"){ 
      dataString = 'sls_bon='+ cari; 
    } 
   else if (combo == "sls_titip"){ 
      dataString = 'sls_titip='+ cari; 
    } 
   else if (combo == "due_date"){ 
      dataString = 'due_date='+ cari; 
    } 
   else if (combo == "sls_blj"){ 
      dataString = 'sls_blj='+ cari; 
    } 
   else if (combo == "sls_tambahan"){ 
      dataString = 'sls_tambahan='+ cari; 
    } 
   else if (combo == "sls_total"){ 
      dataString = 'sls_total='+ cari; 
    } 
   else if (combo == "sls_bayar"){ 
      dataString = 'sls_bayar='+ cari; 
    } 
   else if (combo == "sls_kembali"){ 
      dataString = 'sls_kembali='+ cari; 
    } 
   else if (combo == "sls_desc"){ 
      dataString = 'sls_desc='+ cari; 
    } 
   else if (combo == "payment_date"){ 
      dataString = 'payment_date='+ cari; 
    } 
   else if (combo == "sls_status"){ 
      dataString = 'sls_status='+ cari; 
    } 
   else if (combo == "sls_diskon"){ 
      dataString = 'sls_diskon='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
    $.ajax({ 
      url: "slshdrsektor_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#slshdrsektor_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data slshdrsektor ini?")){ 
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
        	url: "slshdrsektor_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("slshdrsektor_form.php");   
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
<form method="post" name="slshdrsektor_form" action="" id="slshdrsektor_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idslshdr</td><td><input type="text" id="idslshdr" name="idslshdr" size="10" <? echo $readonly;?> value="<? echo $idslshdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idslshdr</td><td><input type="text" id="idslshdr" name="idslshdr" size="10" value="<? echo $idslshdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">sls_date</td> 
<td><input type="text" id="sls_date" name="sls_date" size="30" maxlength="25" value="<? echo $sls_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">due_date</td> 
<td><input type="text" id="due_date" name="due_date" size="30" maxlength="25" value="<? echo $due_date;?>" /></td> 
</tr> 

<tr> 
<td class="right">sls_desc</td> 
<td><input type="text" id="sls_desc" name="sls_desc" size="30" maxlength="25" value="<? echo $sls_desc;?>" /></td> 
</tr> 
<tr>
<td class="right">emp_idemp</td> 
<td><input type="text" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" /></td> 
</tr> 
<tr> 
<td class="right">sektor_idsektor</td> 
<td><input type="text" id="sektor_idsektor" name="sektor_idsektor" size="30" maxlength="25" value="<? echo $sektor_idsektor;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
