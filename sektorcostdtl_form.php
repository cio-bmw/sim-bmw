  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data sektorcostdtl"; 
	$status="Simpan Data"; 
   $sql = "SELECT IFNULL(max(idsektorcostdtl),0)+1  FROM sektorcostdtl";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idsektorcostdtl = $data[0];	 
   
   $sektorcosthdr_idsektorcosthdr = $_GET['id'];
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from sektorcostdtl where idsektorcostdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idsektorcostdtl=$data['idsektorcostdtl']; 
		$costprice=$data['costprice']; 
		$rabmst_idrabmst=$data['rabmst_idrabmst']; 
		$txndtldesc=$data['txndtldesc']; 
		$sektorcosthdr_idsektorcosthdr=$data['sektorcosthdr_idsektorcosthdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data sektorcostdtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#sektorcostdtl").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#idsektorcosthdr").val(); 
	  
	   
	   dataString = 'id='+ cari;  
  
    $.ajax({ 
      url: "sektorcostdtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#sektorcostdtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data sektorcostdtl ini?")){ 
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
        	url: "sektorcostdtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
                 document.sektorcostdtl_form.rabmst_idrabmst.val='';
                 document.sektorcostdtl_form.rabdesc.val='';
                 document.sektorcostdtl_form.txndtldesc.val='';
                 document.sektorcostdtl_form.costprice.val='';
          	  
          	  
              loadData(); //reload list data 
     //     		$("#divFormEntry").load("sektorcostdtl_form.php");   
     //         $("#divFormContent").hide(); 
     //         $("#btnhide").hide(); 
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
<form method="post" name="sektorcostdtl_form" action="" id="sektorcostdtl_form">  
<table width="600"> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<input type="hidden" id="idsektorcostdtl" name="idsektorcostdtl" size="10" value="<? echo $idsektorcostdtl;?>" />
<input type="hidden" id="sektorcosthdr_idsektorcosthdr" name="sektorcosthdr_idsektorcosthdr" size="5" maxlength="25" value="<? echo $sektorcosthdr_idsektorcosthdr;?>" />
<tr> 
<td class="right">RAB</td> 
<td>
<input type="text" id="rabmst_idrabmst" name="rabmst_idrabmst" size="5" maxlength="25" value="<? echo $rabmst_idrabmst;?>" />
<input class="button" type="button" id="btnlovrab" value="..."/>
<input type="text" id="rabdesc" name="rabdesc" size="30" maxlength="35" value="<? echo $rabdesc;?>" />
</td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="txndtldesc" name="txndtldesc" size="40" maxlength="45" value="<? echo $txndtldesc;?>" /></td> 
</tr> 
<tr> 
<td class="right">Nilai (Rp)</td> 
<td><input class="right" type="text" id="costprice" name="costprice" size="10" maxlength="25" value="<? echo $costprice;?>" /> 
&nbsp;&nbsp;<input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
