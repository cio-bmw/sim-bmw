  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Form Penerimaan Kayu"; 
	$status="Tambah"; 
	
	$sql0 = "SELECT IFNULL(max(idreceivehdr),0)+1  FROM receivehdrkayu";
   $result0 = mysql_query($sql0);
   $data  = mysql_fetch_array($result0);
   $idreceivehdr = $data[0];	

  $rcv_date=nowdatetime(); 
    $icdx_idicdx='-';	
	
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from receivehdrkayu where idreceivehdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreceivehdr=$data['idreceivehdr']; 
		$supplier_idsupp=$data['supplier_idsupp']; 
		$rcv_date=gettanggaljam($data['rcv_date']); 
		$rcv_bon=$data['rcv_bon']; 
		$rcv_titip=$data['rcv_titip']; 
		$rcv_desc=$data['rcv_desc']; 
		$due_date=gettanggaljam($data['due_date']); 
		$paid_date=$data['paid_date']; 
		$faktur=$data['faktur']; 
		$rcv_bayar=$data['rcv_bayar']; 
		$rcv_status=$data['rcv_status']; 
		$rcv_diskon=$data['rcv_diskon']; 
		$rcv_totprice=$data['rcv_totprice']; 
		$rcv_totdiskon=$data['rcv_totdiskon']; 
		$rcv_totppn=$data['rcv_totppn']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data receivehdr"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#receivehdr").focus();  
  
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
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
    $.ajax({ 
      url: "receivehdrkayu_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#receivehdrkayu_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data receivehdr ini?")){ 
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
        	url: "receivehdrkayu_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
  
          	  window.location='receivedtlkayu.php?id='+$("input#idreceivehdr").val();
              loadData(); //reload list data 
          	//	$("#divFormContent").load("receivehdr_form.php");   
            //  $("#divFormContent").hide(); 
            //  $("#btnhide").hide(); 
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

 </script> 
<form method="post" name="receivehdrkayu_form" action="" id="receivehdrkayu_form">  
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
<input type="text" id="supplier_idsupp" name="supplier_idsupp" size="2" maxlength="25" value="<? echo $supplier_idsupp;?>" />
<input type="button" class="button" id="btnlovsupp" value="...">
<input type="text" id="suppname" name="suppname" size="15" maxlength="15" value="<? echo $suppname;?>" readonly/>
</td> 
</tr> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="rcv_date" name="rcv_date" size="30" maxlength="25" value="<? echo $rcv_date;?>" /></td> 
</tr> 

<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="rcv_desc" name="rcv_desc" size="30" maxlength="25" value="<? echo $rcv_desc;?>" /></td> 
</tr> 
<tr> 
<td class="right">Jatuh Tempo</td> 
<td><input type="text" id="due_date" name="due_date" size="30" maxlength="25" value="<? echo $due_date;?>" /></td> 
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
