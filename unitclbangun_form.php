  <?  
  include_once("config.php"); 
   $unit_idunit = $_GET['unit'];
   $unitspk_idunitspk = $_GET['spk'];
	$action="add"; 
	$judul="Penambahan Data unitclbangun"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idunitclbangun),0)+1  FROM unitclbangun";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idunitclbangun = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from unitclbangun where idunitclbangun = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunitclbangun=$data['idunitclbangun']; 
		$clstatus=$data['clstatus']; 
		$clbangun_idclbangun=$data['clbangun_idclbangun']; 
		$unit_idunit=$data['unit_idunit']; 
		$bobotpct=$data['bobotpct']; 
		$progress = $data['progress'];
		$unitspk_idunitspk=$data['unitspk_idunitspk']; 
		$workdays=$data['workdays']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unitclbangun"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#clbangun_idclbangun").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var vspk = $("input#idunitspk").val(); 
	
	  dataString = 'spk='+ vspk; 
   
    $.ajax({ 
      url: "unitclbangun_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#unitclbangun_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data unitclbangun ini?")){ 
    		$.ajax({ 
        	url: "unitclbangun_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("unitclbangun_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
//           window.location="unitclbangun_dtl.php?id="+$("input#idslshdr").val(); 
                loadData(); //reload list data 
         	  
                     	  
         	  $("#divPageEntry").load("unitclbangun_form.php?spk="+$("input#idunitspk").val()+"&unit="+$("input#unit_idunit").val());   
              $("#divPageEntry").show(); 
         
           
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
  
		page3=".php";  
		$("#divPageData").load(page3);  
		$("#divPageData").show();  
		return false;  
	});  
 }); 
 </script> 
<form method="post" name="unitclbangun_form" action="" id="unitclbangun_form">  
<p class="judul">Menambahkan Cek Item SPK</p>
<table width="490px"> 
<input type="hidden" id="idunitclbangun" name="idunitclbangun" size="10" value="<? echo $idunitclbangun;?>" />

<tr> 
<td class="right">Kode</td> 
<td>
<input type="text" id="clbangun_idclbangun" name="clbangun_idclbangun" size="5" maxlength="25" value="<? echo $clbangun_idclbangun;?>" />
<input type="text" id="clbangundesc" name="clbangundesc" size="30" maxlength="25" value="<? echo $clbangundesc;?>" />
</td> 
</tr> 
<input type="hidden" id="unit_idunit" name="unit_idunit" size="30" maxlength="25" value="<? echo $unit_idunit;?>" />
<tr> 
<td class="right">bobotpct</td> 
<td>
<input type="text" id="bobotpct" name="bobotpct" size="10" maxlength="25" value="<? echo $bobotpct;?>" />
WorkDays : <input type="text" id="workdays" name="workdays" size="10" maxlength="25" value="<? echo $workdays;?>" />
</td> 
</tr> 

<tr> 
<td class="right">Progress</td> 
<td>
<input type="text" id="progress" name="progress" size="10" maxlength="25" value="<? echo $progress;?>" />
</td> 
</tr> 

<input type="hidden" id="unitspk_idunitspk" name="unitspk_idunitspk" size="30" maxlength="25" value="<? echo $unitspk_idunitspk;?>" /> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
