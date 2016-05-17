<?  
session_start();
$cookiename = $_SESSION['cookie_name'];
$cookieempname  =$_SESSION['cookie_empname'];
include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data publicchat"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idpublicchat),0)+1  FROM publicchat";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idpublicchat = $data[0];	 
$emp_idemp =    $cookiename;
$chatdate = nowdatetime();
   
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from publicchat where idpublicchat = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpublicchat=$data['idpublicchat']; 
		$chatdate=$data['chatdate']; 
		$chatmsg=$data['chatmsg']; 
		$chatimg=$data['chatimg']; 
		$emp_idemp=$data['emp_idemp']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data publicchat"; 
	} 
?> 
<script type="text/javascript" src="js/jscolor.js"></script>
<script type="text/javascript"> 
$(function(){ 
  $("input#publicchat").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idpublicchat"){ 
      dataString = 'idpublicchat='+ cari;  
   } 
   else if (combo == "chatdate"){ 
      dataString = 'chatdate='+ cari; 
    } 
   else if (combo == "chatmsg"){ 
      dataString = 'chatmsg='+ cari; 
    } 
   else if (combo == "chatimg"){ 
      dataString = 'chatimg='+ cari; 
    } 
   else if (combo == "emp_idemp"){ 
      dataString = 'emp_idemp='+ cari; 
    } 
 
    $.ajax({ 
      url: "publicchat_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#publicchat_form").submit(function(){ 
//    if (confirm("Apakah benar akan menyimpan data publicchat ini?")){ 
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
        	url: "publicchat_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
           document.publicchat_form.chatmsg.value="";          	
          	
          	 // alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("publicchat_form.php");   
              $("#divPageEntry").show(); 
            } 
          	else 
          	{ 
          		alert("Data gagal di simpan!"); 
           	} 
        	} 
         }); 
     //		return false; 
   //  	} 
     //} 
     return false; 
   }); 
 }); 
 </script> 
<form method="post" name="publicchat_form" action="" id="publicchat_form">  
<table> 
<input type="hidden" id="idpublicchat" name="idpublicchat" size="10" <? echo $readonly;?> value="<? echo $idpublicchat;?>" />
<input type="hidden" id="chatdate" name="chatdate" size="30" maxlength="25" value="<? echo $chatdate;?>" />
<input type="hidden" id="emp_idemp" name="emp_idemp" size="30" maxlength="25" value="<? echo $emp_idemp;?>" />

<tr> 
<td><input type="text" id="chatmsg" name="chatmsg" size="65" maxlength="200" value="<? echo $chatmsg;?>" /></td> 
<td><input type="text" class="color" size=5 id="color" name="color" value="#0000FF">
<td colspan="2"><input class="button" type="submit" value="Kirim"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
