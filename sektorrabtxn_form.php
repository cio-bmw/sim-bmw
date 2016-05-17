  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data sektorrabtxn"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idtxn),0)+1  FROM sektorrabtxn";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idtxn = $data[0];	 
   $txndate = date('d-m-Y');
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from sektorrabtxn where idtxn = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idtxn=$data['idtxn']; 
		$txndate=gettanggal($data['txndate']); 
		$txnvalue=$data['txnvalue']; 
		$txndesc=$data['txndesc']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$rabmst_idrabmst=$data['rabmst_idrabmst']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data sektorrabtxn"; 
	} 
	$sektor = sektorinfo($sektor_idsektor);
	$sektorname= $sektor ['sektorname'];
	$rabmst = rabmstinfo($rabmst_idrabmst);
   $rabdesc = $rabmst['rabdesc'];  

	
	
	
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#sektorrabtxn").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idtxn"){ 
      dataString = 'idtxn='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txnvalue"){ 
      dataString = 'txnvalue='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
   else if (combo == "rabmst_idrabmst"){ 
      dataString = 'rabmst_idrabmst='+ cari; 
    } 
 
    $.ajax({ 
      url: "sektorrabtxn_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#sektorrabtxn_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data sektorrabtxn ini?")){ 
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
        	url: "sektorrabtxn_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("sektorrabtxn_form.php");   
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
		page="sektor_lov.php"; 
		$("#divLOV").load(page); 
		$("#divLOV").show(); 
	
		return false; 
	});    
	
	$("#btnlovrab").click(function(){ 
		page="rabmst_lov.php"; 
		$("#divLOV").load(page); 
		$("#divLOV").show(); 
	
		return false; 
	});    
 }); 
 </script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=txndate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
 
 	})	
 	</script>	
 
<form method="post" name="sektorrabtxn_form" action="" id="sektorrabtxn_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Dok</td><td><input type="text" id="idtxn" name="idtxn" size="10" <? echo $readonly;?> value="<? echo $idtxn;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">No Dok</td><td><input type="text" id="idtxn" name="idtxn" size="10" value="<? echo $idtxn;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Sektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="25" value="<? echo $sektor_idsektor;?>" />
<input class="button" type="button" id="btnlovsektor" value="..."/>
<input type="text" id="sektorname" name="sektorname" size="30" maxlength="35" value="<? echo $sektorname;?>" />

</td> 
</tr> 
<tr> 
<td class="right">RAB</td> 
<td>
<input type="text" id="rabmst_idrabmst" name="rabmst_idrabmst" size="5" maxlength="25" value="<? echo $rabmst_idrabmst;?>" />
<input class="button" type="button" id="btnlovrab" value="..."/>
<input type="text" id="rabdesc" name="rabdesc" size="30" maxlength="35" value="<? echo $rabdesc;?>" />

</td> 
</tr>

<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="txndate" name="txndate" size="10" maxlength="25" value="<? echo $txndate;?>" /></td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="txndesc" name="txndesc" size="50" maxlength="100" value="<? echo $txndesc;?>" /></td> 
</tr> 


<tr> 
<td class="right">Jumlah (Rp)</td> 
<td><input class="right" type="text" id="txnvalue" name="txnvalue" size="10" maxlength="25" value="<? echo $txnvalue;?>" /></td> 
</tr> 
 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
