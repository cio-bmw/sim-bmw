  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data"; 
	$status="Simpan"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from bankbook where idbankbook = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idbankbook=$data['idbankbook']; 
		$bank_idbank=$data['bank_idbank']; 
		$tanggal=$data['tanggal']; 
		$keterangan=$data['keterangan']; 
		$debet=$data['debet']; 
		$kredit=$data['kredit']; 
		$saldo=$data['saldo']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Edit Data"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#bankbook").focus();  
  
 $("input").not($(":submit")).keypress(function (evt) {  
              if (evt.keyCode == 13) {  
                  iname = $(this).val();  
                  if (iname !== 'Submit') {  
                      var fields = $(this).parents('form:eq(0),body').find('button, input, textarea, select');  
                      var index = fields.index(this);  
                      if (index > -1 && (index + 1) < fields.length) {  
                          fields.eq(index + 1).focus();  
                      }  
                      return false;  
                  }  
              }  
          });  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idbankbook"){ 
      dataString = 'idbankbook='+ cari;  
   } 
   else if (combo == "bank_idbank"){ 
      dataString = 'bank_idbank='+ cari; 
    } 
   else if (combo == "tanggal"){ 
      dataString = 'tanggal='+ cari; 
    } 
   else if (combo == "keterangan"){ 
      dataString = 'keterangan='+ cari; 
    } 
   else if (combo == "debet"){ 
      dataString = 'debet='+ cari; 
    } 
   else if (combo == "kredit"){ 
      dataString = 'kredit='+ cari; 
    } 
   else if (combo == "saldo"){ 
      dataString = 'saldo='+ cari; 
    } 
 
    $.ajax({ 
      url: "bankbook_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#bankbook_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data bankbook ini?")){ 
    		$.ajax({ 
        	url: "bankbook_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("bankbook_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="bankbook_detail.php?id="+$("input#idslshdr").val(); 
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
 $("#btnclose").click(function(){  
		$("#divPageEntry").hide();  
      $("#divLOV").hide();  
  
		page3="bankbook_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script> 
<link rel="stylesheet" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
				jQuery('input[name=rcv_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
			})			
</script>	 
<form method="post" name="bankbook_form" action="" id="bankbook_form">  
<p class="judul">Form Memasukkan / Edit Data bankbook</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idbankbook</td><td><input type="text" id="idbankbook" name="idbankbook" size="10" <? echo $readonly;?> value="<? echo $idbankbook;?>" /></td> 
</tr> 
<?php } ?> 

<tr> 
<td class="right">bank_idbank</td> 
<td><input type="text" id="bank_idbank" name="bank_idbank" size="30" maxlength="45" value="<? echo $bank_idbank;?>" /></td> 
</tr> 
<tr> 
<td class="right">tanggal</td> 
<td><input type="text" id="tanggal" name="tanggal" size="30" maxlength="45" value="<? echo $tanggal;?>" /></td> 
</tr> 
<tr> 
<td class="right">keterangan</td> 
<td><input type="text" id="keterangan" name="keterangan" size="30" maxlength="45" value="<? echo $keterangan;?>" /></td> 
</tr> 
<tr> 
<td class="right">debet</td> 
<td><input type="text" id="debet" name="debet" size="30" maxlength="45" value="<? echo $debet;?>" /></td> 
</tr> 
<tr> 
<td class="right">kredit</td> 
<td><input type="text" id="kredit" name="kredit" size="30" maxlength="45" value="<? echo $kredit;?>" /></td> 
</tr> 
<tr> 
<td class="right">saldo</td> 
<td><input type="text" id="saldo" name="saldo" size="30" maxlength="45" value="<? echo $saldo;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
