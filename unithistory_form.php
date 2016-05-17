  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST(idunithistory AS UNSIGNED)),0)+1  FROM unithistory";  
   $result = mysql_query($sql);  
  $data  = mysql_fetch_array($result);  
  $idunithistory = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from unithistory where idunithistory = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunithistory=$data['idunithistory']; 
		$namauser=$data['namauser']; 
		$tglmundur=$data['tglmundur']; 
		$alasan=$data['alasan']; 
		$unit_idunit=$data['unit_idunit']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Edit Data"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#unithistory").focus();  
  
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
	   
	  if (combo == "idunithistory"){ 
      dataString = 'idunithistory='+ cari;  
   } 
   else if (combo == "namauser"){ 
      dataString = 'namauser='+ cari; 
    } 
   else if (combo == "tglmundur"){ 
      dataString = 'tglmundur='+ cari; 
    } 
   else if (combo == "alasan"){ 
      dataString = 'alasan='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
 
    $.ajax({ 
      url: "unithistory_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#unithistory_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data unithistory ini?")){ 
    		$.ajax({ 
        	url: "unithistory_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("unithistory_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="unithistory_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="unithistory_display.php";  
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
<form method="post" name="unithistory_form" action="" id="unithistory_form">  
<p class="judul">Form Memasukkan / Edit Data unithistory</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idunithistory</td><td><input type="text" id="idunithistory" name="idunithistory" size="10" <? echo $readonly;?> value="<? echo $idunithistory;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idunithistory</td><td><input type="text" id="idunithistory" name="idunithistory" size="10" value="<? echo $idunithistory;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">namauser</td> 
<td><input type="text" id="namauser" name="namauser" size="30" maxlength="45" value="<? echo $namauser;?>" /></td> 
</tr> 
<tr> 
<td class="right">tglmundur</td> 
<td><input type="text" id="tglmundur" name="tglmundur" size="30" maxlength="45" value="<? echo $tglmundur;?>" /></td> 
</tr> 
<tr> 
<td class="right">alasan</td> 
<td><input type="text" id="alasan" name="alasan" size="30" maxlength="45" value="<? echo $alasan;?>" /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td><input type="text" id="unit_idunit" name="unit_idunit" size="30" maxlength="45" value="<? echo $unit_idunit;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
