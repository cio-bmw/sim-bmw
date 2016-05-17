  <?  
  include_once("config.php"); 
   $cashouthdr_idcashouthdr = $_GET['id'];
	$action="add"; 
	$judul="Penambahan Data cashoutdtl"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idcashoutdtl),0)+1  FROM cashoutdtl";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idcashoutdtl = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from cashoutdtl where idcashoutdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcashoutdtl=$data['idcashoutdtl']; 
		$dtldesc=$data['dtldesc']; 
		$txnvalue=$data['txnvalue']; 
		$cashouthdr_idcashouthdr=$data['cashouthdr_idcashouthdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data cashoutdtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#cashoutdtl").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var vid = $("input#idcashouthdr").val(); 
	
      dataString = 'id='+ vid; 

    $.ajax({ 
      url: "cashoutdtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#cashoutdtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data cashoutdtl ini?")){ 
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
        	url: "cashoutdtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
          	  document.cashoutdtl_form.dtldesc.val='';
          	  document.cashoutdtl_form.txnvalue.val='';
          	  
          	  
          	  
              loadData(); //reload list data 
       //   		$("#divFormContent").load("cashoutdtl_form.php");   
        //      $("#divFormContent").hide(); 
         //     $("#btnhide").hide(); 
         
         page="cashoutdtl_form.php?id="+$("input#idcashouthdr").val(); 
	  	$("#divlov").load(page); 
		$("#divlov").show();
		 
		return false; 
         
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
<form method="post" name="cashoutdtl_form" action="" id="cashoutdtl_form">  
<table width="480px"> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idcashoutdtl</td><td><input type="text" id="idcashoutdtl" name="idcashoutdtl" size="10" <? echo $readonly;?> value="<? echo $idcashoutdtl;?>" /></td> 
</tr> 
<?php } else {?> 
<input type="hidden" id="idcashoutdtl" name="idcashoutdtl" size="10" value="<? echo $idcashoutdtl;?>" />
<?php }?> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="dtldesc" name="dtldesc" size="45" maxlength="45" value="<? echo $dtldesc;?>" /></td> 
</tr> 
<tr> 
<td class="right">Jumlah</td> 
<td><input class="right" type="text" id="txnvalue" name="txnvalue" size="10" maxlength="25" value="<? echo $txnvalue;?>" /></td> 
</tr> 

<input type="hidden" id="cashouthdr_idcashouthdr" name="cashouthdr_idcashouthdr" size="30" maxlength="25" value="<? echo $cashouthdr_idcashouthdr;?>" />
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
