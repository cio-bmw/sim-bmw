  <?  
  include_once("config.php"); 
   
	$action="add"; 
	$judul="Penambahan Data pldtl"; 
	$status="Simpan"; 
   $sql = "SELECT IFNULL(max(CAST((idpldtl AS UNSIGNED)),0)+1  FROM pldtl";  
   $result = mysql_query($sql);  
   $data  = mysql_fetch_array($result);  
   $idpldtl = $data[0];	 
	if(isset($_GET['action']) and $_GET['action']=="update" and !empty($_GET['id'])) 
	{ 
		$str="select * from pldtl where idpldtl = '$_GET[id]'"; 
		$res=mysql_query($str) or die("query gagal dijalankan"); 
		$data=mysql_fetch_assoc($res); 
		$idpldtl=$data['idpldtl']; 
		$plhdr_idplhdr=$data['plhdr_idplhdr']; 
		$acc_idacc=$data['acc_idacc']; 
		$action="update"; 
		$readonly="readonly=readonly"; 
		$status="Simpan"; 
		$judul="Update data pldtl"; 
	} 
?> 
<script type="text/javascript"> 
 
$(function(){ 
  $("input#pldtl").focus();  
  
  function loadData(){ 
	  var dataString; 
	  var cari = $("input#fieldcari").val(); 
	  var combo = $("select#pilihcari").val(); 
	   
	  if (combo == "idpldtl"){ 
      dataString = 'idpldtl='+ cari;  
   } 
   else if (combo == "plhdr_idplhdr"){ 
      dataString = 'plhdr_idplhdr='+ cari; 
    } 
   else if (combo == "acc_idacc"){ 
      dataString = 'acc_idacc='+ cari; 
    } 
 
    $.ajax({ 
      url: "pldtl_display.php", 
      type: "GET", 
      data: dataString, 
  		success:function(data) 
  		{ 
  			$('#divPageData').html(data); 
  		} 
    }); 
  } 
 
  $("form#pldtl_form").submit(function(){ 
    if (confirm("Apakah benar akan menyimpan data pldtl ini?")){ 
    		$.ajax({ 
        	url: "pldtl_process.php", 
        	type:$(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST' 
        	data:$(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses 
        	dataType: 'json', //respon yang diminta dalam format JSON 
        	success:function(response){ 
          	if(response.status == 2) // return nilai dari hasil proses 
          	{  
          	  alert("Data berhasil diupdate!"); 
              loadData(); //reload list data 
          		$("#divPageEntry").load("pldtl_form.php");   
              $("#divPageEntry").hide(); 
            } 
          else if(response.status == 1) { 
          	  alert("Data Baru berhasil disimpan!"); 
              loadData(); //reload list data 
         //   window.location="pldtl_detail.php?id="+$("input#idslshdr").val(); 
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
  
		page3="pldtl_display.php";  
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
				jQuery('input[name=rcv_date]').datepicker({changeYear:true, changeMonth:true, yearRange:"1990:2025",dateFormat: "dd-mm-yyyy"});
			})			
</script>	 
<form method="post" name="pldtl_form" action="" id="pldtl_form">  
<p class="judul">Form Memasukkan / Edit Data pldtl</p>  
<table> 
<tr><th colspan="2"><b><?php echo $judul; ?></b></th></tr> 
<?php if ($_GET['action'] == "update"){?> <!-- //jika update maka textfield ID Pelanggan ditampilkan --> 
<tr><td class="right">idpldtl</td><td><input type="text" id="idpldtl" name="idpldtl" size="10" <? echo $readonly;?> value="<? echo $idpldtl;?>" /></td> 
</tr> 
<?php } else {?> 
<tr><td class="right">idpldtl</td><td><input type="text" id="idpldtl" name="idpldtl" size="10" value="<? echo $idpldtl;?>" /></td> 
</tr> 
<?php }?> 
<tr> 
<td class="right">plhdr_idplhdr</td> 
<td><input type="text" id="plhdr_idplhdr" name="plhdr_idplhdr" size="30" maxlength="25" value="<? echo $plhdr_idplhdr;?>" /></td> 
</tr> 
<tr> 
<td class="right">acc_idacc</td> 
<td><input type="text" id="acc_idacc" name="acc_idacc" size="30" maxlength="25" value="<? echo $acc_idacc;?>" /></td> 
</tr> 
<tr> 
<td ><input class="button" type="submit" value="<? echo $status;?>"></td> 
<td ><input class="button" type="button" id="btnclose" value="Tutup Form"></td>  
</tr> 
</table> 
<input type="hidden" name="action" value="<? echo $action;?>" /> 
</form> 
