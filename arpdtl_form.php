  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data arpdtl"; 
	$status="Tambah"; 
	
   $arphdr_idarphdr =$_GET['arphdr'];
   $slshdrsektor_idslshdr= $_GET['idsls'];
	
   $sql = "SELECT IFNULL(max(idarpdtl),0)+1  FROM arpdtl";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idarpdtl = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from arpdtl where idarpdtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idarpdtl=$data['idarpdtl']; 
		$pvalue=$data['pvalue']; 
		$arphdr_idarphdr=$data['arphdr_idarphdr']; 
		$slshdrsektor_idslshdr=$data['slshdrsektor_idslshdr']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data arpdtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#arpdtl").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idarpdtl"){ 
      dataString = 'idarpdtl='+ cari;  
   } 
   else if (combo == "pvalue"){ 
      dataString = 'pvalue='+ cari; 
    } 
   else if (combo == "arphdr_idarphdr"){ 
      dataString = 'arphdr_idarphdr='+ cari; 
    } 
   else if (combo == "slshdrsektor_idslshdr"){ 
      dataString = 'slshdrsektor_idslshdr='+ cari; 
    } 
 
    $.ajax({ 
      url: "arpdtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#arpdtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data arpdtl ini?")){ 
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
        	url: "arpdtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("arpdtl_form.php");   
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
<form method="post" name="arpdtl_form" action="" id="arpdtl_form">  
<table> 
<tr><th colspan="5"><b><?php echo $judul; ?></b></th></tr> 
<tr><td>No. Penjualan</td><td>Tanggal</td><td>Jatuh Tempo</td><td>Total</td><td>Aksi</td></tr> 
<tr> 
<td><input type="text" id="slshdrsektor_idslshdr" name="slshdrsektor_idslshdr" size="5" maxlength="25" value="<? echo $slshdrsektor_idslshdr;?>" /></td> 
<td><input type="text" id="sls_date" name="sls_date" size="10" maxlength="25" value="<? echo $sls_date;?>" /></td> 
<td><input type="text" id="due_date" name="due_date" size="10" maxlength="25" value="<? echo $due_date;?>" /></td> 
<td><input type="text" id="pvalue" name="pvalue" size="10" maxlength="25" value="<? echo $pvalue;?>" /></td> 
<td colspan="5"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 

<input type="hidden" id="idarpdtl" name="idarpdtl" size="10" value="<? echo $idarpdtl;?>" />
<input type="hidden" id="arphdr_idarphdr" name="arphdr_idarphdr" size="30" maxlength="25" value="<? echo $arphdr_idarphdr;?>" />

</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
