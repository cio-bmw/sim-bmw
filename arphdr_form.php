  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penerimaan Pembayaran Piutang Sektor"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idarphdr),0)+1  FROM arphdr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idarphdr = $data[0];	 
   $arphdr_date=nowdatetime();
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from arphdr where idarphdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idarphdr=$data['idarphdr']; 
		$arphdr_date=gettanggal($data['arphdr_date']); 
		$arphdr_desc=$data['arphdr_desc']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update Penerimaan Pembayaran Piutang Sektor"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#arphdr").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idarphdr"){ 
      dataString = 'idarphdr='+ cari;  
   } 
   else if (combo == "arphdr_date"){ 
      dataString = 'arphdr_date='+ cari; 
    } 
   else if (combo == "arphdr_desc"){ 
      dataString = 'arphdr_desc='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
    $.ajax({ 
      url: "arphdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#arphdr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data arphdr ini?")){ 
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
        	url: "arphdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("arphdr_form.php");   
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
   
 $("#btnlovsektor").click(function(){ 
		//page="arphdr_form.php"; 
		//$("#divPageData").load(page); 
		//$("#divPageData").show(); 
		
		page1="sektor_list.php"; 
		$("#divPageLov").load(page1); 
		$("#divPageLov").show(); 
		

		return false; 
	});    
   
   
 }); 
 </script> 
<form method="post" name="arphdr_form" action="" id="arphdr_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">Dok No</td><td><input type="text" id="idarphdr" name="idarphdr" size="10" <? echo $readonly;?> value="<? echo $idarphdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">Dok No</td><td><input type="text" id="idarphdr" name="idarphdr" size="10" value="<? echo $idarphdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Tanggal Pembayaran</td> 
<td><input type="text" id="arphdr_date" name="arphdr_date" size="20" maxlength="25" value="<? echo $arphdr_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="arphdr_desc" name="arphdr_desc" size="40" maxlength="45" value="<? echo $arphdr_desc;?>" /></td> 
</tr> 
<tr> 
<td class="right">Sektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="25" value="<? echo $sektor_idsektor;?>" />
<input type="button" class="button" name="choice" id="btnlovsektor" value="...">
<input type="text" id="sektorname" name="sektorname" size="30" maxlength="25" value="<? echo $sektorname;?>" />
</td> 
</tr> 
<tr> 
<td colspan="3"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
