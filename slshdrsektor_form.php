  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Pengeluaran Barang ke Sektor"; 
	$status="Tambah"; 
   
   $sql0 = "SELECT IFNULL(max(idslshdr),0)+1  FROM slshdrsektor";
   $result0 = mysql_query($sql0);
   $data  = mysql_fetch_array($result0);
   $idslshdr = $data[0];	

    $sls_date=nowdatetime(); 	
	
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from slshdrsektor where idslshdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idslshdr=$data['idslshdr']; 
		$sls_date=gettanggal($data['sls_date']); 
		$sls_bon=$data['sls_bon']; 
		$sls_titip=$data['sls_titip']; 
		$due_date=gettanggal($data['due_date']); 
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
		$judul="Update data Pengeluaran Barang Ke Sektor"; 
	} 
	$sektor = sektorinfo($sektor_idsektor);
	$sektorname= $sektor ['sektorname'];
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
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("slshdrsektor_form.php");   
              $("#divFormContent").hide(); 
              $("#btnhide").hide(); 
            } 
          	else if(response.status == 1) {
              window.location="slsdtlsektor.php?id="+$("input#idslshdr").val(); 
          		
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
 
$("#btnlovsektor").click(function(){ 
		pagelov="sektor_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 

 </script> 
 <p class="judul"></p>
<form method="post" name="slshdrsektor_form" action="" id="slshdrsektor_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<tr> 
<td class="right">Sektor</td> <td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="5" value="<? echo $sektor_idsektor;?>" />
<input type="button" class="button" id="btnlovsektor" value="...">
<input type="text" id="sektorname" name="sektorname" size="25" maxlength="25" value="<? echo $sektorname;?>" readonly/>

<td>
</tr> 

<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Dok</td><td><input type="text" id="idslshdr" name="idslshdr" size="10" <? echo $readonly;?> value="<? echo $idslshdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">No Dok</td><td><input type="text" id="idslshdr" name="idslshdr" size="10" value="<? echo $idslshdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="sls_date" name="sls_date" size="30" maxlength="25" value="<? echo $sls_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">Jatuh Tempo</td> 
<td><input type="text" id="due_date" name="due_date" size="30" maxlength="25" value="<? echo $due_date;?>" /></td> 
</tr> 

<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="sls_desc" name="sls_desc" size="30" maxlength="25" value="<? echo $sls_desc;?>" /></td> 
</tr> 

<tr> 
<td class="right">Status</td> 
<td><select id="sls_status" name="sls_status">
<? createstatusdata($sls_status);?>" </select></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"></td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
