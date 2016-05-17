  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data unitamclist"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idunitamclist),0)+1  FROM unitamclist";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idunitamclist = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from unitamclist where idunitamclist = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunitamclist=$data['idunitamclist']; 
		$clstatus=$data['clstatus']; 
		$unit_idunit=$data['unit_idunit']; 
		$amclist_idamclist=$data['amclist_idamclist']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unitamclist"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#unitamclist").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idunitamclist"){ 
      dataString = 'idunitamclist='+ cari;  
   } 
   else if (combo == "clstatus"){ 
      dataString = 'clstatus='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "amclist_idamclist"){ 
      dataString = 'amclist_idamclist='+ cari; 
    } 
 
    $.ajax({ 
      url: "unitamclist_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#unitamclist_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data unitamclist ini?")){ 
    		$.ajax({ 
        	url: "unitamclist_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("unitamclist_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="unitamclist_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="unitamclist_display.php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<form method="post" name="unitamclist_form" action="" id="unitamclist_form">  
<p class="judul">Form Memasukkan / Edit Data unitamclist</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idunitamclist</td><td><input type="text" id="idunitamclist" name="idunitamclist" size="10" <? echo $readonly;?> value="<? echo $idunitamclist;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idunitamclist</td><td><input type="text" id="idunitamclist" name="idunitamclist" size="10" value="<? echo $idunitamclist;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">clstatus</td> 
<td><input type="text" id="clstatus" name="clstatus" size="30" maxlength="25" value="<? echo $clstatus;?>" /></td> 
</tr> 
<tr> 
<td class="right">unit_idunit</td> 
<td><input type="text" id="unit_idunit" name="unit_idunit" size="30" maxlength="25" value="<? echo $unit_idunit;?>" /></td> 
</tr> 
<tr> 
<td class="right">amclist_idamclist</td> 
<td><input type="text" id="amclist_idamclist" name="amclist_idamclist" size="30" maxlength="25" value="<? echo $amclist_idamclist;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
