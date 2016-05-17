  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data"; 
	$status="Simpan"; 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from prospek where idprospek = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idprospek=$data['idprospek']; 
		$prospek=$data['prospek']; 
		$phone=$data['phone']; 
		$alamat=$data['alamat']; 
		$catatan=$data['catatan']; 
		$marketing_idmarketing=$data['marketing_idmarketing']; 
		$sektor_idsektor=$data['sektor_idsektor']; 
		$kavling=$data['kavling']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Edit Data"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#prospek").focus();  
  
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
	   
	  if (combo == "idprospek"){ 
      dataString = 'idprospek='+ cari;  
   } 
   else if (combo == "prospek"){ 
      dataString = 'prospek='+ cari; 
    } 
   else if (combo == "phone"){ 
      dataString = 'phone='+ cari; 
    } 
   else if (combo == "alamat"){ 
      dataString = 'alamat='+ cari; 
    } 
   else if (combo == "catatan"){ 
      dataString = 'catatan='+ cari; 
    } 
   else if (combo == "marketing_idmarketing"){ 
      dataString = 'marketing_idmarketing='+ cari; 
    } 
   else if (combo == "sektor_idsektor"){ 
      dataString = 'sektor_idsektor='+ cari; 
    } 
   else if (combo == "kavling"){ 
      dataString = 'kavling='+ cari; 
    } 
 
    $.ajax({ 
      url: "prospek_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#prospek_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data prospek ini?")){ 
    		$.ajax({ 
        	url: "prospek_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("prospek_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="prospek_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="prospek_display.php";  
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
<form method="post" name="prospek_form" action="" id="prospek_form">  
<p class="judul">Form Memasukkan / Edit Data prospek</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idprospek</td><td><input type="text" id="idprospek" name="idprospek" size="10" <? echo $readonly;?> value="<? echo $idprospek;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idprospek</td><td><input type="text" id="idprospek" name="idprospek" size="10" value="<? echo $idprospek;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">prospek</td> 
<td><input type="text" id="prospek" name="prospek" size="30" maxlength="45" value="<? echo $prospek;?>" /></td> 
</tr> 
<tr> 
<td class="right">phone</td> 
<td><input type="text" id="phone" name="phone" size="30" maxlength="45" value="<? echo $phone;?>" /></td> 
</tr> 
<tr> 
<td class="right">alamat</td> 
<td><input type="text" id="alamat" name="alamat" size="30" maxlength="45" value="<? echo $alamat;?>" /></td> 
</tr> 
<tr> 
<td class="right">catatan</td> 
<td><input type="text" id="catatan" name="catatan" size="30" maxlength="45" value="<? echo $catatan;?>" /></td> 
</tr> 
<tr> 
<td class="right">marketing_idmarketing</td> 
<td><input type="text" id="marketing_idmarketing" name="marketing_idmarketing" size="30" maxlength="45" value="<? echo $marketing_idmarketing;?>" /></td> 
</tr> 
<tr> 
<td class="right">sektor_idsektor</td> 
<td><input type="text" id="sektor_idsektor" name="sektor_idsektor" size="30" maxlength="45" value="<? echo $sektor_idsektor;?>" /></td> 
</tr> 
<tr> 
<td class="right">kavling</td> 
<td><input type="text" id="kavling" name="kavling" size="30" maxlength="45" value="<? echo $kavling;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
