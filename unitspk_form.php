  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data unitspk"; 
	$status="Tambah"; 
	$spkdate = date('d-m-Y');
   $sql = "SELECT IFNULL(max(idunitspk),0)+1  FROM unitspk";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idunitspk = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from unitspk where idunitspk = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idunitspk=$data['idunitspk']; 
		$spkno=$data['spkno']; 
		$spkdate = gettanggal($data['spkdate']);
		$spkdesc1=$data['spkdesc1']; 
		$spkdesc2=$data['spkdesc2']; 
		$spkvalue=$data['spkvalue']; 
		$spkcat_idspkcat=$data['spkcat_idspkcat']; 
		$unit_idunit=$data['unit_idunit']; 
		$contractor_idcontractor=$data['contractor_idcontractor']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Update"; 
		$judul="Update data unitspk"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#unitspk").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idunitspk"){ 
      dataString = 'idunitspk='+ cari;  
   } 
   else if (combo == "spkno"){ 
      dataString = 'spkno='+ cari; 
    } 
   else if (combo == "spkdesc1"){ 
      dataString = 'spkdesc1='+ cari; 
    } 
   else if (combo == "spkdesc2"){ 
      dataString = 'spkdesc2='+ cari; 
    } 
   else if (combo == "spkvalue"){ 
      dataString = 'spkvalue='+ cari; 
    } 
   else if (combo == "spkcat_idspkcat"){ 
      dataString = 'spkcat_idspkcat='+ cari; 
    } 
   else if (combo == "unit_idunit"){ 
      dataString = 'unit_idunit='+ cari; 
    } 
   else if (combo == "contractor_idcontractor"){ 
      dataString = 'contractor_idcontractor='+ cari; 
    } 
 
    $.ajax({ 
      url: "unitspk_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#unitspk_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data unitspk ini?")){ 
    		$.ajax({ 
        	url: "unitspk_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageData").load("unitspk_display.php");   
              $("#divPageData").hide(); 
            } 
          	else if(response.status == 1) {
              window.location="unitspk_detail.php?id="+$("input#idunitspk").val(); 
          		
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
   
		page3="unitspk_display.php"; 
		$("#divPageData").load(page3); 
		$("#divPageData").show(); 
		return false; 
	}); 
      
   $("#btnlovunit").click(function(){ 
  		pagel="unitspk_unitdisplay.php?sektor="+$("select#idsektor").val(); 
		$("#divLOV").load(pagel); 
		$("#divLOV").show(); 
		return false; 
	}); 
  
   $("#btnlovspkcat").click(function(){ 
  		pagel="spkcat_lov.php"; 
		$("#divLOV").load(pagel); 
		$("#divLOV").show(); 
		return false; 
	}); 
    
 $("#btnlovcontractor").click(function(){ 
  		pagel="contractor_lov.php"; 
		$("#divLOV").load(pagel); 
		$("#divLOV").show(); 
		return false; 
	}); 
     
   
 }); 
 </script> 
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
			jQuery(function(){
			jQuery('input[name=spkdate]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yy"});
 
})	
</script>	 

<form method="post" name="unitspk_form" action="" id="unitspk_form">  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idunitspk</td><td><input type="text" id="idunitspk" name="idunitspk" size="10" <? echo $readonly;?> value="<? echo $idunitspk;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idunitspk</td><td><input type="text" id="idunitspk" name="idunitspk" size="10" value="<? echo $idunitspk;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">Tanggal</td> 
<td><input type="text" id="spkdate" name="spkdate" size="10" maxlength="25" value="<? echo $spkdate;?>" /></td> 
</tr> 
<tr> 
<td class="right">Unit/Kavling</td> 
<td>
<input type="text" id="unit_idunit" name="unit_idunit" size="5" maxlength="25" value="<? echo $unit_idunit;?>" />
<input type="button" class="button" id="btnlovunit" value="...">
<input type="text" id="kavling" name="kavling" size="30" maxlength="25" value="<? echo $kavling;?>" />

</td> 
</tr> 
<tr> 
<td class="right">Kategori SPK</td> 
<td>
<input type="text" id="spkcat_idspkcat" name="spkcat_idspkcat" size="5" maxlength="25" value="<? echo $spkcat_idspkcat;?>" />
<input type="button" class="button" id="btnlovspkcat" value="...">
<input type="text" id="category" name="category" size="30" maxlength="25" value="<? echo $category;?>" />

</td> 
</tr> 
<tr> 
<td class="right">contractor</td> 
<td>
<input type="text" id="contractor_idcontractor" name="contractor_idcontractor" size="5" maxlength="25" value="<? echo $contractor_idcontractor;?>" />
<input type="button" class="button" id="btnlovcontractor" value="...">
<input type="text" id="contractorname" name="contractorname" size="30" maxlength="25" value="<? echo $contractorname;?>" />
</td> 
</tr> 
<tr> 
<td class="right">Nilai Kontrak</td> 
<td><input class="right" type="text" id="spkvalue" name="spkvalue" size="10" maxlength="25" value="<? echo $spkvalue;?>" /></td> 
</tr> 

<tr> 
<td class="right">Keterangan 1</td> 
<td><input type="text" id="spkdesc1" name="spkdesc1" size="30" maxlength="25" value="<? echo $spkdesc1;?>" /></td> 
</tr> 
<tr> 
<td class="right">Keterangan 2</td> 
<td><input type="text" id="spkdesc2" name="spkdesc2" size="30" maxlength="25" value="<? echo $spkdesc2;?>" /></td> 
</tr> 


<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td> 
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
