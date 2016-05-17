  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data returnhdr"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idreturnhdr),0)+1  FROM returnhdr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idreturnhdr = $data[0];	 
   $return_date=date('d-m-Y');
   	$return_status='open';
   
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from returnhdr where idreturnhdr = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idreturnhdr=$data['idreturnhdr']; 
		$return_date=$data['return_date']; 
		$return_status=$data['return_status']; 
		
		$catatan=$data['catatan']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data returnhdr"; 
	} 
	$sektor = sektorinfo($sektor_idsektor);
	$sektorname= $sektor ['sektorname'];
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#returnhdr").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idreturnhdr"){ 
      dataString = 'idreturnhdr='+ cari;  
   } 
   else if (combo == "return_date"){ 
      dataString = 'return_date='+ cari; 
    } 
   else if (combo == "catatan"){ 
      dataString = 'catatan='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
 
    $.ajax({ 
      url: "returnhdr_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#returnhdr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data returnhdr ini?")){ 
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
        	url: "returnhdr_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divFormContent").load("returnhdr_form.php");   
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
 $("#btnlovsektor").click(function(){ 
		pagelov="sektor_lov.php"; 
		$("#divLOV").load(pagelov); 
		$("#divLOV").show(); 
		return false; 
	}); 

 </script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
					jQuery('input[name=return_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
			
			})
</script>						
<form method="post" name="returnhdr_form" action="" id="returnhdr_form">  
<table width="500px"> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<tr><td class="right">No Dok</td><td><input type="text" id="idreturnhdr" name="idreturnhdr" size="10" value="<? echo $idreturnhdr;?>" /></td> 
</tr> 

<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="return_date" name="return_date" size="10" maxlength="25" value="<? echo $return_date;?>" /></td> 
</tr> 
<tr> 
<td class="right">Sektor</td> <td>
<input type="text" id="sektor_idsektor" name="sektor_idsektor" size="5" maxlength="5" value="<? echo $sektor_idsektor;?>" />
<input type="button" class="button" id="btnlovsektor" value="...">
<input type="text" id="sektorname" name="sektorname" size="25" maxlength="25" value="<? echo $sektorname;?>" readonly/>
<td>
</tr> 

<tr> 
<td class="right">catatan</td> 
<td><input type="text" id="catatan" name="catatan" size="40" maxlength="50" value="<? echo $catatan;?>" /></td> 
</tr> 
<tr> 
<td class="right">Status</td> 
<td><select id="return_status" name="return_status">
<? createstatusdata($return_status);?>" </select></td> 
</tr> 

<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
