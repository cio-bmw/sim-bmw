  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data contractor"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idcontractor),0)+1  FROM contractor";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idcontractor = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from contractor where idcontractor = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcontractor=$data['idcontractor']; 
		$contractorname=$data['contractorname']; 
		$contactno=$data['contactno']; 
		$contactname=$data['contactname']; 
		$address=$data['address']; 
		$bankname=$data['bankname']; 
		$rekno=$data['rekno']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data contractor"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#contractor").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idcontractor"){ 
      dataString = 'idcontractor='+ cari;  
   } 
   else if (combo == "contractorname"){ 
      dataString = 'contractorname='+ cari; 
    } 
   else if (combo == "contactno"){ 
      dataString = 'contactno='+ cari; 
    } 
   else if (combo == "contactname"){ 
      dataString = 'contactname='+ cari; 
    } 
   else if (combo == "address"){ 
      dataString = 'address='+ cari; 
    } 
   else if (combo == "bankname"){ 
      dataString = 'bankname='+ cari; 
    } 
   else if (combo == "rekno"){ 
      dataString = 'rekno='+ cari; 
    } 
 
    $.ajax({ 
      url: "contractor_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#contractor_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data contractor ini?")){ 
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
        	url: "contractor_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("contractor_form.php");   
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
<form method="post" name="contractor_form" action="" id="contractor_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idcontractor</td><td><input type="text" id="idcontractor" name="idcontractor" size="10" <? echo $readonly;?> value="<? echo $idcontractor;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idcontractor</td><td><input type="text" id="idcontractor" name="idcontractor" size="10" value="<? echo $idcontractor;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">contractorname</td> 
<td><input type="text" id="contractorname" name="contractorname" size="30" maxlength="25" value="<? echo $contractorname;?>" /></td> 
</tr> 
<tr> 
<td class="right">contactno</td> 
<td><input type="text" id="contactno" name="contactno" size="30" maxlength="25" value="<? echo $contactno;?>" /></td> 
</tr> 
<tr> 
<td class="right">contactname</td> 
<td><input type="text" id="contactname" name="contactname" size="30" maxlength="25" value="<? echo $contactname;?>" /></td> 
</tr> 
<tr> 
<td class="right">address</td> 
<td><input type="text" id="address" name="address" size="30" maxlength="25" value="<? echo $address;?>" /></td> 
</tr> 
<tr> 
<td class="right">bankname</td> 
<td><input type="text" id="bankname" name="bankname" size="30" maxlength="25" value="<? echo $bankname;?>" /></td> 
</tr> 
<tr> 
<td class="right">rekno</td> 
<td><input type="text" id="rekno" name="rekno" size="30" maxlength="25" value="<? echo $rekno;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
