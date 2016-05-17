  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data receivehdrsektor"; 
	$status="Tambah"; 
	
   $sql = "SELECT IFNULL(max(idreceivehdr),0)+1  FROM receivehdrsektor";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idreceivehdr= $data[0];	
   
    
   $rcv_date=date('d-m-Y'); 
	
   $supplier_idsupp=$_GET['supp'];
   $sektor_idsektor=$_GET['sektor']; 	
	
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from receivehdrsektor where idreceivehdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreceivehdr=$data['idreceivehdr']; 
		$supplier_idsupp=$data['supplier_idsupp']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$rcv_date=$data['rcv_date']; 
		$rcv_bon=$data['rcv_bon']; 
		$rcv_titip=$data['rcv_titip']; 
		$rcv_desc=$data['rcv_desc']; 
		$due_date=$data['due_date']; 
		$paid_date=$data['paid_date']; 
		$faktur=$data['faktur']; 
		$rcv_bayar=$data['rcv_bayar']; 
		$rcv_status=$data['rcv_status']; 
		$rcv_diskon=$data['rcv_diskon']; 
		$rcv_totprice=$data['rcv_totprice']; 
		$rcv_totdiskon=$data['rcv_totdiskon']; 
		$rcv_totppn=$data['rcv_totppn']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data receivehdrsektor"; 
	} 
	
    	
	
	$supplier = supplierinfo($supplier_idsupp);
	$suppname = $supplier['suppname'];
   $sektor = sektorinfo($sektor_idsektor);
   $sektorname= $sektor['sektorname'];	
	
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#receivehdrsektor").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idreceivehdr"){ 
      dataString = 'idreceivehdr='+ cari;  
   } 
   else if (combo == "supplier_idsupp"){ 
      dataString = 'supplier_idsupp='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
   else if (combo == "rcv_date"){ 
      dataString = 'rcv_date='+ cari; 
    } 
   else if (combo == "rcv_bon"){ 
      dataString = 'rcv_bon='+ cari; 
    } 
   else if (combo == "rcv_titip"){ 
      dataString = 'rcv_titip='+ cari; 
    } 
   else if (combo == "rcv_desc"){ 
      dataString = 'rcv_desc='+ cari; 
    } 
   else if (combo == "due_date"){ 
      dataString = 'due_date='+ cari; 
    } 
   else if (combo == "paid_date"){ 
      dataString = 'paid_date='+ cari; 
    } 
   else if (combo == "faktur"){ 
      dataString = 'faktur='+ cari; 
    } 
   else if (combo == "rcv_bayar"){ 
      dataString = 'rcv_bayar='+ cari; 
    } 
   else if (combo == "rcv_status"){ 
      dataString = 'rcv_status='+ cari; 
    } 
   else if (combo == "rcv_diskon"){ 
      dataString = 'rcv_diskon='+ cari; 
    } 
   else if (combo == "rcv_totprice"){ 
      dataString = 'rcv_totprice='+ cari; 
    } 
   else if (combo == "rcv_totdiskon"){ 
      dataString = 'rcv_totdiskon='+ cari; 
    } 
   else if (combo == "rcv_totppn"){ 
      dataString = 'rcv_totppn='+ cari; 
    } 
 
    $.ajax({ 
      url: "receivehdrsektor_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#receivehdrsektor_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data receivehdrsektor ini?")){ 
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
        	url: "receivehdrsektor_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("receivehdrsektor_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
           //   loadData(); //reload list data 
            window.location="receivedtlsektor.php?id="+$("input#idreceivehdr").val(); 
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
 
 $("#btnlovsupp").click(function(){ 
		pagelov="supplier_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 
	
$("#btnlovsektor").click(function(){ 
		pagelov="sektor_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 	
	
 </script> 
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=rcv_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				jQuery('input[name=due_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
				})			
</script>		
 
 
 <p class="judul">Form Entry/Edit Penerimaan Barang Di Sektor</p>
<form method="post" name="receivehdrsektor_form" action="" id="receivehdrsektor_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Dok</td><td><input type="text" id="idreceivehdr" name="idreceivehdr" size="10" <? echo $readonly;?> value="<? echo $idreceivehdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">No Dok</td><td><input type="text" id="idreceivehdr" name="idreceivehdr" size="10" value="<? echo $idreceivehdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Supplier</td> 
<td>
<input type="text" id="supplier_idsupp" name="supplier_idsupp" size="5" maxlength="25" value="<? echo $supplier_idsupp;?>" />
<input type="button" class="button" id="btnlovsupp" value="...">
<input type="text" id="suppname" name="suppname" size="25" maxlength="25" value="<? echo $suppname;?>" />

</td> 
</tr> 
<tr> 
<td class="right">Sektor</td> 
<td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="25" value="<? echo $sektor_idsektor;?>" />
<input type="button" class="button" id="btnlovsektor" value="...">
<input type="text" id="sektorname" name="sektorname" size="25" maxlength="25" value="<? echo $sektorname;?>" />

</td> 
</tr> 
<tr> 
<td class="right">Tgl Terima</td> 
<td><input type="text" id="rcv_date" name="rcv_date" size="10" maxlength="25" value="<? echo $rcv_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">Jatuh Tempo</td> 
<td><input type="text" id="due_date" name="due_date" size="10" maxlength="25" value="<? echo $due_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="rcv_desc" name="rcv_desc" size="30" maxlength="25" value="<? echo $rcv_desc;?>" /></td> 
</tr> 


<tr> 
<td class="right">Faktur</td> 
<td><input type="text" id="faktur" name="faktur" size="30" maxlength="25" value="<? echo $faktur;?>" /></td> 
</tr> 

<tr> 
<td class="right">Status</td> 
<td><input type="text" id="rcv_status" name="rcv_status" size="30" maxlength="25" value="<? echo $rcv_status;?>" /></td> 
</tr> 

<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
