  <?  
  include_once("config.php"); 
   
    $action="add"; 
    $judul="Penambahan Data kpr"; 
    $status="Tambah"; 
   $sql = "SELECT IFNULL(max(idkpr),0)+1  FROM kpr";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idkpr = $data[0];    
    if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
    { 
        $str="select * from kpr where idkpr = '$_GET[id]'"; 
        $res=mysql_query($str) or die("query gagal dijalankan"); 
        $data=mysql_fetch_assoc($res); 
        $idkpr=$data['idkpr']; 
        $kprname=$data['kprname']; 
        $action="update"; 
        $readonly="readonly=readonly"; 
        $status="Update"; 
        $judul="Update data kpr"; 
    } 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#kpr").focus();  
  
  function loadData(){ 
      var dataString; 
      var cari = $("input#fieldcari").val(); 
      var combo = $("select#pilihcari").val(); 
       
      if (combo == "idkpr"){ 
      dataString = 'idkpr='+ cari;  
   } 
   else if (combo == "kprname"){ 
      dataString = 'kprname='+ cari; 
    } 
 
    $.ajax({ 
      url: "kpr_display.php", 
      type: "GET", 
      data: dataString, 
        success:function(data) 
        { 
            $('#divPageData').html(data); 
        } 
    }); 
  } 
 
  $("form#kpr_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data kpr ini?")){ 
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
            url: "kpr_process.php", 
            type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
            data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
            dataType: 'json', //respon yang diminta dalam format JSON 
            success:function(response){ 
            if(response.status == 1) // return nilai dari hasil proses 
            {  
              alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
                $("#divFormContent").load("kpr_form.php");   
              $("#divFormContent").hide(); 
              $("#btnhide").hide(); 
            } 
            else 
            { 
                alert("Data gagal di simpan!"); 
            } 
            } 
         }); 
     //     return false; 
        } 
     //} 
     return false; 
   }); 
 }); 
 </script> 
<form method="post" name="kpr_form" action="" id="kpr_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idkpr</td><td><input type="text" id="idkpr" name="idkpr" size="10" <? echo $readonly;?> value="<? echo $idkpr;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idkpr</td><td><input type="text" id="idkpr" name="idkpr" size="10" value="<? echo $idkpr;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">kprname</td> 
<td><input type="text" id="kprname" name="kprname" size="30" maxlength="25" value="<? echo $kprname;?>" /></td> 
</tr> 
<tr> 
<td colspan="2"><input class="button" type="submit" value="<? echo $status;?>"</td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 