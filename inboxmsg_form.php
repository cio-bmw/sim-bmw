  <?  
  session_start();
 $emp_idempfrom = $_SESSION['cookie_name'];

  include_once("config.php"); 
    $inboxdate=nowdatetime(); 	
	$action="add"; 
	$judul="Penambahan Data inboxmsg"; 
	$status="Tambah"; 
  
  
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from inboxmsg where idinboxmsg = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idinboxmsg=$data['idinboxmsg']; 
		$status=$data['status']; 
		$msg=$data['msg']; 
		$inboxdate=$data['inboxdate']; 
		$emp_idempfrom=$data['emp_idempfrom']; 
		$emp_idempto=$data['emp_idempto']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data inboxmsg"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#inboxmsg").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idinboxmsg"){ 
      dataString = 'idinboxmsg='+ cari;  
   } 
   else if (combo == "status"){ 
      dataString = 'status='+ cari; 
    } 
   else if (combo == "msg"){ 
      dataString = 'msg='+ cari; 
    } 
   else if (combo == "inboxdate"){ 
      dataString = 'inboxdate='+ cari; 
    } 
   else if (combo == "emp_idempfrom"){ 
      dataString = 'emp_idempfrom='+ cari; 
    } 
   else if (combo == "emp_idempto"){ 
      dataString = 'emp_idempto='+ cari; 
    } 
 
    $.ajax({ 
      url: "inboxmsg_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#inboxmsg_form").submit(function(){ 
 //   if (confirm("Apakah benar akan menyimpan data inboxmsg ini?")){ 
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
        	url: "inboxmsg_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	 
              loadData(); //reload list data 
          		$("#divPageEntry").load("inboxmsg_form.php");   
          		
              } 
          	else 
          	{ 
          		alert("Data gagal di simpan!"); 
           	} 
        	} 
         }); 
     //		return false; 
  //   	} 
     //} 
     return false; 
   }); 
 }); 
 </script> 
<form method="post" name="inboxmsg_form" action="" id="inboxmsg_form">  
<table width="700px"> 
<input type="hidden" id="idinboxmsg" name="idinboxmsg" size="10" value="<? echo $idinboxmsg;?>" />
<input type="hidden" id="status" name="status" size="30" maxlength="25" value="<? echo $status;?>" />
<tr> 
<td valign="top">Pesan Ke :
<select id="emp_idempto" name="emp_idempto">
<option value="<? echo $emp_idempfrom; ?>">Semua</option>
<? createempoption($emp_idempto); ?> 
</select>
<br>
<textarea  id="msg" name="msg" cols="70" rows="3"><? echo $msg;?></textarea>
<input class="button" type="submit" value="Kirim Pesan">
</td> 
</tr> 
<input type="hidden" id="inboxdate" name="inboxdate" size="30" maxlength="25" value="<? echo $inboxdate;?>" />
<input type="hidden" id="emp_idempfrom" name="emp_idempfrom" size="30" maxlength="25" value="<? echo $emp_idempfrom;?>" />

</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
