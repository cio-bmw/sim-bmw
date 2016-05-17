  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data clbangun"; 
	$status="Tambah"; 
   $sql = "SELECT IFNULL(max(idclbangun),0)+1  FROM clbangun";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idclbangun = $data[0];	 
   $category = 'Pilih dari Pilihan Yang Tersedia';
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from clbangun where idclbangun = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idclbangun=$data['idclbangun']; 
		$clbangundesc=$data['clbangundesc']; 
		$bobotpct=$data['bobotpct']; 
		$spkcat_idspkcat=$data['spkcat_idspkcat']; 
		$workdays=$data['workdays']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data clbangun"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#clbangun").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idclbangun"){ 
      dataString = 'idclbangun='+ cari;  
   } 
   else if (combo == "clbangundesc"){ 
      dataString = 'clbangundesc='+ cari; 
    } 
   else if (combo == "bobotpct"){ 
      dataString = 'bobotpct='+ cari; 
    } 
   else if (combo == "spkcat_idspkcat"){ 
      dataString = 'spkcat_idspkcat='+ cari; 
    } 
   else if (combo == "workdays"){ 
      dataString = 'workdays='+ cari; 
    } 
 
    $.ajax({ 
      url: "clbangun_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#clbangun_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data clbangun ini?")){ 
    		$.ajax({ 
        	url: "clbangun_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 1) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil disimpan!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("clbangun_form.php");   
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
   
		page3="clbangun_display.php"; 
		$("#divPageData").load(page3); 
		$("#divPageData").show(); 
		return false; 
	}); 
   
 }); 
 </script> 
<form method="post" name="clbangun_form" action="" id="clbangun_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idclbangun</td><td><input type="text" id="idclbangun" name="idclbangun" size="10" <? echo $readonly;?> value="<? echo $idclbangun;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idclbangun</td><td><input type="text" id="idclbangun" name="idclbangun" size="10" value="<? echo $idclbangun;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">clbangundesc</td> 
<td><input type="text" id="clbangundesc" name="clbangundesc" size="30" maxlength="25" value="<? echo $clbangundesc;?>" /></td> 
</tr> 
<tr> 
<td class="right">bobotpct</td> 
<td><input type="text" id="bobotpct" name="bobotpct" size="30" maxlength="25" value="<? echo $bobotpct;?>" /></td> 
</tr> 

<tr> 
<td class="right">workdays</td> 
<td><input type="text" id="workdays" name="workdays" size="30" maxlength="25" value="<? echo $workdays;?>" /></td> 
</tr> 
<tr> 
<td class="right">Kategori</td> 
<td>
<input type="text" id="spkcat_idspkcat" name="spkcat_idspkcat" size="5" maxlength="25" value="<? echo $spkcat_idspkcat;?>" />
<input type="text" id="category" name="category" size="30" maxlength="25" value="<? echo $category;?>" />
</td> 
</tr> 

<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>" ></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td> 

</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
