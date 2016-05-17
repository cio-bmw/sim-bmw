  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data custpayhdr"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idcustpayhdr),0)+1  FROM custpayhdr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idcustpayhdr = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from custpayhdr where idcustpayhdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcustpayhdr=$data['idcustpayhdr']; 
		$pay_date=$data['pay_date']; 
		$unit_idunit=$data['unit_idunit']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data custpayhdr"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#custpayhdr").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idcustpayhdr"){ 
      dataString = 'idcustpayhdr='+ cari;  
   } 
   else if (combo == "pay_date"){ 
      dataString = 'pay_date='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
    $.ajax({ 
      url: "custpayhdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#custpayhdr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data custpayhdr ini?")){ 
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
        	url: "custpayhdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("custpayhdr_form.php");   
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
<form method="post" name="custpayhdr_form" action="" id="custpayhdr_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idcustpayhdr</td><td><input type="text" id="idcustpayhdr" name="idcustpayhdr" size="10" <? echo $readonly;?> value="<? echo $idcustpayhdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idcustpayhdr</td><td><input type="text" id="idcustpayhdr" name="idcustpayhdr" size="10" value="<? echo $idcustpayhdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">pay_date</td> 
<td><input type="text" id="pay_date" name="pay_date" size="30" maxlength="25" value="<? echo $pay_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td><input type="text" id="unit_idunit" name="unit_idunit" size="30" maxlength="25" value="<? echo $unit_idunit;?>" /></td> 
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
