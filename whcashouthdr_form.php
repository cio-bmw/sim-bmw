  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Entry Pengeluaran Kas Gudang"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idcashouthdr),0)+1  FROM whcashouthdr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idcashouthdr = $data[0];	 
   $txndate = date('d-m-Y');
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * FROM whcashouthdr where idcashouthdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idcashouthdr=$data['idcashouthdr']; 
		$txndate=$data['txndate']; 
		$txndesc=$data['txndesc']; 
			$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data cashouthdr"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#cashouthdr").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idcashouthdr"){ 
      dataString = 'idcashouthdr='+ cari;  
   } 
   else if (combo == "txndate"){ 
      dataString = 'txndate='+ cari; 
    } 
   else if (combo == "txndesc"){ 
      dataString = 'txndesc='+ cari; 
    } 
   else if (combo == "costcenter_idcostcenter"){ 
      dataString = 'costcenter_idcostcenter='+ cari; 
    } 
 
    $.ajax({ 
      url: "whcashouthdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#cashouthdr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data cashouthdr ini?")){ 
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
        	url: "whcashouthdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
          	  
              window.location ='whcashouthdr_detail.php?id='+$("input#idcashouthdr").val();        	  
//              loadData(); //reload list data 
//          		$("#divFormContent").load("cashouthdr_form.php");   
//              $("#divFormContent").hide(); 
//              $("#divLOV").hide(); 
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
   
   $("#btnlovcc").click(function(){ 
		pagelov="costcenter_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 
   
   
 }); 
</script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<script type="text/javascript" src="js/jquery-ui.js"></script>

<form method="post" name="cashouthdr_form" action="" id="cashouthdr_form">  
<table > 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">No Dok</td><td><input type="text" id="idcashouthdr" name="idcashouthdr" size="10" <? echo $readonly;?> value="<? echo $idcashouthdr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">No Dok</td><td><input type="text" id="idcashouthdr" name="idcashouthdr" size="10" value="<? echo $idcashouthdr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="txndate" name="txndate" size="10" maxlength="25" value="<? echo $txndate;?>" /></td> 
</tr> 
<tr> 
<td class="right">Keterangan</td> 
<td><input type="text" id="txndesc" name="txndesc" size="50" maxlength="100" value="<? echo $txndesc;?>" /></td> 
</tr> 

<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 

